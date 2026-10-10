<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'category', 'is_active'];

    protected function casts(): array { return ['is_active' => 'boolean']; }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_user')->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(CommunityMessage::class);
    }
}
