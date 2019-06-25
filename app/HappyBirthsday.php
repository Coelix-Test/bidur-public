<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HappyBirthsday extends Model
{
    protected $guarded = ['id'];
    protected $table = 'happyBirthday';
}
