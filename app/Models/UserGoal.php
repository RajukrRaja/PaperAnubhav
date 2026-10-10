<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserGoal extends Model { protected $fillable = ['user_id','title','target','progress','due_date','completed']; protected function casts(): array { return ['due_date'=>'date','completed'=>'boolean','target'=>'integer','progress'=>'integer']; } public function user(){ return $this->belongsTo(User::class); } }
