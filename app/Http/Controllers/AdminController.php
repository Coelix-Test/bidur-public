<?php


namespace App\Http\Controllers;


use App\Hashtag;
use App\Post;
use http\Env\Request;

class AdminController extends Controller
{
    public function getRecentPosts($offset = 0, $take = 5){
        $recentPosts = Post::orderBy('created_at', 'desc')->skip($offset)->take($take)->get();
        return json_encode($recentPosts);
    }

    public function getAllHashtags(){
        $hashtags = Hashtag::all();
        foreach ($hashtags as $key => $hashtag) {
            $hashtagArray[$key]['name'] = $hashtag->text;
            $hashtagArray[$key]['img'] = $hashtag->image;
            $hashtagArray[$key]['id'] = $hashtag->id;
        }

        return json_encode($hashtagArray);
    }

    public function deleteHashtag(\Illuminate\Http\Request $request){
        Hashtag::where('id', $request->get('id'))->delete();
        return $this->getAllHashtags();
    }

    public function addHashtag($image = 'url', $name = 'name'){
        $hashtag = Hashtag::create([
            'text' => $name,
            'image' => $image
        ]);
        return $this->getAllHashtags();
    }

    public function updateHashtag($id, $image = null, $name = null){
        Hashtag::where('id', $id)->update(['image' => $image, 'text' => $name]);
        return $this->getAllHashtags();
    }
}
