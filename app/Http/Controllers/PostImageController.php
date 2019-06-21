<?php

namespace App\Http\Controllers;

use App\PostImage;
use Illuminate\Http\Request;

class PostImageController extends Controller
{

    public function index()
    {
        //
    }


    public function create($imageUrl, $postId, $order){
        try{
            PostImage::create([
                'url' => $imageUrl,
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
