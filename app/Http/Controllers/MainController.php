<?php

namespace App\Http\Controllers;

use App\DisLikesForSingleImage;
use App\Emoji;
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
            $excerpt = strip_tags($excerpt);
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

//        $allTypesOfPosts['trending'] = $finalAllPosts;
//        $allTypesOfPosts['hot'] = $finalHotPosts;
//        $allTypesOfPosts['recent'] = $finalRecentPosts;
//
//        foreach ($allTypesOfPosts['trending'] as $key => $trendingPost) {
//
//            $allTrendingPosts[$key] = $trendingPost;
//            unset($allTypesOfPosts['trending'][$key]['post']);
//            $allTypesOfPosts['trending'][$key] = $trendingPost['rating'];
//        }
//        arsort($allTypesOfPosts['trending']);
//        foreach ($allTypesOfPosts['trending'] as $outerKey => $trendingPost) {
//            $tmp = ['rating' => $trendingPost, 'post' => $allTrendingPosts[$outerKey]];
//            $allTypesOfPosts['trending'][$outerKey] = $tmp;
//        }
//
//        foreach ($allTypesOfPosts['trending'] as $key => $postAndRating) {
//            $allTypesOfPosts['trending'][$key]['post'] = $postAndRating['post'];
//        }
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
                $fullPost['sections'][$image->order]['description'] = $image->description;
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
//                $flag = true;
//                if (\Auth::check()){
//                    $ass = SurveyAnswers::where('surveyId', $survey->id)->where('userId', \Auth::id())->first();
//                    if (empty($ass)){
//                        $flag = false;
//                    }
//                }
                $questions = $survey->getAllVariants;
                $questionsWithAnswers[$survey->order]['type'] = 'survey';
                $questionsWithAnswers[$survey->order]['img'] = $survey->image;
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

                $fullPost['sections'][$likableImage->order]['type'] = 'likableImage';
                $fullPost['sections'][$likableImage->order]['value'] = $data;
                unset($data);
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
                $h = Hashtag::find($hashtag->hashtagId);
                $data['id'] = $h->id;
                $data['title'] = $h->text;
                $fullPost['hashtags'][] = $data;
                unset($data);
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
        $hashtag = Hashtag::find($hashtagId);

        $postsWithContent['hashtagImg'] = $hashtag->image;
        $postsWithContent['hashtagName'] = $hashtag->text;

        foreach ($hashtagPosts as $hashtagPost) {
            if ($hashtagPost->hashtagId == $hashtagId){
                $postIds[] = $hashtagPost->postId;
            }
        }
//        dd($postIds);
        if (isset($postIds) && !empty($postIds)){
            foreach ($postIds as $postId) {
                $postsWithContent['data'][$postId] = $this->getContent($postId);
            }
            return json_encode($postsWithContent);

        }
        else{
            return json_encode(['success' => false]);
        }
    }

    public function getAllRelevantPosts(Request $request){
        $hashtagId = $request->get('hashtag_id');
        $hashtagPosts = HashtagPosts::where('hashtagId', $hashtagId)->orderBy('created_at')->take(6)->get();

        foreach ($hashtagPosts as $hashtagPost) {
            $posts[] = Post::find($hashtagPost->postId);
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
        $content = $post->getAllContents()->first();
//        $title = $post->getAllTitles()->first();
        $author = $post->author;

        if (!empty($content)){
            $excerpt = substr($content->contentText, 0, 200);
            $excerpt = strip_tags($excerpt);
        }else{
            $excerpt = '';
        }

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
        $data[(int)1] = $this->getContent($first->id);
        $data[(int)2] = $this->getContent($second->id);
        $data[(int)3] = $this->getContent($third->id);
        $data[(int)4] = $this->getContent($fourth->id);
        $data[(int)5] = $this->getContent($fifth->id);
        $data[(int)6] = $this->getContent($sixth->id);
        return json_encode($data, JSON_FORCE_OBJECT);
    }

    public function addEmojiReaction(Request $request){
//        $userId = \Auth::id();
        $postId = $request->get('postId');
        $reaction = $request->get('reaction');
//        if (!Emoji::where('postId', $postId)->where('authorId', $userId)->get()->isEmpty()){
//            Emoji::where('postId', $postId)->where('authorId', $userId)->delete();
//        }
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

        $reaction = Emoji::where('postId', $postId);
//                            ->where('authorId', $userId);

        $reactions['love']      = 0;
        $reactions['laugh']     = 0;
        $reactions['wow']       = 0;
        $reactions['cry']       = 0;
        $reactions['angry']     = 0;
        $reactions['like']      = 0;
        $reactions['dislike']   = 0;

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

        $variant = SurveyAnswerVariant::where('surveyId', $surveyId)->where('order', $answerNumber+1)->first();
//
//        $answer = SurveyAnswers::where('answer', $variant->id)->where('userId', \Auth::id())->first();
////        dd($answer);
//        if (empty($answer)){
            SurveyAnswers::create([
                'answer' => $variant->id,
//                'userId' => \Auth::id(),
                'surveyId' => $surveyId,
            ]);
            return json_encode(['success' => true]);
//        }else{
//            return json_encode(['success' => false]);
//        }
    }

    public function getRecentPosts(){
        $recentPosts = Post::orderBy('created_at', 'desc')->take(12)->get();
//        dd($recentPosts);
        foreach ($recentPosts as $recentPost) {
            $postsForView[] = $this->getContent($recentPost->id);
        }
        return json_encode($postsForView);
    }


//    public function getSingleLikablePhoto(){
//        $photo = SingleLikableImage::where('postId', 0)->first();
//
//        $likes = LikesForSingleImage::where('serviceId', $photo->id)->get();
//
//        $dislikes = DisLikesForSingleImage::where('serviceId', $photo->id)->get();
//
//        $data['image'] = $photo->url;
//        $data['likes'] = $likes->count();
//        $data['dislikes'] = $dislikes->count();
//        return json_encode($data);
//    }

    public function likeSinglePhoto(Request $request){
//        $postId = $request->get('postId');
        $serviceId = $request->get('serviceId');
        LikesForSingleImage::create([
            'serviceId' => $serviceId,
            'userId' => 0,
        ]);
    }

    public function dislikeSinglePhoto(Request $request){
//        $postId = $request->get('postId');
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
                $data['value']['imageUrl'] = $section->url;
                $data['value']['description'] = $section->description;
                $data['value']['likes'] = LikesForSingleImage::where('serviceId', $section->id)->count();
                $data['value']['dislikes'] = DisLikesForSingleImage::where('serviceId', $section->id)->count();
                return json_encode($data);
            }
            elseif ($section->getTable() == 'surveys'){
                $data['type'] = 'survey';
                $data['value']['id'] = $section->id;
                $data['value']['question'] = $section->question;
                $variants = SurveyAnswerVariant::where('surveyId', $section->id)->get();
                foreach ($variants as $variant) {
                    $allVariants['answerId'] = $variant->id;
                    $allVariants['answer'] = $variant->question;
                    $allVariants['order'] = $variant->order;
                    $allVariants['votes'] = SurveyAnswers::where('answer', $variant->id)->count();
                }
                $data['value']['answerVariants'] = $allVariants;
                return json_encode($data);
            }
            else{
                return json_encode(['success' => 'false']);
            }
        }

    }

    public function test(){
        $post = Post::find(86);
        dd($post->getCompare()->get());
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


}
