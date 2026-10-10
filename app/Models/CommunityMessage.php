<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunityMessage extends Model
{
    protected $fillable = ['community_id', 'user_id', 'body'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function community(): BelongsTo { return $this->belongsTo(Community::class); }
}
