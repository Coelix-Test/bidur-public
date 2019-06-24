<?php


namespace App\Http\Controllers;


use App\Hashtag;
use App\Post;
use Illuminate\Http\Request;

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

    public function deleteHashtag(Request $request){
        Hashtag::where('id', $request->get('id'))->delete();
        return $this->getAllHashtags();
    }

    public function addHashtag(Request $request){
        $hashtag = Hashtag::create([
            'text' => $request->get('text'),
            'image' => $request->get('image'),
        ]);
        return $this->getAllHashtags();
    }

    public function updateHashtag(Request $request){
        Hashtag::where('id', $request->get('id'))->update(['image' => $request->get('image'), 'text' => $request->get('text')]);
        return $this->getAllHashtags();
    }
}
