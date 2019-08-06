<?php

namespace App\Http\Controllers;

use App\DisLikesForSingleImage;
use App\Emoji;
use App\Favourites;
use App\Hashtag;
use App\HashtagPosts;
use App\Insta;
use App\LikesForLeftAndRight;
use App\LikesForSingleImage;
use App\Mail;
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
use Illuminate\Support\Facades\Hash;


/*
 *
 * ALL THE "%Second" METHODS
 * ARE FOR THE MOBILE
 *
 * REMEMBER ABOUT THE RTL
 * THE RIGHT AND LEFT ARE SWITCHED
 *
 * ALL THE AUTHOR IDS ARE 1
 * BECAUSE RHE REGISTRATION IS USELESS AND STOOOOOPID
 *
 * THE "question" IN SurveyAnswerVariants
 * ARE ACTUALLY ANSWERS, NOT QUESTIONS
 *
 * FIND THE TRASH BIN BELOW
 *
 *  */




class MainController extends Controller
{
    public function showBday(){
        $bday = Insta::find(1);
        if (empty($bday)){
            return json_encode(['success' => false]);
        }
        $bdayArray['img'] = $bday->img;
        $bdayArray['text'] = $bday->text;

        return json_encode($bdayArray);
    }


    public function getInfoOnPostForMain(Request $request){
        $post = Post::find($request->get('id'));

        $thumbnail = $post->getAllImages()->first();
        $content = $post->getAllContents()->first();
        $title = $post->getAllTitles()->first();
        $author = $post->author;

        if (!empty($content)){
            $excerpt = substr($content->contentText, 0, 200);
            $excerpt = strip_tags($excerpt);
        }else{
            $excerpt = '';
        }
        $rating = (int)$post->getRating()->avg('rating');
        //1231231232132323123123123123123
        $createdAt = $post->created_at->timestamp;

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
        $posts = Post::orderBy('created_at', 'desc')->get();

//        $hotPosts = Post::where('hot', 'true')->get();
//        $recentPosts = Post::orderBy('created_at', 'desc')->get();

//        foreach ($hotPosts as $key => $hotPost) {
//            $finalHotPosts[$key]['post'] = $hotPost;
//            $finalHotPosts[$key]['rating'] = round(Rating::where('id', $hotPost->id)->avg('rating'), 1);
//        }
//
//        foreach ($recentPosts as $key => $recentPost) {
//            $finalRecentPosts[$key]['post'] = $recentPost;
//            $finalRecentPosts[$key]['rating'] = round(Rating::where('id', $recentPost->id)->avg('rating'), 1);
//        }
        $mainSection = MainSection::find(1);

        foreach ($posts as $key => $post) {
            $finalAllPosts[$key]['post'] = $post;
            $finalAllPosts[$key]['rating'] = round(Rating::where('id', $post->id)->avg('rating'), 1);
            if ($post->id == $mainSection->first){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->second){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->third){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->fourth){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->fifth){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->sixth){
                $finalAllPosts[$key]['is_in_main_section'] = true;
            }
        }

        return $finalAllPosts;
    }

    public function showSinglePost($id){
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
//            dd(substr(strip_tags($contents[0]->contentText), 0, 50));
            $fullPost['excerpt'] = mb_substr(strip_tags($contents[0]->contentText), 0, 50);
            foreach ($contents as $content) {
                $fullPost['sections'][$content->order]['type'] = 'content';
                $fullPost['sections'][$content->order]['value'] = $content->contentText;
            }
        }

        $images = $post->getAllImages;
        if (isset($images[0])){
            $fullPost['preview'] = $images[0]->url;
            foreach ($images as $image) {
                $fullPost['sections'][$image->order]['type'] = 'image';
                $fullPost['sections'][$image->order]['value'] = $image->url;
                $fullPost['sections'][$image->order]['description'] = $image->description;
            }
        }

