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
        $sections = $request->get('sections');

        foreach ($sections as $key => $section) {
            if ($section['type'] == 'metaTitle'){
                $metaTitle  = $section['meta-title'];
                $hashtags   = $section['celebrities']; //array
                $hot        = $section['hot']; //true-false
                $author     = $section['author'];
                $date       = $section['date'];
                $headerMeta = $this->createPostHeaderMeta($metaTitle, $hashtags, $hot, $author, $date);
            }elseif($section['type'] == 'content'){

            }
        }
        //meta
        $metaTitle = $request->get('meta-title');
        $hashtags = $request->get('celebrities'); //array
        $hot = $request->get('hot'); //true-false
        $author = $request->get('author');
        $date = $request->get('date');

        //content
        $content = $request->get('content');
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

    public function createPostAddSurvey($variants, $title, $postId, $order){

        $survey = Survey::create([
            'postId' => $postId,
            'authorId' => \Auth::id(),
            'order' => $order,
            'question' => $title
        ]);

        foreach ($variants as $key => $variant) {
            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $variant,
                'order' => $key
            ]);
        }
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


//    public function createSurvey(Request $request){
//        $vartiants = $request->get('answerVariants');
//        $title = $request->get('title');
//        $postId = $request->get('postId');
//        $order = $request->get('order');
//
//        $survey = Survey::create([
//            'postId' => $postId,
//            'authorId' => \Auth::id(),
//            'order' => $order,
//            'question' => $title
//        ]);
//
//        foreach ($vartiants as $key => $vartiant) {
//            SurveyAnswerVariant::create([
//                'surveyId' => $survey->id,
//                'question' => $vartiant,
//                'order' => $key
//            ]);
//        }
//    }

    public function getAllSurveys(){
        $allSurveys = Survey::all();

        foreach ($allSurveys as $key => $survey) {
            $all[$key]['survey'] = $survey;
            $all[$key]['variants'] = $survey->getAllVariants()->orderBy('order');
        }
        return json_encode($all);
    }
}
