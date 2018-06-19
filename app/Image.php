<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function Note()
    {
        return $this->belongsTo('App/Note');
    }
}
