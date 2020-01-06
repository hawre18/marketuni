<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function photos()
    {
        return $this->belongsToMany(Photo::class,'photo_slide','slide_id','photo_id');
    }
}
