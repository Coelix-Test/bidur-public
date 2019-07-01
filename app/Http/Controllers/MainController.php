<?php

namespace App\Http\Controllers;

use App\Hashtag;
use App\HashtagPosts;
use App\Insta;
use App\Post;
use App\Rating;
use App\SelectOne;
use App\SingleLikableImage;
use App\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showBday(){
        $bday = Insta::find(1);
        $bdayArray['img'] = $bday->img;
        $bdayArray['text'] = $bday->text;

        return json_encode($bdayArray);
    }

    public function showAdditionalSection(){
        $likable = SingleLikableImage::where('postId', 0)->get();
        $compare = SelectOne::where('postId', 0)->get();
        $survey = Survey::where('postId', 0)->get();

        if (!empty($likable)){
            $data['image'] = $likable->url;
            $likes = $likable->getLikes();
            $dislikes = $likable->getDislikes();
            $data['likes'] = $likes;
            $data['dislikes'] = $dislikes;
            return $data;
        }
        if (!empty($compare)){

            return $data;
        }
        if (!empty($survey)){

            return $data;
        }
    }
    public function getSelectedPosts(){
        return Post::all()->take(6);
    }
    public function getInfoOnPostForMain(Request $request){
        $post = Post::find($request->get('id'));

        $thumbnail = $post->getAllImages()->first();
        $content = $post->getAllContents()->first();
        $title = $post->getAllTitles()->first();
        $author = $post->author;

        if (!empty($content)){
            $excerpt = substr($content->contentText, 0, 200);
        }else{
            $excerpt = '';
        }
        $rating = (int)$post->getRating()->avg('rating');
        $time = $post->created_at;
        $time = $time->timestamp;
        $now = Carbon::now();
        $now = $now->timestamp;
        $diff = $now - $time;
        $hours = 0;
        $days = 0;
        $weeks = 0;
        $flag = false;
        while ($diff > 3600){
            $diff = $diff - 3600;
            $hours++;
            if ($hours == 23){
                $days++;
                $hours = 0;
            }
            if ($days == 7){
                $weeks++;
                $days = 0;
            }
            if ($weeks == 4 && $days > 1){
                $flag = true;
                break;
            }
        }
        $time = $post->created_at;
        if ($flag == true){
            $createdAt = 'at '.$time->year.'-'.$time->month.'-'.$time->day;
        }else{
            if ($hours <= 23 && $days == 0 && $weeks == 0){
                if ($hours = 0){
                    $createdAt = 'just now';
                }else{
                    $createdAt = $hours.' hours ago';
                }
            }else{
                if ($days <= 6 && $weeks == 0){
                    $createdAt = $days.' days ago';
                }else{
                    if ($weeks <= 4){
                        if ($weeks == 1){
                            $createdAt = $weeks.' week ago';
                        }else{
                            $createdAt = $weeks.' weeks ago';
                        }
                    }
                }
            }
        }

        if (!empty($thumbnail)){
            $allInfo['img'] = $thumbnail->url;
        }else{
            $allInfo['img'] = '';
        }
        if (!empty($author)){
            $allInfo['author'] = $author;
        }else{
            $allInfo['author'] = '';
        }
        if (!empty($title)){
            $allInfo['title'] = $title->titleText;
        }else{
            $allInfo['title'] = '';
        }
        if (!empty($excerpt)){
            $allInfo['excerpt'] = $excerpt.'...';
        }else{
            $allInfo['excerpt'] = '';
        }
        if (!empty($createdAt)){
            $allInfo['time'] = $createdAt;
        }else{
            $allInfo['time'] = '';
        }
        if (!empty($rating)){
            $allInfo['rating'] = $rating;
        }else{
            $allInfo['rating'] = '';
        }
        $allInfo['id'] = $post->id;



        return $allInfo;
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

        $allTypesOfPosts['trending'] = $finalAllPosts;
        $allTypesOfPosts['hot'] = $finalHotPosts;
        $allTypesOfPosts['recent'] = $finalRecentPosts;

        foreach ($allTypesOfPosts['trending'] as $key => $trendingPost) {

            $allTrendingPosts[$key] = $trendingPost;
            unset($allTypesOfPosts['trending'][$key]['post']);
            $allTypesOfPosts['trending'][$key] = $trendingPost['rating'];
        }
        arsort($allTypesOfPosts['trending']);
        foreach ($allTypesOfPosts['trending'] as $outerKey => $trendingPost) {
            $tmp = ['rating' => $trendingPost, 'post' => $allTrendingPosts[$outerKey]];
            $allTypesOfPosts['trending'][$outerKey] = $tmp;
        }

        foreach ($allTypesOfPosts['trending'] as $key => $postAndRating) {
            $allTypesOfPosts['trending'][$key]['post'] = $postAndRating['post'];
        }
        //dd($allTypesOfPosts);
        return $finalAllPosts;
    }

    public function showHashtags(){
        $hashtags = Hashtag::all();
        foreach ($hashtags as $key => $hashtag) {
            $hashtagArray[$key]['name'] = $hashtag->text;
            $hashtagArray[$key]['img'] = $hashtag->image;
            $hashtagArray[$key]['id'] = $hashtag->id;
        }
        return $hashtagArray;
    }

    public function showSinglePost($id){
        try{
            $post = Post::findOrFail($id);
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
        return json_encode(['post' => $fullPost, 'nextPost' => $nextPostId, 'previousPost' => $previousPostId]);
    }

    public function showInsta(){
        $insta = Insta::find(1);
        $instaArray['img'] = $insta->imageUrl;
        $instaArray['link'] = $insta->linkToInsta;

        return json_encode($instaArray);
    }

    public function showTitles(){
        $posts = Post::all();
        foreach ($posts as $key => $post) {
            $titleObject =  $post->getAllTitles()->first();
            if (!empty($titleObject)){
                $titles[$key]['title'] = $titleObject->titleText;
                $titles[$key]['postId'] = $post->id;
            }
        }
        return $titles;
    }

    public function getAllPostsByHashtag(Request $request){
//        $posts = Post::all();
        $hashtagId = $request->get('hashtag_id');

        $hashtagPosts = HashtagPosts::all();

        foreach ($hashtagPosts as $hashtagPost) {
//            dd($hashtagId);
            if ($hashtagPost->hashtagId == $hashtagId){
                $postIds[] = $hashtagPost->postId;

            }
        }

        foreach ($postIds as $postId) {
            $postsWithContent[$postId] = $this->getContent($postId);
        }
        return json_encode($postsWithContent);

    }

    public function getContent($id){
        $post = Post::find($id);

        $thumbnail = $post->getAllImages()->first();
        $content = $post->getAllContents()->first();
        $title = $post->getAllTitles()->first();
        $author = $post->author;

        if (!empty($content)){
            $excerpt = substr($content->contentText, 0, 200);
        }else{
            $excerpt = '';
        }
        $rating = (int)$post->getRating()->avg('rating');
        $time = $post->created_at;
        $time = $time->timestamp;
        $now = Carbon::now();
        $now = $now->timestamp;
        $diff = $now - $time;
        $hours = 0;
        $days = 0;
        $weeks = 0;
        $flag = false;
        while ($diff > 3600){
            $diff = $diff - 3600;
            $hours++;
            if ($hours == 23){
                $days++;
                $hours = 0;
            }
            if ($days == 7){
                $weeks++;
                $days = 0;
            }
            if ($weeks == 4 && $days > 1){
                $flag = true;
                break;
            }
        }
        $time = $post->created_at;
        if ($flag == true){
            $createdAt = 'at '.$time->year.'-'.$time->month.'-'.$time->day;
        }else{
            if ($hours <= 23 && $days == 0 && $weeks == 0){
                if ($hours = 0){
                    $createdAt = 'just now';
                }else{
                    $createdAt = $hours.' hours ago';
                }
            }else{
                if ($days <= 6 && $weeks == 0){
                    $createdAt = $days.' days ago';
                }else{
                    if ($weeks <= 4){
                        if ($weeks == 1){
                            $createdAt = $weeks.' week ago';
                        }else{
                            $createdAt = $weeks.' weeks ago';
                        }
                    }
                }
            }
        }

        if (!empty($thumbnail)){
            $allInfo['img'] = $thumbnail->url;
        }else{
            $allInfo['img'] = '';
        }
        if (!empty($author)){
            $allInfo['author'] = $author;
        }else{
            $allInfo['author'] = '';
        }
        if (!empty($title)){
            $allInfo['title'] = $title->titleText;
        }else{
            $allInfo['title'] = '';
        }
        if (!empty($excerpt)){
            $allInfo['excerpt'] = $excerpt.'...';
        }else{
            $allInfo['excerpt'] = '';
        }
        if (!empty($createdAt)){
            $allInfo['time'] = $createdAt;
        }else{
            $allInfo['time'] = '';
        }
        if (!empty($rating)){
            $allInfo['rating'] = $rating;
        }else{
            $allInfo['rating'] = '';
        }
        $allInfo['id'] = $post->id;



        return $allInfo;
    }
}
