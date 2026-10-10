<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DirectMessage;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Discover relevant people.
     *
     * - Exclude the authenticated user.
     * - Show active users only.
     * - Exclude users already followed.
     * - Prioritize profiles with more followers.
     * - Display 10 users per page.
     */
    public function people(Request $request)
    {
        $currentUser = $request->user();

        $users = User::query()
            ->where('is_active', true)
            ->where('id', '!=', $currentUser->id)
            ->whereNotIn(
                'id',
                $currentUser->following()->select('users.id')
            )
            ->withCount('followers')
            ->orderByDesc('followers_count')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('social.people', compact('users'));
    }

    /**
     * Follow a user or follow them back.
     */
    public function follow(Request $request, User $user)
    {
        $currentUser = $request->user();

        abort_if(
            (int) $currentUser->id === (int) $user->id,
            422,
            'You cannot follow yourself.'
        );

        abort_unless($user->is_active, 404);

        $currentUser->following()->syncWithoutDetaching([
            $user->id,
        ]);

        $followsMe = $user->following()
            ->where('users.id', $currentUser->id)
            ->exists();

        $message = $followsMe
            ? 'You followed ' . $user->name .
                '. You now follow each other!'
            : 'You followed ' . $user->name . ' successfully.';

        return back()->with('success', $message);
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(Request $request, User $user)
    {
        $currentUser = $request->user();

        abort_if(
            (int) $currentUser->id === (int) $user->id,
            422,
            'You cannot unfollow yourself.'
        );

        $currentUser->following()->detach($user->id);

        return back()->with(
            'success',
            'You unfollowed ' . $user->name . '.'
        );
    }

    /**
     * Display the authenticated user's followers or following list.
     */
    public function list(Request $request, string $type)
    {
        abort_unless(
            in_array($type, ['followers', 'following'], true),
            404
        );

        $user = $request->user();

        $users = (
            $type === 'followers'
                ? $user->followers()
                : $user->following()
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('social.list', compact(
            'user',
            'users',
            'type'
        ));
    }

    /**
     * Display the direct message inbox.
     */
    public function inbox(Request $request)
    {
        $userId = $request->user()->id;

        $conversationUserIds = DirectMessage::query()
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('recipient_id', $userId);
            })
            ->latest('id')
            ->get()
            ->map(function ($message) use ($userId) {
                return (int) $message->sender_id === (int) $userId
                    ? $message->recipient_id
                    : $message->sender_id;
            })
            ->unique()
            ->values();

        $users = User::query()
            ->whereIn('id', $conversationUserIds)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('messages.index', compact('users'));
    }

    /**
     * Display a conversation with another user.
     */
    public function conversation(Request $request, User $user)
    {
        $currentUserId = $request->user()->id;

        abort_if(
            (int) $currentUserId === (int) $user->id,
            404
        );

        abort_unless($user->is_active, 404);

        $messages = DirectMessage::query()
            ->where(function ($query) use ($currentUserId, $user) {
                $query->where('sender_id', $currentUserId)
                    ->where('recipient_id', $user->id);
            })
            ->orWhere(function ($query) use ($currentUserId, $user) {
                $query->where('sender_id', $user->id)
                    ->where('recipient_id', $currentUserId);
            })
            ->with(['sender', 'recipient'])
            ->oldest('id')
            ->paginate(100);

        DirectMessage::query()
            ->where('sender_id', $user->id)
            ->where('recipient_id', $currentUserId)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return view('messages.show', compact(
            'user',
            'messages'
        ));
    }

    /**
     * Send a direct message to another user.
     */
    public function send(Request $request, User $user)
    {
        $currentUser = $request->user();

        abort_if(
            (int) $currentUser->id === (int) $user->id,
            404
        );

        abort_unless($user->is_active, 404);

        $data = $request->validate([
            'body' => 'required|string|max:3000',
        ]);

        DirectMessage::create([
            'sender_id' => $currentUser->id,
            'recipient_id' => $user->id,
            'body' => trim($data['body']),
        ]);

        return redirect()
            ->route('messages.show', $user->username)
            ->with('success', 'Message sent.');
    }
}
