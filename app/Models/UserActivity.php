<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserActivity extends Model {protected $fillable=['user_id','activity_date','activity_type','points'];protected function casts():array{return ['activity_date'=>'date','points'=>'integer'];}public function user(){return $this->belongsTo(User::class);}}
