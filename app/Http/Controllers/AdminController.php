<?php


namespace App\Http\Controllers;


use App\Hashtag;
use App\HashtagPosts;
use App\Post;
use App\Survey;
use App\SurveyAnswerVariant;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
//        $this->middleware('admin');
    }

    public function getRecentPosts($offset = 0, $take = 5){
        $recentPosts = Post::orderBy('created_at', 'desc')->skip($offset)->take($take)->get();
        return json_encode($recentPosts);
    }

    public function createFullPost(Request $request){
        $metaTitle = $request->get('meta-title');
        $hashtags = $request->get('celebrities'); //array
        $hot = $request->get('hot'); //true-false
        $author = $request->get('author');
        $date = $request->get('date');

        $headerMeta = $this->createPostHeaderMeta($metaTitle, $hashtags, $hot, $author, $date);

    }

    public function createPostHeaderMeta($metaTitle, $hashtags, $hot, $author, $date){
        $post = Post::create([
            'author' => $author,
            'hot' => $hot,
            'metaTitle' => $metaTitle,
            'created_at' => $date,
        ]);
        foreach ($hashtags as $hashtag) {
            HashtagPosts::create([
                'hashtagId' => $hashtag,
                'postId' => $post->id,
            ]);
        }
        return $post;
    }

    public function createPostAllContent(){

    }

    public function createPostAddImage(){

    }

    public function createPostAddTitle(){

    }

    public function createPostAddImageWithText(){

    }

    public function createPostAddSurvey(){

    }

    public function createPostAddVideo(){

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

      $image = $request->file('image');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/images/tag-images');
      $image->move($destinationPath, $name);

        $hashtag = Hashtag::create([
            'text' => $request->get('text'),
            'image' => '/images/tag-images/'.$name,
        ]);
        return $this->getAllHashtags();
    }

    public function updateHashtag(Request $request){


      $image = $request->file('image');
      $text = $request->get('text');
      $tag_id = $request->get('id');
      if($image) {
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/tag-images');
        $image->move($destinationPath, $name);
        Hashtag::where('id', $tag_id)->update(['image' => '/images/tag-images/'.$name]);
      }
      if(!empty($text) && $text != null) {
        Hashtag::where('id', $tag_id)->update(['text' => $text]);
      }
        return $this->getAllHashtags();
    }


    public function createSurvey(Request $request){
        $vartiants = $request->get('answerVariants');
        $title = $request->get('title');
        $postId = $request->get('postId');
        $order = $request->get('order');

        $survey = Survey::create([
            'postId' => $postId,
            'authorId' => \Auth::id(),
            'order' => $order,
            'question' => $title
        ]);

        foreach ($vartiants as $vartiant) {
            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $vartiant,
            ]);
        }
    }

    public function getAllSurveys(){
        $allSurveys = Survey::all();

        foreach ($allSurveys as $key => $survey) {
            $all[$key]['survey'] = $survey;
            $all[$key]['variants'] = $survey->getAllVariants();
        }
        return json_encode($all);
    }
}
