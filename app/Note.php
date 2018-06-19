<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function images()
    {
        return $this->hasMany('App\Image','note_id','id');
    }

    public function files()
    {
        return $this->hasMany('App\File','file_id','id');
    }
}
