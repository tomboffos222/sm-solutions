<?php

namespace App;
use App\CourseVideo;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public function video(){
        return $this->hasOne('App\CourseVideo');
    }
}
