<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Post;
use App\Rating;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function test(){
//        dd(\Auth::id());
       dd(Admins::where('userId', \Auth::id())->first());
    }
}
