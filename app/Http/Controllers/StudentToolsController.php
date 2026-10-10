<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Experience;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentToolsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $goals = $user->goals()->latest()->get();
        $sessions = $user->studySessions()->with('exam')->latest('studied_on')->latest()->limit(10)->get();
        $exams = Exam::where('status', 'active')->orderBy('name')->get();
        $followedExams = $user->followedExams()->withCount(['experiences' => fn ($q) => $q->published()])->orderBy('name')->get();
        $minutesThisWeek = $user->studySessions()->whereBetween('studied_on', [now()->startOfWeek()->toDateString(), now()->endOfWeek()->toDateString()])->sum('duration_minutes');
        $activeGoals = $goals->where('completed', false)->count();
        $polls = Poll::with(['user','exam','options.votes','userVote'])->where('is_active', true)->latest()->limit(12)->get();
        return view('tools.index', compact('goals', 'sessions', 'exams', 'followedExams', 'minutesThisWeek', 'activeGoals', 'polls'));
    }

    public function storeGoal(Request $request)
    {
        $data = $request->validate(['title' => 'required|string|max:180', 'target' => 'required|integer|min:1|max:1000', 'due_date' => 'nullable|date|after_or_equal:today']);
        auth()->user()->goals()->create($data);
        return back()->with('success', 'Study goal created.');
    }

    public function updateGoal(Request $request, int $goal)
    {
        $item = auth()->user()->goals()->findOrFail($goal);
        $data = $request->validate(['progress' => 'required|integer|min:0|max:1000']);
        $item->progress = min($data['progress'], $item->target);
        $item->completed = $item->progress >= $item->target;
        $item->save();
        return back()->with('success', $item->completed ? 'Goal completed. Well done!' : 'Goal progress updated.');
    }

    public function destroyGoal(int $goal)
    {
        auth()->user()->goals()->findOrFail($goal)->delete();
        return back()->with('success', 'Study goal removed.');
    }

    public function storeSession(Request $request)
    {
        $data = $request->validate([
            'exam_id' => 'nullable|exists:exams,id', 'subject' => 'required|string|max:120',
            'topic' => 'nullable|string|max:180', 'duration_minutes' => 'required|integer|min:1|max:1440',
            'studied_on' => 'required|date|before_or_equal:today', 'notes' => 'nullable|string|max:2000',
        ]);
        auth()->user()->studySessions()->create($data);
        return back()->with('success', 'Study session saved to your progress log.');
    }

    public function destroySession(int $session)
    {
        auth()->user()->studySessions()->findOrFail($session)->delete();
        return back()->with('success', 'Study session removed.');
    }

    public function followExam(Exam $exam)
    {
        abort_unless($exam->status === 'active', 404);
        auth()->user()->followedExams()->syncWithoutDetaching([$exam->id]);
        return back()->with('success', 'Exam added to your watchlist.');
    }

    public function unfollowExam(Exam $exam)
    {
        auth()->user()->followedExams()->detach($exam->id);
        return back()->with('success', 'Exam removed from your watchlist.');
    }


    public function storePoll(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:240', 'exam_id' => 'nullable|exists:exams,id',
            'options' => 'required|array|min:2|max:5', 'options.*' => 'nullable|string|max:180',
        ]);
        $labels = array_values(array_unique(array_map('trim', $data['options'])));
        $labels = array_values(array_filter($labels, fn ($label) => $label !== ''));
        if (count($labels) < 2) return back()->withErrors(['options' => 'Add at least two different non-empty options.'])->withInput();
        DB::transaction(function () use ($data, $labels) {
            $poll = Poll::create(['user_id' => auth()->id(), 'exam_id' => $data['exam_id'] ?? null, 'question' => $data['question'], 'is_active' => true]);
            foreach ($labels as $index => $label) $poll->options()->create(['label' => $label, 'sort_order' => $index]);
        });
        return back()->with('success', 'Poll published. Students can now vote.');
    }

    public function votePoll(Request $request, Poll $poll)
    {
        abort_unless($poll->isOpen(), 404);
        $data = $request->validate(['option_id' => 'required|integer|exists:poll_options,id']);
        abort_unless($poll->options()->whereKey($data['option_id'])->exists(), 422, 'That option does not belong to this poll.');
        $poll->votes()->firstOrCreate(['user_id' => auth()->id()], ['poll_option_id' => $data['option_id']]);
        if ($poll->votes()->where('user_id', auth()->id())->value('poll_option_id') != $data['option_id']) return back()->with('success', 'You have already voted in this poll.');
        return back()->with('success', 'Your vote has been recorded.');
    }

    public function reportExperience(Request $request, Experience $experience)
    {
        abort_unless($experience->status === 'published', 404);
        abort_if($experience->user_id === auth()->id(), 422, 'You cannot report your own experience.');
        $data = $request->validate(['reason' => 'required|in:spam,misinformation,abuse,duplicate,other', 'details' => 'nullable|string|max:1500']);
        $existing = DB::table('reports')->where('reporter_id', auth()->id())->where('reportable_type', Experience::class)->where('reportable_id', $experience->id)->whereIn('status', ['open', 'reviewing'])->exists();
        if ($existing) return back()->with('success', 'You have already reported this experience. It is awaiting review.');
        DB::table('reports')->insert(['reporter_id' => auth()->id(), 'reportable_type' => Experience::class, 'reportable_id' => $experience->id, 'reason' => $data['reason'], 'details' => $data['details'] ?? null, 'status' => 'open', 'created_at' => now(), 'updated_at' => now()]);
        return back()->with('success', 'Report submitted for moderator review.');
    }
}
