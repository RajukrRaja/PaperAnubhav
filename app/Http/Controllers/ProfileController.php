<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Experience;
use App\Models\User;
use App\Models\Comment;
use App\Models\DirectMessage;
class ProfileController extends Controller
{
 public function show(?string $username=null)
    {
        $user = $username
            ? User::where('username', $username)->where('is_active', true)->firstOrFail()
            : auth()->user();

        $own = auth()->check() && auth()->id() === $user->id;

        if (!$own && $user->location_public === false) {
            $user->location = null;
        }

        $posts = $user->experiences()
            ->published()
            ->with('exam')
            ->latest('published_at')
            ->paginate(8);

        $points = ($user->experiences()->where('status', 'published')->count() * 20)
            + ($user->comments()->count() * 2)
            + ($user->followers()->count() * 5);

        $days = $user->activities()
            ->where('activity_date', '>=', now()->subDays(60)->toDateString())
            ->distinct()
            ->orderBy('activity_date')
            ->pluck('activity_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->toDateString())
            ->all();

        $streak = 0;
        $cursor = now()->startOfDay();
        $daySet = array_flip($days);

        if (!isset($daySet[$cursor->toDateString()])) {
            $cursor->subDay();
        }

        while (isset($daySet[$cursor->toDateString()])) {
            $streak++;
            $cursor->subDay();
        }

        $isFollowing = auth()->check() && auth()->user()->following()->where('followed_id', $user->id)->exists();
        $followsBack = auth()->check() && $user->following()->where('followed_id', auth()->id())->exists();

        $conversations = collect();
        if ($own) {
            $conversationUserIds = DirectMessage::query()
                ->where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->orWhere('recipient_id', $user->id);
                })
                ->latest('id')
                ->get()
                ->map(function ($message) use ($user) {
                    return (int) $message->sender_id === (int) $user->id
                        ? $message->recipient_id
                        : $message->sender_id;
                })
                ->unique()
                ->values();

            $conversations = User::query()
                ->whereIn('id', $conversationUserIds)
                ->where('is_active', true)
                ->with(['sentMessages' => function ($q) use ($user) {
                    $q->where('recipient_id', $user->id)->whereNull('read_at');
                }])
                ->orderBy('name')
                ->get()
                ->map(function ($u) use ($user) {
                    $lastMessage = DirectMessage::query()
                        ->where(function ($q) use ($user, $u) {
                            $q->where('sender_id', $user->id)->where('recipient_id', $u->id);
                        })
                        ->orWhere(function ($q) use ($user, $u) {
                            $q->where('sender_id', $u->id)->where('recipient_id', $user->id);
                        })
                        ->latest('id')
                        ->first();

                    $unreadCount = $u->sentMessages->count();

                    return [
                        'user' => $u,
                        'last_message' => $lastMessage,
                        'unread_count' => $unreadCount,
                    ];
                });
        }

        return view('profile.show', compact(
            'user',
            'own',
            'posts',
            'points',
            'streak',
            'isFollowing',
            'followsBack',
            'conversations'
        ));
    }
 public function edit(){return view('profile.edit',['user'=>auth()->user()]);}
 public function update(Request $r){$u=$r->user();$data=$r->validate(['name'=>'required|string|max:100','username'=>['required','alpha_dash','min:3','max:30',Rule::unique('users','username')->ignore($u->id)],'email'=>['required','email','max:190',Rule::unique('users','email')->ignore($u->id)],'bio'=>'nullable|string|max:1000','education'=>'nullable|string|max:160','location'=>'nullable|string|max:120','location_public'=>'nullable|boolean','preferred_language'=>'required|string|max:10','avatar'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048','cover'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096']);if($r->hasFile('avatar')){if($u->avatar_path)Storage::disk('public')->delete($u->avatar_path);$data['avatar_path']=$r->file('avatar')->store('profiles/avatars','public');}if($r->hasFile('cover')){if($u->cover_path)Storage::disk('public')->delete($u->cover_path);$data['cover_path']=$r->file('cover')->store('profiles/covers','public');}unset($data['avatar'],$data['cover']);$data['location_public']=$r->boolean('location_public');$u->update($data);return redirect()->route('profile.show')->with('success','Profile updated successfully.');}
 public function password(Request $r){$data=$r->validate(['current_password'=>'required|current_password','password'=>'required|string|min:8|confirmed']);$r->user()->update(['password'=>Hash::make($data['password'])]);return back()->with('success','Password changed successfully.');}
 public function activity(Request $r){$r->user()->activities()->firstOrCreate(['activity_date'=>now()->toDateString(),'activity_type'=>'daily_checkin'],['points'=>1]);return back()->with('success','Daily check-in recorded. Keep your streak going!');}
}
