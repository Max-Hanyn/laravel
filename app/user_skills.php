<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_skills extends Model
{
    public $timestamps = false;
   public function userSkills(){

       return $this->belongsTo(User::class);
   }
}
