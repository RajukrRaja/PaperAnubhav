<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StudySession extends Model { protected $fillable = ['user_id','exam_id','subject','topic','duration_minutes','studied_on','notes']; protected function casts(): array { return ['studied_on'=>'date','duration_minutes'=>'integer']; } public function user(){ return $this->belongsTo(User::class); } public function exam(){ return $this->belongsTo(Exam::class); } }
