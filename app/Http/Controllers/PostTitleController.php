<?php

namespace App\Http\Controllers;

use App\PostTitle;
use Illuminate\Http\Request;

class PostTitleController extends Controller
{

    public function index()
    {
        //
    }


    public function create($title, $postId, $order)
    {
        try{
            PostTitle::create([
                'titleText' => $title,
                'postId' => $postId,
                'order' => $order
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
