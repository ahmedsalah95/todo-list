<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function Note()
    {
        return $this->belongsTo('App/Note');
    }
}