        $videos = $post->getAllVideos;
        if (isset($videos[0])){
            foreach ($videos as $video) {
                $fullPost['sections'][$video->order]['type'] = 'video';
                $fullPost['sections'][$video->order]['value'] = $video->url;
                $fullPost['sections'][$video->order]['description'] = $video->description;
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
                $questionsWithAnswers[$survey->order]['img'] = $survey->image;
                $questionsWithAnswers[$survey->order]['description'] = $survey->description;
//                $questionsWithAnswers[$survey->order]['value']['showResults'] = $flag;
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
        $compares = $post->getCompare;
        if (isset($compares[0])){
            foreach ($compares as $compare) {
                $data['id'] = $compare->id;
                $data['imageLeft'] = $compare->urlLeft;
                $data['imageRight'] = $compare->urlRight;
                $data['descriptionLeft'] = $compare->descriptionLeft;
                $data['descriptionRight'] = $compare->descriptionRight;
                $data['left'] = LikesForLeftAndRight::where([
                  [ 'serviceId', '=', $compare->id ],
                  [ 'value', '=', 'left' ]
                  ])->count();
                $data['right'] = LikesForLeftAndRight::where([
                  [ 'serviceId', '=', $compare->id ],
                  [ 'value', '=', 'right' ]
                  ])->count();
                $data['description'] = $compare->description;

                $fullPost['sections'][$compare->order]['type'] = 'compare';
                $fullPost['sections'][$compare->order]['value'] = $data;
                unset($data);
            }
        }

        $likableImages = $post->getLikableImage;
        if (isset($likableImages[0])){
            foreach ($likableImages as $likableImage) {
                $data['id'] = $likableImage->id;
                $data['imgUrl'] = $likableImage->url;
                $data['description'] = $likableImage->description;
                $data['likes'] = LikesForSingleImage::where('serviceId', $likableImage->id)->count();
                $data['dislikes'] = DisLikesForSingleImage::where('serviceId', $likableImage->id)->count();

                $fullPost['sections'][$likableImage->order]['type'] = 'likableImage';
                $fullPost['sections'][$likableImage->order]['value'] = $data;
                unset($data);
            }
        }

        $fullPost['author'] = $post->author;
        $fullPost['date'] = $post->created_at->timestamp;

        $hashtags = HashtagPosts::where('postId', $post->id)->get();

        ksort($fullPost);
        $previousPostId = Post::where('id', '<', $post->id)->max('id');
        $nextPostId = Post::where('id', '>', $post->id)->min('id');
        if (!$hashtags->isEmpty()){
            foreach ($hashtags as $hashtag) {
                $h = Hashtag::find($hashtag->hashtagId);
                $data['id'] = $h->id;
                $data['title'] = $h->text;
                $fullPost['hashtags'][] = $data;
                unset($data);
            }
        }

        if (\Auth::check()){
            if (!empty(Favourites::where('userId', \Auth::id())->where('postId', $post->id)->first())){
                $fullPost['is_favourite'] = true;
            }else{
                $fullPost['is_favourite'] = false;
            }
        }else{
            $fullPost['is_favourite'] = false;
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
        $page = $request->get('page');
        if ($page == 0){
            $hashtagPosts = HashtagPosts::where('hashtagId', $hashtagId)->offset(0)->take(24)->get();
        }else{
            $offset = $page * 24;
            $hashtagPosts = HashtagPosts::where('hashtagId', $hashtagId)->offset($offset)->take(24)->get();
        }


        $hashtag = Hashtag::find($hashtagId);

        $postsWithContent['hashtagImg'] = $hashtag->image;
        $postsWithContent['hashtagName'] = $hashtag->text;

        foreach ($hashtagPosts as $hashtagPost) {

            if ($hashtagPost->hashtagId == (int)$hashtagId){
                $postIds[] = $hashtagPost->postId;
            }
        }

//        dd($postIds);
        if (isset($postIds) && !empty($postIds)){
            foreach ($postIds as $postId) {
              // табуляции бля
              $kirill_spasibo = $this->getContent($postId);
              // исправь потом, а то я хз
              // if($kirill_spasibo['publish'] == 1 || $kirill_spasibo['publish'] == '1') {
                $postsWithContent['data'][$postId] = $kirill_spasibo;
              // }
            }
            return json_encode($postsWithContent);

        }
        else{
            return json_encode([$postsWithContent]);
        }
    }

    public function getAllRelevantPosts(Request $request){
        $hashtagId = $request->get('hashtag_id');
        $postId = $request->get('postId');
        $hashtagPosts = HashtagPosts::where('hashtagId', $hashtagId)->orderBy('created_at')->take(6)->get();

        foreach ($hashtagPosts as $hashtagPost) {
            $posts[] = Post::where([
                [ 'id', '=', $hashtagPost->postId ],
                [ 'publish', '=', '1' ],
                [ 'id', '!=', $postId],
            ]);
        }
        foreach ($posts as $post) {
//            dd($posts);
            $postsWithContent[] = $this->getContent($post->id);
        }
        return json_encode($postsWithContent);
    }

    public function getContent($id){
        $post = Post::find($id);
        $thumbnail = $post->getAllImages()->first();

        $author = $post->author;

        $rating = (int)$post->getRating()->avg('rating');
        $time = $post->created_at;

        $time = $time->timestamp;

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
        $allInfo['publish'] = $post->publish;

        if (!empty($time)){
            $allInfo['time'] = $time;
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
        $seven = Post::where('id', $section->seven)->first();
        $eight = Post::where('id', $section->eight)->first();
        $nine = Post::where('id', $section->nine)->first();
        $ten = Post::where('id', $section->ten)->first();

        $data[1] = $this->getContent($first->id);
        $data[2] = $this->getContent($second->id);
        $data[3] = $this->getContent($third->id);
        $data[4] = $this->getContent($fourth->id);
        $data[5] = $this->getContent($fifth->id);
        $data[6] = $this->getContent($sixth->id);
        if (isset($seven) && isset($eight) && isset($nine) && isset($ten)){
            $data[7] = $this->getContent($seven->id);
            $data[8] = $this->getContent($eight->id);
            $data[9] = $this->getContent($nine->id);
            $data[10] = $this->getContent($ten->id);
        }
        return json_encode($data, JSON_FORCE_OBJECT);
    }

    public function addEmojiReaction(Request $request){

        $postId = $request->get('postId');
        $reaction = $request->get('reaction');

        Emoji::create([
            'authorId' => 1,
            'reaction' => $reaction,
            'postId' => $postId,
        ]);
        return ['success' => true, 'reaction' => $reaction];
    }

    public function getEmojiReaction(Request $request){
//        $userId = \Auth::id();
        $postId = $request->get('postId');

        $reactions['love']      = 0;
        $reactions['laugh']     = 0;
        $reactions['wow']       = 0;
        $reactions['cry']       = 0;
        $reactions['angry']     = 0;
        $reactions['like']      = 0;
        $reactions['dislike']   = 0;


        $reaction = Emoji::where('postId', $postId);
        $love   = $reaction->where('reaction', 'love')->get();
        $reaction = Emoji::where('postId', $postId);
        $laugh  = $reaction->where('reaction', 'laugh')->get();
        $reaction = Emoji::where('postId', $postId);
        $wow    = $reaction->where('reaction', 'wow')->get();
        $reaction = Emoji::where('postId', $postId);
        $cry    = $reaction->where('reaction', 'cry')->get();
        $reaction = Emoji::where('postId', $postId);
        $angry  = $reaction->where('reaction', 'angry')->get();
        $reaction = Emoji::where('postId', $postId);
        $like   = $reaction->where('reaction', 'like')->get();
        $reaction = Emoji::where('postId', $postId);
        $dislike = $reaction->where('reaction', 'dislike')->get();

        if (!$love->isEmpty()){
            $reactions['love'] = $love->count();
        }
        if (!$laugh->isEmpty()){
            $reactions['laugh'] = $laugh->count();
        }
        if (!$wow->isEmpty()){
            $reactions['wow'] = $wow->count();
        }
        if (!$cry->isEmpty()){
            $reactions['cry'] = $cry->count();
        }
        if (!$angry->isEmpty()){
            $reactions['angry'] = $angry->count();
        }
        if (!$like->isEmpty()){
            $reactions['like'] = $like->count();
        }
        if (!$dislike->isEmpty()){
            $reactions['dislike'] = $dislike->count();
        }

        return json_encode($reactions);
    }

    public function addSurveyVote(Request $request){
        $surveyId = $request->get('surveyId');
        $answerNumber = $request->get('answer');

        $variant = SurveyAnswerVariant::where('surveyId', $surveyId)->where('order', $answerNumber)->first();


        SurveyAnswers::create([
            'answer' => $variant->id,
            'surveyId' => $surveyId,
        ]);
        return json_encode(['success' => true]);

    }

    public function getRecentPosts(Request $request){
        if ($request->get('postId') !== null){
            $postId = $request->get('postId');
            $recentPosts = Post::where('publish', 1)->where('id', '!=', $postId)->orderBy('created_at', 'desc')->take(12)->get();

        }else{
            $recentPosts = Post::where('publish', 1)->orderBy('created_at', 'desc')->take(12)->get();
        }

        $postsForView = [];

        foreach ($recentPosts as $recentPost) {
            $postsForView[] = $this->getContent($recentPost->id);

        }
        return json_encode($postsForView);
    }


    public function likeSinglePhoto(Request $request){

        $serviceId = $request->get('serviceId');
        LikesForSingleImage::create([
            'serviceId' => $serviceId,
            'userId' => 0,
        ]);
    }

    public function dislikeSinglePhoto(Request $request){

        $serviceId = $request->get('serviceId');
        DisLikesForSingleImage::create([
            'serviceId' => $serviceId,
            'userId' => 0,
        ]);
    }

    public function likeForSelectOne(Request $request){
        $serviceId = $request->get('serviceId');
        $position = $request->get('position');

        LikesForLeftAndRight::create([
            'serviceId' => $serviceId,
            'value' => $position,
            'userId' => 0,
        ]);
    }

    public function getServiceForMainPage(){
        $section = SelectOne::where('postId', 0)->first();
        if (empty($section)){
            $section = SingleLikableImage::where('postId', 0)->first();
        }
        if (empty($section)){
            $section = Survey::where('postId', 0)->first();
        }

        if (!empty($section)){

            if ($section->getTable() == 'select_ones'){
                $data['type'] = 'comparablePhotos';
                $data['value']['id'] = $section->id;
                $data['value']['description'] = $section->description;
                $data['value']['imageLeft'] = $section->urlLeft;
                $data['value']['imageRight'] = $section->urlRight;
                $likesForLeft = LikesForLeftAndRight::where('serviceId', $section->id)->where('value', 'left')->count();
                $likesForRight = LikesForLeftAndRight::where('serviceId', $section->id)->where('value', 'right')->count();
                $data['value']['likesForLeft'] = $likesForLeft;
                $data['value']['likesForLeft'] = $likesForRight;
                return json_encode($data);
            }
            elseif ($section->getTable() == 'single_likable_image'){
                $data['type'] = 'likableImage';
                $data['value']['id'] = $section->id;
                $data['value']['imgUrl'] = $section->url;
                $data['value']['description'] = $section->description;
                $data['value']['likes'] = LikesForSingleImage::where('serviceId', $section->id)->count();
                $data['value']['dislikes'] = DisLikesForSingleImage::where('serviceId', $section->id)->count();
                return json_encode($data);
            }
            elseif ($section->getTable() == 'surveys'){
                $data['type'] = 'survey';
                $data['id'] = $section->id;
                $data['image'] = $section->image;
                $data['value']['question'] = $section->question;
                $variants = SurveyAnswerVariant::where('surveyId', $section->id)->get();
                foreach ($variants as $variant) {
                    $allVariants['answerId'] = $variant->id;
                    $allVariants['text'] = $variant->question;
                    $allVariants['value'] = $variant->order;
                    $allVariants['votes'] = SurveyAnswers::where('answer', $variant->id)->count();
                    $all[] = $allVariants;
                }
                $data['value']['answers'] = $all;
                return json_encode($data);
            }
            else{
                return json_encode(['success' => 'false']);
            }
        }
    }

    public function getServiceForMainPageSecond(){
        $section = SelectOne::where('postId', -1)->first();
        if (empty($section)){
            $section = SingleLikableImage::where('postId', -1)->first();
        }
        if (empty($section)){
            $section = Survey::where('postId', -1)->first();
        }

        if (!empty($section)){

            if ($section->getTable() == 'select_ones'){
                $data['type'] = 'comparablePhotos';
                $data['value']['id'] = $section->id;
                $data['value']['description'] = $section->description;
                $data['value']['imageLeft'] = $section->urlLeft;
                $data['value']['imageRight'] = $section->urlRight;
                $likesForLeft = LikesForLeftAndRight::where('serviceId', $section->id)->where('value', 'left')->count();
                $likesForRight = LikesForLeftAndRight::where('serviceId', $section->id)->where('value', 'right')->count();
                $data['value']['likesForLeft'] = $likesForLeft;
                $data['value']['likesForLeft'] = $likesForRight;
                return json_encode($data);
            }
            elseif ($section->getTable() == 'single_likable_image'){
                $data['type'] = 'likableImage';
                $data['value']['id'] = $section->id;
                $data['value']['imageUrl'] = $section->url;
                $data['value']['description'] = $section->description;
                $data['value']['likes'] = LikesForSingleImage::where('serviceId', $section->id)->count();
                $data['value']['dislikes'] = DisLikesForSingleImage::where('serviceId', $section->id)->count();
                return json_encode($data);
            }
            elseif ($section->getTable() == 'surveys'){
                $data['type'] = 'survey';
                $data['id'] = $section->id;
                $data['image'] = $section->image;
                $data['value']['question'] = $section->question;
                $variants = SurveyAnswerVariant::where('surveyId', $section->id)->get();
                foreach ($variants as $variant) {
                    $allVariants['answerId'] = $variant->id;
                    $allVariants['text'] = $variant->question;
                    $allVariants['value'] = $variant->order;
                    $allVariants['votes'] = SurveyAnswers::where('answer', $variant->id)->count();
                    $all[] = $allVariants;
                }
                $data['value']['answers'] = $all;
                return json_encode($data);
            }
            else{
                return json_encode(['success' => 'false']);
            }
        }
    }


    public function sendMail(Request $request){
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $message = $request->get('message');
        try{
            Mail::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
            ]);
            return ['success' => true];
        }catch (\Exception $exception){
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    public function addPostToFavourite(Request $request){
        $post = Post::find($request->get('postId'));
        $user = User::find(\Auth::id());

        if (!empty(Favourites::where('userId', $user->id)->where('postId', $post->id)->first())){
            return json_encode(['success' => false]);
        }

        Favourites::create([
            'postId' => $post->id,
            'userId' => $user->id,
        ]);

    }

    public function deletePostFromFavourites(Request $request){
        $post = Post::find($request->get('postId'));
        $user = User::find(\Auth::id());

        Favourites::where('userId', $user->id)->where('postId', $post->id)->delete();
        return ['success' => true];
    }

    public function getAllFavourites(Request $request){
        $user = User::find(\Auth::id());
        $page = $request->get('page');

        if ($page == 0){
            $favPosts = Favourites::where('userId', $user->id)->take(24)->get();
        }else{
            $offset = $page * 24;
            $favPosts = Favourites::where('userId', $user->id)->offset($offset)->take(24)->get();
        }


        if (isset($favPosts)){
            foreach ($favPosts as $favPost) {
                $p = Post::find($favPost->postId);
                if (!empty($p)){
                    $posts[] = $p->id;
                }
            }

            foreach ($posts as $post) {
                $finalPosts[] = $this->getContent($post);
            }

            return json_encode($finalPosts);
        }
        return json_encode(['success' => false]);
    }


    public function getPersonalInfo(){
        if (\Auth::check()){
            $user = User::find(\Auth::id());
            $data['name'] = $user->name;
            $data['phone'] = $user->phone;
            return json_encode($data);
        }else{
            return json_encode(['success' => false]);
        }
    }

    public function checkPassword(Request $request){
        if (\Auth::check()){
            $currentPassword = User::find(\Auth::id())->password;

            $oldPassword = $request->get('oldPassword');

            if (Hash::check($oldPassword, $currentPassword)){
                return json_encode(['success' => true]);
            }else{
                return json_encode(['success' => false, 'message' => 'Passwords do not match']);
            }
        }
        return json_encode(['success' => false, 'message' => 'Login please']);
    }

    public function changePassword(Request $request){
        $newPassword = $request->get('password');

        if (\Auth::check()){
            $user = User::find(\Auth::id());
            $user->password =  Hash::make($newPassword);
            $user->save();
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false, 'message' => 'Login please']);
    }

    public function changePersonalInfo(Request $request){
        $name = $request->get('name');
        $phone = $request->get('phone');
        if (\Auth::check()){
            $user = User::find(\Auth::id());
            $user->name = $name;
            $user->phone = $phone;
            $user->save();
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false, 'message' => 'Login please']);
    }


    public function getMainPageOptimized(){
        $admin = new AdminController();
//        $recentPosts            = $this->getRecentPosts();
        $selectedPosts          = $this->getSelectedPosts();
        $serviceForDesktop      = $this->getServiceForMainPage();
        $serviceForMobile       = $this->getServiceForMainPageSecond();
        $insta                  = $this->showInsta();
        $birthday               = $this->showBday();
//        $hashtags               = $admin->getAllHashtags();
//        $user                   = $admin->getUserData();

//        $data['recentPosts']    = $recentPosts;
        $data['selectedPosts']  = $selectedPosts;
        $data['serviceDesktop'] = $serviceForDesktop;
        $data['serviceMobile']  = $serviceForMobile;
        $data['instagram']      = $insta;
        $data['birthday']       = $birthday;
//        $data['hashtags']       = $hashtags;
//        $data['user']           = $user;

        return json_encode($data);
    }

    // ************************ TRASH BIN *******************************//
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    //                                                                   //
    ///////////////////////////////////////////////////////////////////////




}
