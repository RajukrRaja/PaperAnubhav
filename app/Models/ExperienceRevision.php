<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ExperienceRevision extends Model {protected $fillable=['experience_id','user_id','snapshot']; protected function casts():array{return ['snapshot'=>'array'];} public function experience():BelongsTo{return $this->belongsTo(Experience::class);} }
