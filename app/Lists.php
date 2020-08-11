<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Tasks');
    }
}
