<?php

namespace App\Http\Controllers;

use App\Admins;
use App\HappyBirthsday;
use App\Post;
use App\Rating;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{

    public function test(){
        $ass = HappyBirthsday::find(1);
//        dd($ass);
        return view('test2', ['img' => $ass->img]);
    }
}
