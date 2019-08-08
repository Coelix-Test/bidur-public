<?php


namespace App\Http\Controllers;
use App\Admins;
use App\DisLikesForSingleImage;
use App\Favourites;
use App\HappyBirthsday;
use App\Hashtag;
use App\HashtagPosts;
use App\Http\Middleware\Admin;
use App\Insta;
use App\LikesForLeftAndRight;
use App\LikesForSingleImage;
use App\Mail;
use App\MainSection;
use App\Post;
use App\PostContent;
use App\PostImage;
use App\PostImageAndText;
use App\PostTitle;
use App\PostVideo;
use App\Rating;
use App\SelectOne;
use App\SingleLikableImage;
use App\Survey;
use App\SurveyAnswers;
use App\SurveyAnswerVariant;
use App\User;
use Carbon\Carbon;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


/*
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








class AdminController extends Controller
{
    protected $post;
    public function __construct()
    {
//        $this->middleware(Admin::class);
    }

    public function showAdmin(){
        return view('admin');
    }

    public function deletePost(Request $request){
        Post::find($request->get('id'))->delete();

        HashtagPosts::where('postId', $request->get('id'))->delete();
        Favourites::where('postId', $request->get('id'))->delete();
        return json_encode(['success' => true]);
    }


    public function getAllPostsPaginated(Request $request){

            $page = $request->get('page');
            if ($page == 0){
                $offset = 0;
            }else{
                $offset = 20 * $page;
            }
            $deleted = $request->get('deletedCounter');
            if (isset($deleted)){
                $offset = $offset - $deleted;
            }


        $posts = Post::orderBy('created_at', 'desc')->take(20)->offset($offset)->get();


        //mainSection for hiding the delete btn in admin page
        $mainSection = MainSection::find(1);
        if (!$posts->isEmpty()){
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
        }else{
            return json_encode(['success' => false, 'message' => 'no more posts']);
        }



    }

    // gets all the titles and ids for the line in the header
    public function getAllPostTitles(){
        $posts = Post::all();
        foreach ($posts as $key => $post) {
            $titleObject = $post->metaTitle;
            if (!empty($titleObject)){
                $titles[(int)$key]['title'] = $titleObject;
                $titles[(int)$key]['id'] = $post->id;
            }
        }

        return json_encode($titles);
    }

    //function goes through all the sections of the post and
    //creates every one of them individually, linking them to post
    public function createFullPost(Request $request){
        $sections = $request->get('sections');
        $files = $request->allFiles();

        foreach ($sections as $key => $section) {
            if ($section['type'] == 'metaTitle'){
                $metaTitle  = $section['title'];

                $hashtags = null;
                if (isset($section['celebrities'])){
                    $hashtags   = $section['celebrities']; //array
                }
                $author     = $section['author'];
                $date       = $section['date'];
                $this->post = $this->createPostHeaderMeta($metaTitle, $hashtags, $author, $date);

            }
            elseif($section['type'] == 'text'){
                $content = $section['value'];
//                dd($content);
                $this->createPostAddContent($this->post->id, $content, $key);
            }
            elseif($section['type'] == 'title'){
                $title = $section['value'];
                $this->createPostAddTitle($this->post->id, $title, $key);
            }
            elseif($section['type'] == 'video'){
                $url = $section['value'];
                $this->createPostAddVideo($this->post->id, $url, $section['description'], $key);
            }
            elseif($section['type'] == 'survey'){
//                dd($files);
                $title = $section['title'];
                $this->createPostAddSurvey($section['answers'], $title, $this->post->id, $section['description'], $key,$files['sections'][$key]['image'] );
            }
            elseif ($section['type'] == 'image'){
//                    dd($files['sections'][$key]['value']);

                $this->createPostAddImage($this->post->id, $files['sections'][$key]['value'], $section['description'], $key);
            }
            elseif ($section['type'] == 'imageWithText'){
                $this->createPostAddImageWithText(
                    $this->post->id,
                    $files['sections'][$key]['image'],
                    $section['title'],
                    $section['text'],
                    $section['imagePosition'],
                    $key
                );
//                dd($files);
            }elseif ($section['type'] == 'selection'){
                $leftFile = $files['sections'][$key]['image1'];
                $rightFile = $files['sections'][$key]['image2'];
                $leftDesc = $section['leftDescription'];
                $rightDesc = $section['rightDescription'];
                $this->createPostAddSelection($this->post->id, $leftFile, $rightFile, $section['title'], $leftDesc, $rightDesc, $key);
            }elseif ($section['type'] == 'assessment'){
                $file = $files['sections'][$key]['image'];
                $this->createPostAddSingleLikablePhoto($this->post->id, $file, $section['title'], $section['description'], $key);
            }
        }
        return json_encode(['success' => true]);
    }

    public function createPostHeaderMeta($metaTitle, $hashtags,  $author, $date){
        //parsing js timestamp
        $date = $date/1000;
        $date = Carbon::createFromTimestamp($date)->toDateTimeString();
        $random = substr(hash('md5', random_int(0, 100000)),'1', '8');
        $samePost = Post::where('share_string', $random)->first();
        if (!empty($samePost)){
            return json_encode(['success' => false, 'message' => 'rty again']);
        }

        $post = Post::create([
            'author' => $author,
            'hot' => "true",
            'metaTitle' => $metaTitle,
            'created_at' => $date,
            'share_string' => $random,
        ]);
        if (isset($hashtags)){
            foreach ($hashtags as $hashtag) {
                HashtagPosts::create([
                    'hashtagId' => $hashtag,
                    'postId' => $post->id,
                ]);
            }
        }
        return $post;
    }

    public function createPostAddContent($postId, $content, $order){
        PostContent::create([
            'postId' =>  $postId,
            'contentText' => $content,
            'order' => $order
        ]);
    }

    public function createPostAddImage($postId, $file, $description, $order, $flag = null){
        $image = $file;
        if (isset($flag)){
            $fimalImage = $file;
        }else{
            if($image) {
                $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $image->move($destinationPath, $name);
            }
        }
        $text = $description;

        if (isset($flag)){
            $img = PostImage::create([
                'postId' => $postId,
                'url' => $fimalImage,
                'description' => $text,
                'order' => $order
            ]);
        }else{
            $img = PostImage::create([
                'postId' => $postId,
                'url' => '/images/postImages/'.$name,
                'description' => $text,
                'order' => $order
            ]);
        }
    }

    public function createPostAddTitle($postId, $title, $order){
        PostTitle::create([
            'postId' =>  $postId,
            'titleText' => $title,
            'order' => $order
        ]);
    }

    public function createPostAddImageWithText($postId, $file, $title, $text, $imagePosition, $order, $flag = null){
        if (isset($flag)){
            $finalImage = $file;
        }else{
            $image = $file;
            if($image) {
                $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $image->move($destinationPath, $name);
            }
        }
        if (isset($flag)){
            PostImageAndText::create([
                'postId' => $postId,
                'url' => $finalImage,
                'title' => $title,
                'imagePosition' => $imagePosition,
                'content' => $text,
                'order' => $order,
            ]);
        }else{
            PostImageAndText::create([
                'postId' => $postId,
                'url' => '/images/postImages/'.$name,
                'title' => $title,
                'imagePosition' => $imagePosition,
                'content' => $text,
                'order' => $order,
            ]);
        }

    }

    public function createPostAddSurvey($variants, $title, $postId, $description, $order, $image, $flag = null){
        if ($flag){
            $finalImage = $image;
        }else{
            if($image) {
                $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $image->move($destinationPath, $name);
            }
        }


        if (isset($finalImage)){
            $survey = Survey::create([
                'postId' => $postId,
                'authorId' => 1,
                'order' => $order,
                'question' => $title,
                'image' => $finalImage,
                'description' => $description
            ]);
        }else{
            if (\Auth::check() == false){
                $survey = Survey::create([
                    'postId' => $postId,
                    'authorId' => 1,
                    'order' => $order,
                    'question' => $title,
                    'image' => '/images/postImages/'.$name,
                    'description' => $description
                ]);
            }else{
                $survey = Survey::create([
                    'postId' => $postId,
                    'authorId' => \Auth::id(),
                    'order' => $order,
                    'question' => $title,
                    'image' => '/images/postImages/'.$name,
                    'description' => $description
                ]);
            }
        }

        foreach ($variants as $key => $variant) {

            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $variant,
                'order' => $key+1
            ]);
        }
    }

    public function createPostAddVideo($postId, $url, $description, $order){
        PostVideo::create([
            'postId' =>  $postId,
            'url' => $url,
            'description' => $description,
            'order' => $order,
        ]);
    }

    public function createPostAddSelection($postId, $leftFile, $rightFile, $description, $leftDesc, $rightDesc, $order, $flagLeft = null, $flagRight = null){
        //remember about the rtl, left is right, right is left, dont mess up
        if ($flagLeft && $flagRight){
            $finalLeft = $leftFile;
            $finalRight = $rightFile;
        }elseif ($flagLeft){
            $finalLeft = $leftFile;
            if($rightFile) {
                $rightName = rand(0,999999).time().'.'.$rightFile->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $rightFile->move($destinationPath, $rightName);
            }
        }elseif ($flagRight){
            $finalRight = $rightFile;
            if($leftFile) {
                $leftName = rand(0,999999).time().'.'.$leftFile->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $leftFile->move($destinationPath, $leftName);
            }
        }else{
            if($leftFile) {
                $leftName = rand(0,999999).time().'.'.$leftFile->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $leftFile->move($destinationPath, $leftName);
            }
            if($rightFile) {
                $rightName = rand(0,999999).time().'.'.$rightFile->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $rightFile->move($destinationPath, $rightName);
            }
        }


        if (isset($finalLeft) && isset($finalRight)){
            SelectOne::create([
                'postId' => $postId,
                'description' => $description,
                'urlLeft' => $finalLeft,
                'urlRight' => $finalRight,
                'order' => $order,
                'descriptionRight' => $rightDesc,
                'descriptionLeft' => $leftDesc,
            ]);
        }elseif(isset($finalLeft)){
            SelectOne::create([
                'postId' => $postId,
                'description' => $description,
                'urlLeft' => $finalLeft,
                'urlRight' => '/images/postImages/'.$rightName,
                'order' => $order,
                'descriptionRight' => $rightDesc,
                'descriptionLeft' => $leftDesc,
            ]);
        }elseif (isset($finalRight)){
            SelectOne::create([
                'postId' => $postId,
                'description' => $description,
                'urlLeft' => '/images/postImages/'.$leftName,
                'urlRight' => $finalRight,
                'order' => $order,
                'descriptionRight' => $rightDesc,
                'descriptionLeft' => $leftDesc,
            ]);
        }else{
            SelectOne::create([
                'postId' => $postId,
                'description' => $description,
                'urlLeft' => '/images/postImages/'.$leftName,
                'urlRight' => '/images/postImages/'.$rightName,
                'order' => $order,
                'descriptionRight' => $rightDesc,
                'descriptionLeft' => $leftDesc,
            ]);
        }
    }

    public function createPostAddSingleLikablePhoto($postId, $file, $title, $description, $order, $flag = null){
        if ($flag){
            $finalImage = $file;
        }else{
            if($file) {
                $name = rand(0,999999).time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/images/postImages');
                $file->move($destinationPath, $name);
            }

        }

        if(isset($finalImage)){
            SingleLikableImage::create([
                'postId' => $postId,
                'description' => $title,
                'url' => $finalImage,
                'order' => $order,
                'description_image' => $description
            ]);
        }else{
            SingleLikableImage::create([
                'postId' => $postId,
                'description' => $title,
                'url' => '/images/postImages/'.$name,
                'order' => $order,
                'description_image' => $description
            ]);
        }
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
        $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
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
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/tag-images');
            $image->move($destinationPath, $name);
            Hashtag::where('id', $tag_id)->update(['image' => '/images/tag-images/'.$name]);
        }
        if(!empty($text) && $text != null) {
            Hashtag::where('id', $tag_id)->update(['text' => $text]);
        }
        return $this->getAllHashtags();
    }

    public function addHappyBirthday(Request $request){
        HappyBirthsday::truncate();
        $image = $request->file('image');
        $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/happyBirthday');
        $image->move($destinationPath, $name);
        HappyBirthsday::create([
            'text' => $request->get('text'),
            'img' => '/images/happyBirthday/'.$name,
        ]);
    }

    public function toggleHappyBirthday(){
        $happyHirthday = HappyBirthsday::find(1);
        if ($happyHirthday->visible == 1){
            $happyHirthday->visible = 0;
            $status = false;
        }else{
            $happyHirthday->visible = 1;
            $status = true;
        }
        $happyHirthday->save();
        return response()->json(['success' => true, 'status' => $status]);
    }

    //stored in the table always by the 1st id
    public function getMainBday(){
        $happy = HappyBirthsday::find(1);
        $data['img'] = $happy->img;
        $data['text'] = $happy->text;
        if ($happy->visible == 1){
            $data['visible'] = true;
        }else{
            $data['visible'] = false;
        }
        return json_encode($data);
    }

    public function addNewComparison(Request $request){
        //remember about the rtl, left is right, right is left, dont mess up
        $leftFlag = true;
        $rightFlag = true;
        $leftImage = $request->file('leftImage');
        if (isset($leftImage)){
            $leftName = rand(0,999999).time().'.'.$leftImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $leftImage->move($destinationPath, $leftName);

        }else{
            $currentLeftName = $request->get('leftImage');
            $rightFlag = false;
        }

        $rightImage = $request->file('rightImage');
        if (isset($rightImage)){
            $rightName = rand(0,999999).time().'.'.$rightImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $rightImage->move($destinationPath, $rightName);
        }else{
            $currentRightName = $request->get('rightImage');
            $rightFlag = false;
        }

        $current = SelectOne::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = SingleLikableImage::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = Survey::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        if ($leftFlag && $rightFlag){
            SelectOne::create([
                'urlRight' => '/images/compare/'.$rightName,
                'urlLeft' => '/images/compare/'.$leftName,
                'description' => $request->get('title'),
                'postId' => 0,
                'order' => 0,
            ]);
        }elseif ($rightFlag){

            SelectOne::create([
                'urlRight' => '/images/compare/'.$rightName,
                'urlLeft' => $currentLeftName,
                'description' => $request->get('title'),
                'postId' => 0,
                'order' => 0,
            ]);
        }elseif ($leftFlag){
            SelectOne::create([
                'urlRight' => $currentRightName,
                'urlLeft' => '/images/compare/'.$leftName,
                'description' => $request->get('title'),
                'postId' => 0,
                'order' => 0,
            ]);
        }else{
            SelectOne::create([
                'urlRight' => $currentRightName,
                'urlLeft' => $currentLeftName,
                'description' => $request->get('title'),
                'postId' => 0,
                'order' => 0,
            ]);
        }

        return ['success' => true];
    }

    public function addNewComparisonSecond(Request $request){
        //remember about the rtl, left is right, right is left, dont mess up
        $leftFlag = true;
        $rightFlag = true;
        $leftImage = $request->file('leftImage');


        if (isset($leftImage)){
            $leftName = rand(0,999999).time().'.'.$leftImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $leftImage->move($destinationPath, $leftName);

        }else{
            $currentLeftName = $request->get('leftImage');
            $rightFlag = false;
        }


        $rightImage = $request->file('rightImage');
        if (isset($rightImage)){
            $rightName = rand(0,999999).time().'.'.$rightImage->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $rightImage->move($destinationPath, $rightName);
        }else{
            $currentRightName = $request->get('rightImage');
            $rightFlag = false;
        }


        $current = SelectOne::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = SingleLikableImage::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = Survey::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        if ($leftFlag && $rightFlag){
            SelectOne::create([
                'urlRight' => '/images/compare/'.$rightName,
                'urlLeft' => '/images/compare/'.$leftName,
                'description' => $request->get('title'),
                'postId' => -1,
                'order' => 0,
            ]);
        }elseif ($rightFlag){

            SelectOne::create([
                'urlRight' => '/images/compare/'.$rightName,
                'urlLeft' => $currentLeftName,
                'description' => $request->get('title'),
                'postId' => -1,
                'order' => 0,
            ]);
        }elseif ($leftFlag){
            SelectOne::create([
                'urlRight' => $currentRightName,
                'urlLeft' => '/images/compare/'.$leftName,
                'description' => $request->get('title'),
                'postId' => -1,
                'order' => 0,
            ]);
        }else{
            SelectOne::create([
                'urlRight' => $currentRightName,
                'urlLeft' => $currentLeftName,
                'description' => $request->get('title'),
                'postId' => -1,
                'order' => 0,
            ]);
        }
        return ['success' => true];
    }

    public function addSinglePhoto(Request $request){
        $image = $request->file('image');
        $flag = true;
        if (isset($image)){
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/singlePhoto');
            $image->move($destinationPath, $name);
        }else{
            $currentImageUrl = $request->get('image');
            $flag = false;
        }


        $image = SingleLikableImage::where('postId', 0)->first();

        $current = SelectOne::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = SingleLikableImage::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = Survey::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }

        if (!empty($image)){
            $deletableId = $image->id;
            $image->delete();
            LikesForSingleImage::where('serviceId', $deletableId)->delete();
            DisLikesForSingleImage::where('serviceId', $deletableId)->delete();
        }
        if ($flag){
            SingleLikableImage::create([
                'url' => '/images/singlePhoto/'.$name,
                'postId' => 0,
                'description' => $request->get('title'),
                'order' => 0,
            ]);
        }else{
            SingleLikableImage::create([
                'url' => $currentImageUrl,
                'postId' => 0,
                'description' => $request->get('title'),
                'order' => 0,
            ]);
        }

        return ['success' => true];
    }

    public function addSinglePhotoSecond(Request $request){
        $image = $request->file('image');
        $flag = true;
        if (isset($image)){
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/singlePhoto');
            $image->move($destinationPath, $name);
        }else{
            $currentImageUrl = $request->get('image');
            $flag = false;
        }


        $image = SingleLikableImage::where('postId', -1)->first();

        $current = SelectOne::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = SingleLikableImage::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        $current = Survey::where('postId', -1)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }

        if (!empty($image)){
            $deletableId = $image->id;
            $image->delete();
            LikesForSingleImage::where('serviceId', $deletableId)->delete();
            DisLikesForSingleImage::where('serviceId', $deletableId)->delete();
        }
        if ($flag){
            SingleLikableImage::create([
                'url' => '/images/singlePhoto/'.$name,
                'postId' => -1,
                'description' => $request->get('title'),
                'order' => 0,
            ]);
        }else{
            SingleLikableImage::create([
                'url' => $currentImageUrl,
                'postId' => -1,
                'description' => $request->get('title'),
                'order' => 0,
            ]);
        }

        return ['success' => true];
    }

    public function addNewSurveyToMain(Request $request){
        $title = $request->get('title');
        $answers = json_decode($request->get('answers'));

        $flag = true;
        $image = $request->file('image');
        if (isset($image)){
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $image->move($destinationPath, $name);
        }else{
            $currentSurveyImage = $request->get('image');
            $flag = false;
        }



        $currentSurvey = Survey::where('postId', 0)->first();
        if (isset($currentSurvey)){
            $deletableId = $currentSurvey->id;
        }
        Survey::where('postId', 0)->delete();
        SelectOne::where('postId', 0)->delete();
        SingleLikableImage::where('postId', 0)->delete();
        if (isset($currentSurvey)){
            SurveyAnswerVariant::where('surveyId', $deletableId)->delete();
        }

        if ($flag){
            $survey = Survey::create([
                'postId' => 0,
                'authorId' => 1,
                'order' => 1,
                'question' => $title,
                'image' => '/images/compare/'.$name
            ]);
        }else{
            $survey = Survey::create([
                'postId' => 0,
                'authorId' => 1,
                'order' => 1,
                'question' => $title,
                'image' => $currentSurveyImage
            ]);
        }


        foreach ($answers as $key => $answer) {
            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $answer,
                'order' => $key+1,
            ]);
        }
        return json_encode(['success' => true]);
    }

    public function addNewSurveyToMainSecond(Request $request){
        $title = $request->get('title');
        $answers = json_decode($request->get('answers'));

        $flag = true;
        $image = $request->file('image');
        if (isset($image)){
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/compare');
            $image->move($destinationPath, $name);
        }else{
            $currentSurveyImage = $request->get('image');
            $flag = false;
        }



        $currentSurvey = Survey::where('postId', -1)->first();
        if (isset($currentSurvey)){
            $deletableId = $currentSurvey->id;
        }
        Survey::where('postId', -1)->delete();
        SelectOne::where('postId', -1)->delete();
        SingleLikableImage::where('postId', -1)->delete();
        if (isset($currentSurvey)){
            SurveyAnswerVariant::where('surveyId', $deletableId)->delete();
        }

        if ($flag){
            $survey = Survey::create([
                'postId' => -1,
                'authorId' => 1,
                'order' => 1,
                'question' => $title,
                'image' => '/images/compare/'.$name
            ]);
        }else{
            $survey = Survey::create([
                'postId' => -1,
                'authorId' => 1,
                'order' => 1,
                'question' => $title,
                'image' => $currentSurveyImage
            ]);
        }


        foreach ($answers as $key => $answer) {
            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $answer,
                'order' => $key+1,
            ]);
        }
        return json_encode(['success' => true]);
    }
    public function getAllSurveys(){

        $allSurveys = Survey::orderBy('created_at', 'desc')->get();


        if ($allSurveys->isEmpty()){
            return json_encode(['success' => false]);
        }
        foreach ($allSurveys as $key => $survey) {
            $variants = SurveyAnswerVariant::where('surveyId', $survey->id)->orderBy('order')->get();
            foreach ($variants as $variant) {
                $data['id'] = $variant->id;
                $data['variant'] = $variant->question;
                $data['order'] = $variant->order;
                $data['votes'] = SurveyAnswers::where('answer', $variant->id)->count();
                $allVariants[] = $data;
            }
            $all[$key]['survey'] = $survey;
            if (isset($allVariants)){
                $all[$key]['variants'] = $allVariants;
            }
            unset($data);
            unset($allVariants);
        }
        return json_encode($all);
    }


    public function editSurvey(Request $request){
        $survey = $request->get('survey');
        $surveyObject = Survey::where('id', $survey['survey']['id'])->first();
        $surveyObject->question = $survey['survey']['question'];
        $surveyObject->save();

        foreach ($survey['variants'] as $variant) {
            $v = SurveyAnswerVariant::where('id', $variant['id'])->first();
            $v->question = $variant['variant'];
            $v->save();
        }

        return $this->getAllSurveys();
    }

    public function editSurveyEditImage(Request $request){
        $files = $request->allFiles();
        if(isset($files['image'])){
            $image = $request->file('image');
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/postImages');
            $image->move($destinationPath, $name);
        }
        $id = $request->get('id');

        $surveyObject = Survey::find($id);
        if (isset($name)){
            $surveyObject->image = '/images/postImages/'.$name;
            $surveyObject->save();
        }
    }


    public function showAllAdmins(){
        $users = User::all();

        foreach ($users as $user) {
            $allUsers[$user->id]['email'] = $user->email;
            $allUsers[$user->id]['name']  = $user->email;
            $allUsers[$user->id]['name'] = $user->name;
            $allUsers[$user->id]['phone'] = $user->phone;
            $allUsers[$user->id]['id'] = $user->id;
            if ($user->isOnline() == false){
                $allUsers[$user->id]['status'] = 'offline';
            }else{
                $allUsers[$user->id]['status'] = 'online';
            }
            $admins = Admins::all();
            foreach ($allUsers as $key => $allUser) {
                foreach ($admins as $admin) {
                    if ($allUser['id'] == $admin->userId){
                        $allUsers[$key]['is_admin'] = true;
                        if(\Auth::id() == $allUser['id']){
                            $allUsers[$key]['is_current_user'] = true;
                        }
                    }
                }
            }
        }
        if (empty($allUsers)){
            $allUsers = [];
        }
        return json_encode($allUsers);
    }

    public function editAdmin(Request $request){
        $name   = $request->get('name');
        $email  = $request->get('email');
        $phone  = $request->get('phone');
        $id     = $request->get('userId');
        $admin = User::find($id);
        if (isset($name)){
            $admin->name = $name;
        }
        if (isset($email)){
            $admin->email = $email;
        }
        if (isset($phone)){
            $admin->phone = $phone;
        }
        $admin->save();
        return $this->showAllAdmins();
    }

    public function deleteAdmin(Request $request){
        $id = $request->get('userId');
        User::find($id)->delete();
        return $this->showAllAdmins();
    }

    public function makeUserAdmin(Request $request){

        $admin = Admins::where('userId', $request->get('userId'))->first();
        if (empty($admin)){
            Admins::create([
                'userId' => $request->get('userId'),
            ]);
        }else{
            Admins::where('userId', $request->get('userId'))->delete();
        }
        return $this->showAllAdmins();
    }

    public function createInsta(Request $request){
        Insta::truncate();
        $image = $request->file('imageUrl');
        $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/insta');
        $image->move($destinationPath, $name);

        $link = $request->get('linkToInsta');

        $insta = Insta::create([
            'id' => 1,
            'linkToInsta' => $link,
            'imageUrl' => '/images/insta/'.$name,
        ]);

        return json_encode(['success' => true, 'insta' => $insta]);
    }

    public function getUserData(){
        if (\Auth::check() == true){
            $user = User::find(\Auth::id());
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['id'] = \Auth::id();
            $admin = Admins::where('userId', $user->id)->first();

            empty($admin) ? $data['is_admin'] = false : $data['is_admin'] = true;

            return json_encode(['login' => true, 'data' => $data]);
        }else{
            return json_encode(['login' => false]);
        }
    }

    public function editMainPagePosts(Request $request){
        $mainPostId = $request->get(    'mainPostId');
        $secondPostId = $request->get(  'secondPostId');
        $thirdPostId = $request->get(   'thirdPostId');
        $fourthPostId = $request->get(  'fourthPostId');
        $fifthPostId = $request->get(   'fifthPostId');
        $sixthPostId = $request->get(   'sixthPostId');
        // truncate MEANS "TO EMPTY"

        $seventhPostId = $request->get('seventhPostId');
        $eighthPostId = $request->get('eighthPostId');
        $ninthPostId = $request->get('ninthPostId');
        $tenthPostId = $request->get('tenthPostId');
        MainSection::truncate();
        if (isset($secondPostId) && isset($eighthPostId) && isset($ninthPostId) && isset($tenthPostId)){
            MainSection::create([
                'id' => 1,
                'first' => $mainPostId,
                'second' => $secondPostId,
                'third' => $thirdPostId,
                'fourth' => $fourthPostId,
                'fifth' => $fifthPostId,
                'sixth' => $sixthPostId,
                'seven' => $seventhPostId,
                'eight' => $eighthPostId,
                'nine' => $ninthPostId,
                'ten' => $tenthPostId
            ]);
        }else{
            MainSection::create([
                'id' => 1,
                'first' => $mainPostId,
                'second' => $secondPostId,
                'third' => $thirdPostId,
                'fourth' => $fourthPostId,
                'fifth' => $fifthPostId,
                'sixth' => $sixthPostId,
            ]);
        }

    }



    public function addSurvey(Request $request){
        Survey::where('postId', 0)->delete();
        $title = $request->get('title');
        $answers = $request->get('answers');
        $image = $request->allFiles();
    }


    public function getAllMails(){
        $mails = Mail::orderBy('created_at', 'desc')->get();

        foreach ($mails as $mail) {
            $id = $mail->id;
            $name = $mail->name;
            $email = $mail->email;
            $phone = $mail->phone;
            $message = $mail->message;
            $data[] = [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
            ];
        }
        if (!empty($data)){
            return json_encode($data);
        }
    }

    public function deleteMail(Request $request){
        Mail::where('id', $request->get('id'))->delete();
        return $this->getAllMails();
    }

    public function showEditablePostContent(Request $request){
//        dd($request);
        $id = $request->get('id');

        $post = Post::find($id);

        $fullPost['mainTitle'] = $post->metaTitle;
        $titles = $post->getAllTitles;
        $hashtags = HashtagPosts::where('postId', $id)->get();
        foreach ($hashtags as $key => $hashtag) {
            $ht = Hashtag::find($hashtag->hashtagId);
            $hashtagData[$key]['id'] = $ht->id;
            $hashtagData[$key]['title'] = $ht->text;
        }
        if (isset($titles[0])){
            foreach ($titles as $title) {
                $fullPost['sections'][$title->order]['type'] = 'title';
                $fullPost['sections'][$title->order]['value'] = $title->titleText;
            }
        }
        if (isset($hashtagData)){
            $fullPost['hashtags'] = $hashtagData;
        }
        $contents = $post->getAllContents;
        if (isset($contents[0])){
            foreach ($contents as $content) {
                $fullPost['sections'][$content->order]['type'] = 'text';
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
                $fullPost['sections'][$section->order]['image'] = $section->url;
                $fullPost['sections'][$section->order]['imagePosition'] = $section->imagePosition;
                $fullPost['sections'][$section->order]['text'] = $section->content;
            }
        }

        $surveys = $post->getAllSurveys;
        if (isset($surveys[0])){
            foreach ($surveys as $key => $survey) {
                $questions = $survey->getAllVariants;
                $questionsWithAnswers['type'] = 'survey';
                $questionsWithAnswers['image'] = $survey->image;
                $questionsWithAnswers['description'] = $survey->description;

                $questionsWithAnswers['title'] = $survey->question;
                $questionsWithAnswers['id'] = $survey->id;
                foreach ($questions as $key2 => $question) {
                    $ass[$key2] = $question->question;
                }
                $questionsWithAnswers['answers'] = $ass;
                unset($ass);
                $fullPost['sections'][$survey->order] = $questionsWithAnswers;

            }
        }
        $compares = $post->getCompare;
        if (isset($compares[0])){
            foreach ($compares as $compare) {

                $fullPost['sections'][$compare->order]['type'] = 'selection';
                $fullPost['sections'][$compare->order]['id']     = $compare->id;
                $fullPost['sections'][$compare->order]['image1'] = $compare->urlLeft;
                $fullPost['sections'][$compare->order]['image2'] = $compare->urlRight;
                $fullPost['sections'][$compare->order]['leftDescription'] = $compare->descriptionLeft;
                $fullPost['sections'][$compare->order]['rightDescription'] = $compare->descriptionRight;
                $fullPost['sections'][$compare->order]['title']  = $compare->description;
                unset($data);
            }
        }

        $likableImages = $post->getLikableImage;
        if (isset($likableImages[0])){
            foreach ($likableImages as $likableImage) {
                $data['id'] = $likableImage->id;
                $data['imgUrl'] = $likableImage->url;
                $data['description'] = $likableImage->description;

                $fullPost['sections'][$likableImage->order]['type'] = 'assessment';
                $fullPost['sections'][$likableImage->order]['image'] = $likableImage->url;
                $fullPost['sections'][$likableImage->order]['title'] = $likableImage->description;
                $fullPost['sections'][$likableImage->order]['description'] = $likableImage->description_image;
                unset($data);
            }
        }

        $fullPost['author'] = $post->author;
        $fullPost['publish'] = $post->publish;
        $fullPost['date'] = $post->created_at->timestamp;

        $hashtags = HashtagPosts::where('postId', $post->id)->get();

        ksort($fullPost);

        return $fullPost;

    }


    public function editPostCreateAllSections(Request $request){
        $currentId = $request->get('id');
        $post = Post::find($currentId);
        $currentCreatedAt = $post->created_at;
//        dd($request);

        Post::where('id', $currentId)->delete();
        PostTitle::where('postId', $currentId)->delete();
        PostContent::where('postId', $currentId)->delete();
        PostImage::where('postId', $currentId)->delete();
        PostImageAndText::where('postId', $currentId)->delete();
        PostVideo::where('postId', $currentId)->delete();
        SelectOne::where('postId', $currentId)->delete();
        SingleLikableImage::where('postId', $currentId)->delete();
        Survey::where('postId', $currentId)->delete();

        $sections = $request->get('sections');
        $files = $request->allFiles();

        foreach ($sections as $key => $section) {
            if ($section['type'] == 'metaTitle'){
                $metaTitle  = $section['title'];

                $hashtags = null;
                if (isset($section['celebrities'])){
                    $hashtags   = $section['celebrities']; //array
                }
                $author     = $section['author'];
                $date       = $section['date'];;
                $this->post = $this->editPostHeaderMeta($metaTitle, $hashtags, $author, $date, $currentId);

            }
            elseif($section['type'] == 'text'){
                $content = $section['value'];
//                dd($content);
                $this->createPostAddContent($this->post->id, $content, $key);
            }
            elseif($section['type'] == 'title'){
                $title = $section['value'];
                $this->createPostAddTitle($this->post->id, $title, $key);
            }
            elseif($section['type'] == 'video'){
                $url = $section['value'];
                $description = $section['description'];
                $this->createPostAddVideo($this->post->id, $url, $description, $key);
            }
            elseif($section['type'] == 'survey'){
//                dd($files);
                $title = $section['title'];
                if (isset($files['sections'][$key]['image'])){
                    $this->createPostAddSurvey($section['answers'], $title, $this->post->id, $section['description'], $key,$files['sections'][$key]['image'] );
                }else{
                    $this->createPostAddSurvey($section['answers'], $title, $this->post->id, $section['description'], $key,$section['image'], true );
                }
            }
            elseif ($section['type'] == 'image'){

//                    dd($files['sections'][$key]['value']);
                if (isset($files['sections'][$key]['value'])){
                    $this->createPostAddImage($this->post->id, $files['sections'][$key]['value'], $section['description'], $key);
                }else{
                    $this->createPostAddImage($this->post->id, $section['value'], $section['description'], $key, true);
                }
            }
            elseif ($section['type'] == 'imageWithText'){

                if (isset($files['sections'][$key]['image'])){
                    $this->createPostAddImageWithText(
                        $this->post->id,
                        $files['sections'][$key]['image'],
                        $section['title'],
                        $section['text'],
                        $section['imagePosition'],
                        $key
                    );
                }else{
                    $this->createPostAddImageWithText(
                        $this->post->id,
                        $section['image'],
                        $section['title'],
                        $section['text'],
                        $section['imagePosition'],
                        $key,
                        true
                    );
                }

//                dd($files);
            }
            elseif ($section['type'] == 'selection'){
                $leftDesc = $section['leftDescription'];
                $rightDesc = $section['rightDescription'];
                if (isset($files['sections'][$key]['image1']) && isset($files['sections'][$key]['image2'])){
                    $leftFile = $files['sections'][$key]['image2'];
                    $rightFile = $files['sections'][$key]['image1'];
//                    createPostAddSelection($postId, $leftFile, $rightFile, $description, $leftDesc, $rightDesc, $order, $flagLeft = null, $flagRight = null)
                    $this->createPostAddSelection($this->post->id, $leftFile, $rightFile, $section['title'], $leftDesc, $rightDesc, $key);
                }elseif (isset($files['sections'][$key]['image1'])){ //только правая
                    $rightFile = $files['sections'][$key]['image1'];
                    $this->createPostAddSelection($this->post->id, $section['image2'], $rightFile, $section['title'], $leftDesc, $rightDesc, $key, true, false);
                }elseif (isset($files['sections'][$key]['image2'])){
                    $leftFile = $files['sections'][$key]['image2'];
                    $this->createPostAddSelection($this->post->id, $leftFile, $section['image1'], $section['title'], $leftDesc, $rightDesc, $key,  false, true);
                }else{
                    $this->createPostAddSelection($this->post->id, $section['image1'], $section['image2'], $section['title'], $leftDesc, $rightDesc, $key,true, true);
                }
            }
            elseif ($section['type'] == 'assessment'){
                if (isset($files['sections'][$key]['image'])){
                    $file = $files['sections'][$key]['image'];
                    $this->createPostAddSingleLikablePhoto($this->post->id, $file, $section['title'], $section['description'],$key);
                }else{
                    $this->createPostAddSingleLikablePhoto($this->post->id, $section['image'], $section['title'], $section['description'], $key, true);
                }

            }
        }

        $post = Post::find(intval($currentId));
        $post->publish = $request->get('publish');
        $post->save();

        return json_encode([ 'success' => true ]);

    }

    public function editPostHeaderMeta($metaTitle, $hashtags,  $author, $date, $id){
        $date = $date/1000;
        $date = Carbon::createFromTimestamp($date)->toDateTimeString();

        $post = Post::create([
            'id' => $id,
            'author' => $author,
            'hot' => "false",
            'metaTitle' => $metaTitle,
            'created_at' => $date,
        ]);
//        dd($post);
        HashtagPosts::where('postId', $post->id)->delete();
        if (isset($hashtags)){
            foreach ($hashtags as $hashtag) {
                HashtagPosts::create([
                    'hashtagId' => $hashtag,
                    'postId' => $post->id,
                ]);
            }
        }

        return $post;
    }


    public function postTitleSerach(Request $request){
        $title = $request->get('title');
        $posts = Post::where('metaTitle', $title)->orWhere('metaTitle', 'like', '%'.$title.'%')->get();
        if ($posts->isEmpty()){
            return json_encode(['success' => false]);
        }
        $mainSection = MainSection::find(1);
        foreach ($posts as $key => $post) {
            $finalAllPosts[$key]['post'] = $post;
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
        return json_encode($finalAllPosts);

    }


    public function userSearch(Request $request){
        $search = $request->get('search');
        $users = User::where('name', $search)->orWhere('name', 'like', '%'.$search.'%')->orWhere('email', $search)->orWhere('email', 'like', '%'.$search.'%')->get();
        if ($users->isEmpty()){
            return json_encode(['success' => false]);
        }

        foreach ($users as $key => $user) {
            $admin = Admins::where('userId', $user->id)->first();
            $finalAllUsers[$key]['email'] = $user->email;
            $finalAllUsers[$key]['id'] = $user->id;
            if (!empty($admin)){
                $finalAllUsers[$key]['is_admin'] = true;
            }else{
                $finalAllUsers[$key]['is_admin'] = false;
            }
            $finalAllUsers[$key]['name'] = $user->name;
            $finalAllUsers[$key]['phone'] = $user->phone;
            $finalAllUsers[$key]['status'] = $user->isOnline();
//            $finalAllUsers[$key]['email'] = $user->email;
        }

        return json_encode($finalAllUsers);

    }


    public function testExel(){
        $reader = new Xlsx();
        ini_set('max_execution_time', 18000);
        try{
            $spreadsheet = $reader->load("D:\OSPanel\domains\\newspaper\ass.xlsx");
        }catch (\Exception $e){
            dd($e->getMessage());
        }
        $cells = $spreadsheet->getAllSheets();
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'M', 'N', 'O', 'P'];
//        foreach ($columns as $column) {
            for ($i = 2; $i < 1109; $i++){
                echo $spreadsheet->getActiveSheet()->getCell('D'.$i)->getValue();
                echo '<br>';
                $title =  strip_tags($spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue());
                $author = $spreadsheet->getActiveSheet()->getCell('F'.$i)->getValue();
                if (!empty($author)){
                    $post = Post::create([
                        'author' => $author,
                        'hot' => 'false',
                        'metaTitle' => $title
                    ]);
                }else{
                    $post = Post::create([
                        'author' => 'israel-bidur',
                        'hot' => 'false',
                        'metaTitle' => $title
                    ]);
                }
//
                $content = $spreadsheet->getActiveSheet()->getCell('C'.$i)->getValue();
                if (isset($content)){
                    PostContent::create([
                        'postId' => $post->id,
                        'contentText' => $content,
                        'order' => 1
                    ]);
                }
//
                $thumbnail = $spreadsheet->getActiveSheet()->getCell('D'.$i)->getValue();
                $description = $spreadsheet->getActiveSheet()->getCell('P'.$i)->getValue();
                if (isset($thumbnail)){
                    if (isset($description)){
                        PostImage::create([
                            'postId' => $post->id,
                            'url' => $thumbnail,
                            'order' => 2,
                            'description' => $description
                        ]);
                    }else{
                        PostImage::create([
                            'postId' => $post->id,
                            'url' => $thumbnail,
                            'order' => 2,
                        ]);
                    }
                }

                $surveyImage = $spreadsheet->getActiveSheet()->getCell('I'.$i)->getValue();
                $surveyTitle = $spreadsheet->getActiveSheet()->getCell('N'.$i)->getValue();
                $surveyLikes = $spreadsheet->getActiveSheet()->getCell('R'.$i)->getValue();
                $surveyDislikes = $spreadsheet->getActiveSheet()->getCell('S'.$i)->getValue();
//
                if (isset($surveyImage) && isset($surveyTitle)){
                    $survey = SingleLikableImage::create([
                        'url' => $surveyImage,
                        'postId' => $post->id,
                        'description' => $surveyTitle,
                        'order' => 3,
                    ]);
                }
//
                if (isset($survey) && isset($surveyLikes)){
                    for ($inner = 0; $inner < (int)$surveyLikes; $inner++){
                        LikesForSingleImage::create([
                            'userId' => 0,
                            'serviceId' => $survey->id,
                        ]);
                    }
                }

                if (isset($survey) && isset($surveyDislikes)){
                    for ($inner = 0; $inner < (int)$surveyDislikes; $inner++){
                        DisLikesForSingleImage::create([
                            'userId' => 0,
                            'serviceId' => $survey->id,
                        ]);
                    }
                }
//
//
//                echo '<hr>';
            }
//        }

//        dd($spreadsheet->getActiveSheet()->getCell('C9')->getValue());

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


    public function tagNameSearch(Request $request){
        $search = $request->get('title');
        $tags = Hashtag::where('text', $search)->orWhere('text', 'like', '%'.$search.'%')->get();

        if ($tags->isEmpty()){
            return json_encode(['success' => false]);
        }

        foreach ($tags as $key => $tag) {
            $finalTags[$key]['id'] = $tag->id;
            $finalTags[$key]['img'] = $tag->image;
            $finalTags[$key]['name'] = $tag->text;
        }
        return json_encode($finalTags);
    }


    public function showSinglePhotoFromMain(){
        $image = SingleLikableImage::where('postId', 0)->first();
        $data['image'] = $image->url;
        return json_encode($data);
    }

    public function showCompareFromMain(){
        $section = SelectOne::where('postId', 0)->first();
        $data['leftImage'] = $section->urlLeft;
        $data['rightImage'] = $section->urlRight;
        return json_encode($data);
    }

    public function showSinglePhotoFromMainSecond(){
        $image = SingleLikableImage::where('postId', -1)->first();
        $data['image'] = $image->url;
        return json_encode($data);
    }

    public function showCompareFromMainSecond(){
        $section = SelectOne::where('postId', -1)->first();
        $data['leftImage'] = $section->urlLeft;
        $data['rightImage'] = $section->urlRight;
        return json_encode($data);
    }

    public function addAllRandoms(){
        $posts = Post::all();
        foreach ($posts as $post) {
            $flag = false;
            while ($flag == false){
                $random = substr(hash('md5', random_int(0, 100000)),'1', '8');
                $samePost = Post::where('share_string', $random)->first();
                if (empty($samePost)){
                    $flag = true;
                }
            }
            $post->share_string = $random;
            $post->save();
        }
    }
}
