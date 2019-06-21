<?php

namespace App\Http\Controllers;

use App\PostContent;
use Illuminate\Http\Request;

class PostContentController extends Controller
{

    public function index(){
        //
    }


    public function create($content, $postId, $order){
        try{
            PostContent::create([
                'postId' => $postId,
                'contentText' => $content,
                'order' => $order,
            ]);
        }catch (\Exception $e){
            return ['success' => false, 'message' => $e->getMessage()];
        }
        return ['success' => true];
    }


    public function store(Request $request){
        //
    }


    public function show($id){
        //
    }


    public function edit($id){
        //
    }


    public function update(Request $request, $id){
        //
    }


    public function destroy($id){
        //
    }
}
