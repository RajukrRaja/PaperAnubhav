<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class RememberedQuestion extends Model {protected $fillable=['experience_id','user_id','subject','topic','difficulty','question','answer','explanation','answer_uncertain','status']; }
