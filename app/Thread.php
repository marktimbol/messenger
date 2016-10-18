<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['from', 'to', 'body'];

    public function replies()
    {
    	return $this->hasMany(Reply::class, 'from', 'to');
    }
}
