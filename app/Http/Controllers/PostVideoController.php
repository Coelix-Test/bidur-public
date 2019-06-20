<?php

namespace App\Http\Controllers;

use App\PostVideo;
use Illuminate\Http\Request;

class PostVideoController extends Controller
{

    public function index()
    {
        //
    }


    public function create($videoUrl, $postId, $order){
        try{
            PostVideo::create([
                'url' => $videoUrl,
                'postId' => $postId,
                'order' => $order,
            ]);
        }catch (\Exception $e){
            return ['success' => false, 'message' => $e->getMessage()];
        }
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
