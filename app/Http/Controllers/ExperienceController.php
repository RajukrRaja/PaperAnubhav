<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    public function create()
    {
        $exams = Exam::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('experiences.create', [
            'experience' => null,
            'exams' => $exams,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['user_id'] = $request->user()->id;
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['status'] = $request->input('intent') === 'draft'
            ? 'draft'
            : 'pending';
        $data['verification_label'] = 'candidate_reported';

        $experience = Experience::create($data);

        return redirect()
            ->route('experiences.edit', $experience)
            ->with(
                'success',
                $experience->status === 'draft'
                    ? 'Draft saved.'
                    : 'Experience submitted for moderation.'
            );
    }

    public function edit(Experience $experience)
    {
        $this->authorizeOwner($experience);

        $exams = Exam::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('experiences.edit', [
            'experience' => $experience,
            'exams' => $exams,
        ]);
    }

    public function update(Request $request, Experience $experience)
    {
        $this->authorizeOwner($experience);

        $data = $this->validateData($request);

        $data['status'] = $request->input('intent') === 'draft'
            ? 'draft'
            : 'pending';

        $data['published_at'] = null;

        DB::transaction(function () use (
            $experience,
            $data,
            $request
        ) {
            $experience->revisions()->create([
                'user_id' => $request->user()->id,
                'snapshot' => $experience->only([
                    'title',
                    'summary',
                    'body',
                    'exam_id',
                    'exam_date',
                    'shift',
                    'difficulty',
                    'advice',
                ]),
            ]);

            $experience->update($data);
        });

        return redirect()
            ->route('experiences.edit', $experience)
            ->with(
                'success',
                'Changes saved. Submission status: '
                . $experience->status . '.'
            );
    }

    public function destroy(
        Request $request,
        Experience $experience
    ) {
        $this->authorizeOwner($experience);

        $experience->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Experience deleted.');
    }

    public function show(Experience $experience)
    {
        abort_unless(
            $experience->status === 'published'
                && $experience->published_at,
            404
        );

        $experience->load([
            'exam',
            'user',
            'comments.user',
            'comments.replies',
        ]);

        $experience->loadCount([
            'likes',
            'allComments',
        ]);

        return view('experiences.show', compact('experience'));
    }

    private function authorizeOwner(Experience $experience): void
    {
        abort_unless(
            auth()->id() === $experience->user_id
                || auth()->user()?->role === 'admin',
            403
        );
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'experience';
        $slug = $base;
        $i = 1;

        while (
            Experience::withTrashed()
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'exam_id' => 'required|exists:exams,id',

            'title' => 'required|string|min:8|max:180',
            'summary' => 'nullable|string|max:500',
            'body' => 'nullable|string|max:20000',

            'exam_date' => 'nullable|date|before_or_equal:today',
            'exam_year' => 'nullable|integer|min:2000|max:2100',

            'shift' => 'nullable|string|max:50',
            'stage' => 'nullable|string|max:100',
            'language' => 'required|string|max:10',

            'difficulty' => 'nullable|integer|min:1|max:5',

            'attempted_count' => 'nullable|integer|min:0|max:500',
            'estimated_correct' => 'nullable|integer|min:0|max:500',
            'estimated_incorrect' => 'nullable|integer|min:0|max:500',
            'good_attempt' => 'nullable|integer|min:0|max:500',

            'time_management' => 'nullable|string|max:5000',
            'unexpected_topics' => 'nullable|string|max:5000',
            'exam_day_notes' => 'nullable|string|max:5000',
            'preparation_strategy' => 'nullable|string|max:5000',
            'recommended_resources' => 'nullable|string|max:5000',
            'mistakes_to_avoid' => 'nullable|string|max:5000',
            'advice' => 'nullable|string|max:5000',

            'center_region' => 'nullable|string|max:100',
            'anonymous_author' => 'nullable|boolean',
        ]);
    }
}