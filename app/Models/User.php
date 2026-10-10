<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\DirectMessage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio',
        'education',
        'location',
        'location_public',
        'preferred_language',
        'avatar_path',
        'cover_path',
        'role',
        'is_active',
        'email_verified_at',
        'deletion_requested_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'location_public' => 'boolean',
        ];
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(UserGoal::class);
    }

    public function studySessions(): HasMany
    {
        return $this->hasMany(StudySession::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function followedExams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_follows')->withTimestamps();
    }

    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'community_user')->withTimestamps();
    }

    public function communityMessages(): HasMany
    {
        return $this->hasMany(CommunityMessage::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(DirectMessage::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(DirectMessage::class, 'recipient_id');
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'moderator'], true);
    }
}