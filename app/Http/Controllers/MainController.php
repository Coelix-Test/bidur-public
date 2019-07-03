<?php

namespace App\Http\Controllers;

use App\Emoji;
use App\Hashtag;
use App\HashtagPosts;
use App\Insta;
use App\LikesForLeftAndRight;
use App\MainSection;
use App\Post;
use App\Rating;
use App\SelectOne;
use App\SingleLikableImage;
use App\Survey;
use App\SurveyAnswers;
use App\SurveyAnswerVariant;
use App\User;
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
            $data['urlLeft'] = $compare->urlLeft;
            $data['urlRight'] = $compare->urlRight;
            $likes = LikesForLeftAndRight::where('serviceId', $compare->id)->get();
            $left = 0;
            $right = 0;
            $total = 0;
            foreach ($likes as $like) {
                $total++;
                if ($like->value == 'left'){
                    $left++;
                }else{
                    $right++;
                }
            }
            $right = (int)($right/$total) * 100;
            $left = 100 - $right;
            $data['left'] = $left;
            $data['right'] = $right;
            return $data;
        }
        if (!empty($survey)){
            $variants = $survey->getAllVariants();
            foreach ($variants as $variant) {
                $answers = $variant->answers();
                //тут надо каунтить вариатны и давать проценты но меня ебет
            }
            return 1312;
        }
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
        $createdAt = $this->getDate($post);

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

    public function showSinglePost($id =1){
        try{
            $post = Post::findOrFail($id);
        }catch (\Exception $e){
            return ['success' => false, 'message' => 'no post found'];//not found
        }
        $fullPost['mainTitle'] = $post->metaTitle;
        $titles = $post->getAllTitles;
        if (isset($titles[0])){
            foreach ($titles as $title) {
                $fullPost['sections'][$title->order]['type'] = 'title';
                $fullPost['sections'][$title->order]['value'] = $title->titleText;
            }
        }
        $contents = $post->getAllContents;
        if (isset($contents[0])){
            foreach ($contents as $content) {
                $fullPost['sections'][$content->order]['type'] = 'content';
                $fullPost['sections'][$content->order]['value'] = $content->contentText;
            }
        }

        $images = $post->getAllImages;
        if (isset($images[0])){
            foreach ($images as $image) {
                $fullPost['sections'][$image->order]['type'] = 'image';
                $fullPost['sections'][$image->order]['value'] = $image->url;
            }
        }

        $videos = $post->getAllVideos;
        if (isset($videos[0])){
            foreach ($videos as $video) {
                $fullPost['sections'][$video->order]['type'] = 'video';
                $fullPost['sections'][$video->order]['value'] = $video->url;
            }
        }

        $imagesWithTexts = $post->getAllImagesWithTexts;
        if (isset($imagesWithTexts[0])){
            foreach ($imagesWithTexts as $section) {
                $fullPost['sections'][$section->order]['type'] = 'imageWithText';
                if (!empty($section->title)){
                    $fullPost['sections'][$section->order]['title'] = $section->title;
                }else{
                    $fullPost['sections'][$section->order]['title'] = null;
                }
                $fullPost['sections'][$section->order]['url'] = $section->url;
                $fullPost['sections'][$section->order]['imagePosition'] = $section->imagePosition;
                $fullPost['sections'][$section->order]['content'] = $section->content;
            }
        }

        $surveys = $post->getAllSurveys;
        if (isset($surveys[0])){
            foreach ($surveys as $survey) {
                $questions = $survey->getAllVariants;
                $questionsWithAnswers[$survey->order]['type'] = 'survey';

                $questionsWithAnswers[$survey->order]['value']['question'] = $survey->question;
                $questionsWithAnswers[$survey->order]['id'] = $survey->id;
                $i = 0;
                $z = 0;
                foreach ($questions as $question) {
                    $questionsWithAnswers[$survey->order]['value']['answers'][$z]['value'] = $i++;
                    $questionsWithAnswers[$survey->order]['value']['answers'][$z]['text'] = $question->question;
                    $questionsWithAnswers[$survey->order]['value']['answers'][$z]['votes'] = count($question->answers);
                    $questionsWithAnswers[$survey->order]['value']['answers'][$z]['customId'] = $question->id;
                    $z++;
                }
            }
            foreach ($questionsWithAnswers as $key => $questionsWithAnswer) {
                $fullPost['sections'][$key] = $questionsWithAnswer;
            }
        }


        $fullPost['author'] = $post->author;
        $fullPost['date'] = $this->getDate($post);

        $hashtags = HashtagPosts::where('postId', $post->id)->get();

        ksort($fullPost);
        $previousPostId = Post::where('id', '<', $post->id)->max('id');
        $nextPostId = Post::where('id', '>', $post->id)->min('id');
        if (!$hashtags->isEmpty()){
            foreach ($hashtags as $hashtag) {
                $fullPost['hashtags'][] = $hashtag->hashtagId;
            }
        }

        return json_encode(['post' => $fullPost, 'nextPost' => $nextPostId, 'previousPost' => $previousPostId]);
    }

    public function getDate($post){
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
        return $createdAt;
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
            if ($hashtagPost->hashtagId == $hashtagId){
                $postIds[] = $hashtagPost->postId;
            }
        }
