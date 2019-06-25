<?php

namespace App\Http\Controllers;



use App\DisLikesForSingleImage;
use App\HappyBirthsday;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function likeSinglePhoto(Request $request){
        if(DisLikesForSingleImage::where('userId')){

        }

    }

    public function dislikePhoto(Request $request){

    }

    public function likeComparison(Request $request){

    }


}
