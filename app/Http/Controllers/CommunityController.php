<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::where('is_active', true)->withCount('members')
            ->with(['members' => fn ($query) => $query->where('users.id', auth()->id())])
            ->orderBy('name')->get();

        return view('community.index', compact('communities'));
    }

    public function join(Community $community)
    {
        abort_unless($community->is_active, 404);
        $community->members()->syncWithoutDetaching([auth()->id()]);
        return redirect()->route('community.chat', $community)->with('success', 'You joined '.$community->name.'.');
    }

    public function leave(Community $community)
    {
        $community->members()->detach(auth()->id());
        return redirect()->route('community.index')->with('success', 'You left '.$community->name.'.');
    }

    public function chat(Community $community)
    {
        $this->ensureMember($community);
        $messages = $community->messages()->with('user:id,name,username')->latest('id')->take(50)->get()->reverse()->values();
        return view('community.chat', compact('community', 'messages'));
    }

    public function messages(Request $request, Community $community)
    {
        $this->ensureMember($community);
        $after = max(0, (int) $request->query('after', 0));
        $messages = $community->messages()->where('id', '>', $after)->with('user:id,name,username')
            ->orderBy('id')->take(100)->get()->map(fn ($m) => [
                'id' => $m->id, 'body' => $m->body, 'created_at' => $m->created_at?->toIso8601String(),
                'user' => ['id' => $m->user->id, 'name' => $m->user->name, 'username' => $m->user->username],
            ]);
        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request, Community $community)
    {
        $this->ensureMember($community);
        $data = $request->validate(['body' => ['required', 'string', 'min:1', 'max:2000']]);
        $message = $community->messages()->create(['user_id' => $request->user()->id, 'body' => trim($data['body'])])->load('user:id,name,username');
        return response()->json(['message' => [
            'id' => $message->id, 'body' => $message->body, 'created_at' => $message->created_at?->toIso8601String(),
            'user' => ['id' => $message->user->id, 'name' => $message->user->name, 'username' => $message->user->username],
        ]], 201);
    }

    private function ensureMember(Community $community): void
    {
        abort_unless($community->is_active, 404);
        abort_unless($community->members()->where('users.id', auth()->id())->exists(), 403, 'Join this community to access its chat.');
    }
}