//        dd($postIds);
        if (isset($postIds) && !empty($postIds)){
            foreach ($postIds as $postId) {
                $postsWithContent[$postId] = $this->getContent($postId);
            }
            return json_encode($postsWithContent);

        }
        else{
            return json_encode(['success' => false]);
        }


    }

    public function getContent($id){
        $post = Post::find($id);

        $thumbnail = $post->getAllImages()->first();
        $content = $post->getAllContents()->first();
//        $title = $post->getAllTitles()->first();
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
        $allInfo['title'] = $post->metaTitle;
//        if (!empty($title)){
//            $allInfo['title'] = $title->titleText;
//        }else{
//            $allInfo['title'] = '';
//        }
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

    public function getSelectedPosts(){
        $section = MainSection::where('id', 1)->first();
        $first = Post::where('id', $section->first)->first();
        $second = Post::where('id', $section->second)->first();
        $third = Post::where('id', $section->third)->first();
        $fourth = Post::where('id', $section->fourth)->first();
        $fifth = Post::where('id', $section->fifth)->first();
        $sixth = Post::where('id', $section->sixth)->first();
        $data['1'] = $this->getContent($first->id);
        $data['2'] = $this->getContent($second->id);
        $data['3'] = $this->getContent($third->id);
        $data['4'] = $this->getContent($fourth->id);
        $data['5'] = $this->getContent($fifth->id);
        $data['6'] = $this->getContent($sixth->id);
        return $data;
    }

    public function addEmojiReaction(Request $request){
        $userId = \Auth::id();
        $postId = $request->get('postId');
        $reaction = $request->get('reaction');
        if (!Emoji::where('postId', $postId)->where('authorId', $userId)->get()->isEmpty()){
            Emoji::where('postId', $postId)->where('authorId', $userId)->delete();
        }
        Emoji::create([
            'authorId' => $userId,
            'reaction' => $reaction,
            'postId' => $postId,
        ]);
        return ['success' => true, 'reaction' => $reaction];
    }

    public function getEmojiReaction(Request $request){
        $userId = \Auth::id();
        $postId = $request->get('postId');

        $reaction = Emoji::where('postId', $postId)->where('authorId', $userId)->get();
        if (!$reaction->isEmpty()){
            return ['success' => true, 'reaction' => $reaction->reaction];
        }else{
            return ['success' => false];
        }
    }

    public function addSurveyVote(Request $request){
        $surveyId = $request->get('surveyId');
        $answerNumber = $request->get('answer');

        $variant = SurveyAnswerVariant::where('surveyId', $surveyId)->where('order', $answerNumber+1)->first();
        $answer = SurveyAnswers::where('answer', $variant->id)->first();
        if (empty($answer)){
            SurveyAnswers::create([
                'answer' => $variant->id,
                'userId' => \Auth::id(),
            ]);
            return json_encode(['success' => true]);
        }else{
            return json_encode(['success' => false]);
        }
    }
}
