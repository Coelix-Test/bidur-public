<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request = null){

//        $rating = $request->get('rating');
//        $postId = $request->get('id');
//        $userId = \Auth::id();

        $rating = 3;
        $postId = 1;
        $userId = 1;
        $ratingObject = Rating::where('postId', $postId)->where('userId', $userId)->first();
        if (empty($ratingObject)){
            try{
                $ratingObject = Rating::create([
                    'postId' => $postId,
                    'rating' => $rating,
                    'userId' => $userId,
                ]);
            }catch (\Exception $e){
                return ['success' => false, 'message' => $e->getMessage()];
            }
            return ['success' => true];
        }else{
            $ratingObject->rating = $rating;
            $ratingObject->save();
        }
        dd($ratingObject);
        return ['success' => true];

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
