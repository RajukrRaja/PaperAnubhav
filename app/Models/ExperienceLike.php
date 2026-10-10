<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ExperienceLike extends Model {protected $fillable=['experience_id','user_id']; public function experience():BelongsTo{return $this->belongsTo(Experience::class);} public function user():BelongsTo{return $this->belongsTo(User::class);} }
