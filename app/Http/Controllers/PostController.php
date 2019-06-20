<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostContent;
use App\PostImage;
use App\PostTitle;
use App\PostVideo;
use App\Rating;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Request $request){
        $allEmpty = true;
        if (!empty($request->get('titles'))){
            $titles = $request->get('titles');
            $allEmpty = false;
        }
        if (!empty($request->get('contents'))){
            $contents = $request->get('contents');
            $allEmpty = false;
        }
        if (!empty($request->get('images'))){
            $images = $request->get('images');
            $allEmpty = false;
        }
        if (!empty($request->get('videos'))){
            $videos = $request->get('videos');
            $allEmpty = false;
        }
        if (!empty($request->get('surveys'))){
            if (!empty($request->get('questions'))){
                $surveys = $request->get('surveys');
                $questions = $request->get('questions');
                $allEmpty = false;
            }
        }

        if (!$allEmpty){
            $post = Post::create([
                'authorID' => Auth::id(),
                'hot' => 'false'
            ]);
            if (!empty($titles)){
                foreach ($titles as $title) {
                    PostTitle::create([

                    ]);
                }
            }
            if (!empty($contents)){
                foreach ($contents as $content) {
                    PostContent::create([

                    ]);
                }
            }
            if (!empty($images)){
                foreach ($images as $image) {
                    PostImage::create([

                    ]);
                }
            }
            if (!empty($videos)){
                foreach ($videos as $video) {
                    PostVideo::create([

                    ]);
                }
            }
            if (!empty($surveys)){
                foreach ($surveys as $survey) {
                    $allSurveys[] = Survey::create([
                                        '' => '',
                                        '' => '',
                                        '' => '',
                                    ]);
                }//надо как то у сани забрать айди квешенов и всего остального
            }
        }else {
            return json_encode(['success' => false, 'message' => 'add at least 1 section']);
        }

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id = null)
    {
        try{
            $post = Post::findOrFail(1);
        }catch (\Exception $e){
            dd($e);
            return view();//not found
        }
        $titles = $post->getAllTitles;
        if (isset($titles[0])){
            foreach ($titles as $title) {
                $fullPost[$title->order]['type'] = 'title';
                $fullPost[$title->order]['value'] = $title->titleText;
            }
        }
        $contents = $post->getAllContents;
        if (isset($contents[0])){
            foreach ($contents as $content) {
                $fullPost[$content->order]['type'] = 'content';
                $fullPost[$content->order]['value'] = $content->contentText;
            }
        }

        $images = $post->getAllImages;
        if (isset($images[0])){
            foreach ($images as $image) {
                $fullPost[$image->order]['type'] = 'image';
                $fullPost[$image->order]['value'] = $image->url;
            }
        }

        $videos = $post->getAllVideos;
        if (isset($videos[0])){
            foreach ($videos as $video) {
                $fullPost[$video->order]['type'] = 'video';
                $fullPost[$video->order]['value'] = $video->url;
            }
        }

        $imagesWithTexts = $post->getAllImagesWithTexts;
        if (isset($imagesWithTexts[0])){
            foreach ($imagesWithTexts as $section) {
                $fullPost[$section->order]['type'] = 'imageWithText';
                if (!empty($section->title)){
                    $fullPost[$section->order]['title'] = $section->title;
                }else{
                    $fullPost[$section->order]['title'] = null;
                }
                $fullPost[$section->order]['url'] = $section->url;
                $fullPost[$section->order]['imagePosition'] = $section->imagePosition;
                $fullPost[$section->order]['content'] = $section->content;
            }
        }

        $surveys = $post->getAllSurveys;
        if (isset($surveys[0])){
            foreach ($surveys as $survey) {
                $questions = $survey->getAllVariants;
                $questionsWithAnswers[$survey->order]['type'] = 'survey';

                $questionsWithAnswers[$survey->order]['surveyTitle'] = $survey->question;
                foreach ($questions as $question) {
                    $questionsWithAnswers[$survey->order]['answers'][$question->question] = count($question->answers);
                }
            }
        }

        foreach ($questionsWithAnswers as $outerKey => $questionsWithAnswer) {

            $total = 0;

            foreach ($questionsWithAnswer['answers'] as $innerKey => $answers){
                $total = $answers + $total;
            }
            foreach ($questionsWithAnswer['answers'] as $innerKey => $answers) {
                $questionsWithAnswers[$outerKey]['answers'][$innerKey] = round(($answers/$total) * 100, 1);
            }
        }

        foreach ($questionsWithAnswers as $key => $questionsWithAnswer) {
            $fullPost[$key] = $questionsWithAnswer;
        }


        ksort($fullPost);
        $previousPostId = Post::where('id', '<', $post->id)->max('id');
        $nextPostId = Post::where('id', '>', $post->id)->min('id');
        dd($fullPost);

        return view('',['post' => $fullPost, 'previousPostId' => $previousPostId, 'nextPostId' => $nextPostId]);
    }

    public function getAllPostsWithAllFilters(){
        $posts = Post::all();

        $hotPosts = Post::where('hot', 'true')->get();
        $recentPosts = Post::orderBy('created_at', 'desc')->get();

        foreach ($hotPosts as $key => $hotPost) {
            $finalHotPosts[$key]['post'] = $hotPost;
            $finalHotPosts[$key]['rating'] = round(Rating::where('id', $hotPost->id)->avg('rating'), 1);
        }

        foreach ($recentPosts as $key => $recentPost) {
            $finalRecentPosts[$key]['post'] = $recentPost;
            $finalRecentPosts[$key]['rating'] = round(Rating::where('id', $recentPost->id)->avg('rating'), 1);
        }

        foreach ($posts as $key => $post) {
            $finalAllPosts[$key]['post'] = $post;
            $finalAllPosts[$key]['rating'] = round(Rating::where('id', $post->id)->avg('rating'), 1);
        }
        $allTypesOfPosts['all'] = $finalAllPosts;
        $allTypesOfPosts['hot'] = $finalHotPosts;
        $allTypesOfPosts['recent'] = $finalRecentPosts;
        foreach ($allTypesOfPosts['recent'] as $key => $allTypesOfPost) {
            $postsToSort[$key] =  $allTypesOfPost['post'];
        }
        foreach ($allTypesOfPosts['recent'] as $key => $allTypesOfPost) {
            unset($allTypesOfPosts['recent'][$key]['post']);
            $allTypesOfPosts['recent'][$key] = $allTypesOfPost['rating'];
        }
        arsort($allTypesOfPosts['recent']);
        foreach ($allTypesOfPosts['recent'] as $key => $rating) {
            $array[$key] = $rating;
        }
        foreach ($array as $outer => $item) {
            foreach ($postsToSort as $inner => $post) {
                if ($inner == $outer) {
                    $final[$inner]['post'] = $post;
                    $final[$inner]['rating'] = $item;
                }
            }
        }
        unset($allTypesOfPosts['recent']);
        $allTypesOfPosts['recent'] = $final;
        dd($allTypesOfPosts);
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
