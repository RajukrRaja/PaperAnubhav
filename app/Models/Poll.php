<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Poll extends Model { protected $fillable=['user_id','exam_id','question','closes_at','is_active']; protected function casts(): array { return ['closes_at'=>'datetime','is_active'=>'boolean']; } public function user(){return $this->belongsTo(User::class);} public function exam(){return $this->belongsTo(Exam::class);} public function options(){return $this->hasMany(PollOption::class)->orderBy('sort_order');} public function votes(){return $this->hasMany(PollVote::class);} public function userVote(){return $this->hasOne(PollVote::class)->where('user_id',auth()->id());} public function isOpen(): bool {return $this->is_active && (!$this->closes_at || $this->closes_at->isFuture());} }
