<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = 'admins';

    protected $fillable = ['userId'];

    public function getUser(){
        return$this->belongsTo(User::class, 'id', 'userId');
    }
}
