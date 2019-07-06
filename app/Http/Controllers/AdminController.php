<?php


namespace App\Http\Controllers;
use App\Admins;
use App\DisLikesForSingleImage;
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
use App\SelectOne;
use App\SingleLikableImage;
use App\Survey;
use App\SurveyAnswers;
use App\SurveyAnswerVariant;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $c = new MainController();
        return $c->getAllPostsWithAllFilters();
    }


    public function getAllPosts(Request $request ){
//        $offset = 3;

        if (!empty($request->get('offset'))){
            $offset = $request->get('offset');
        }else{
            $offset = 0;
        }

        $posts = Post::offset($offset)->limit(20)->orderBy('created_at', 'desc')->get();

        foreach ($posts as $key => $post) {
            $allPosts[$key]['title'] = $post->metaTitle;
            $allPosts[$key]['author'] = $post->author;

            $time = $post->created_at;
            $time = $time->timestamp;
            $mainSection = MainSection::find(1);
            if ($post->id == $mainSection->first){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->second){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->third){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->fourth){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->fifth){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            if ($post->id == $mainSection->sixth){
                $allPosts[$key]['is_in_main_section'] = true;
            }
            $allPosts[$key]['createdAt'] = $time;
        }
        return json_encode($allPosts);
    }

    public function getRecentPosts($offset = 0, $take = 5){
        $recentPosts = Post::orderBy('created_at', 'desc')->skip($offset)->take($take)->get();
        return json_encode($recentPosts);
    }

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

    public function createFullPost(Request $request){
        $sections = $request->get('sections');
        $files = $request->allFiles();
        foreach ($sections as $key => $section) {
            if ($section['type'] == 'metaTitle'){
                $metaTitle  = addslashes($section['title']);

                $hashtags = null;
                if (isset($section['celebrities'])){
                    $hashtags   = $section['celebrities']; //array
                }
                $author     = addslashes($section['author']);
                $date       = $section['date'];
                $this->post = $this->createPostHeaderMeta($metaTitle, $hashtags, $author, $date);

            }
            elseif($section['type'] == 'text'){
                $content = addslashes($section['value']);
//                dd($content);
                $this->createPostAddContent($this->post->id, $content, $key);
            }
            elseif($section['type'] == 'title'){
                $title = addslashes($section['value']);
                $this->createPostAddTitle($this->post->id, $title, $key);
            }
            elseif($section['type'] == 'video'){
                $url = $section['value'];
                $this->createPostAddVideo($this->post->id, $url, $key);
            }
            elseif($section['type'] == 'survey'){
//                dd($files);
                $title = addslashes($section['title']);
                $this->createPostAddSurvey($section['answers'], $title, $this->post->id, $key,$files['sections'][$key]['image'] );
            }
            elseif ($section['type'] == 'image'){
//                    dd($files['sections'][$key]['value']);

                $this->createPostAddImage($this->post->id, $files['sections'][$key]['value'], addslashes($section['description']), $key);
            }
            elseif ($section['type'] == 'imageWithText'){
                $this->createPostAddImageWithText(
                    $this->post->id,
                    $files['sections'][$key]['image'],
                    addslashes($section['title']),
                    addslashes($section['text']),
                    $section['imagePosition'],
                    $key
                );
//                dd($files);
            }elseif ($section['type'] == 'selection'){
                $leftFile = $files['sections'][$key]['image1'];
                $rightFile = $files['sections'][$key]['image2'];
                $this->createPostAddSelection($this->post->id, $leftFile, $rightFile, addslashes($section['title']), $key);
            }elseif ($section['type'] == 'assessment'){
                $file = $files['sections'][$key]['image'];
                $this->createPostAddSingleLikablePhoto($this->post->id, $file, addslashes($section['title']), $key);
            }
        }
        return json_encode(['success' => true]);
    }

    public function createPostHeaderMeta($metaTitle, $hashtags = null,  $author, $date){
        $date = $date/1000;
        $date = Carbon::createFromTimestamp($date)->toDateTimeString();
//        dd($date);

        $post = Post::create([
            'author' => $author,
            'hot' => "false",
            'metaTitle' => $metaTitle,
            'created_at' => $date,
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

    public function createPostAddImage($postId, $file, $description, $order){
        $image = $file;
        $text = $description;
        if($image) {
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/postImages');
            $image->move($destinationPath, $name);
        }
        $img = PostImage::create([
            'postId' => $postId,
            'url' => '/images/postImages/'.$name,
            'description' => $text,
            'order' => $order
        ]);
        // dd($img);

    }

    public function createPostAddTitle($postId, $title, $order){
        PostTitle::create([
            'postId' =>  $postId,
            'titleText' => $title,
            'order' => $order
        ]);
    }

    public function createPostAddImageWithText($postId, $file, $title, $text, $imagePosition, $order){
        $image = $file;
        if($image) {
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/postImages');
            $image->move($destinationPath, $name);
        }
        PostImageAndText::create([
            'postId' => $postId,
            'url' => '/images/postImages/'.$name,
            'title' => $title,
            'imagePosition' => $imagePosition,
            'content' => $text,
            'order' => $order
        ]);
    }

    public function createPostAddSurvey($variants, $title, $postId, $order, $image){
        if($image) {
            $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/postImages');
            $image->move($destinationPath, $name);
        }
        if (\Auth::check() == false){
            $survey = Survey::create([
                'postId' => $postId,
                'authorId' => 1,
                'order' => $order,
                'question' => $title,
                'image' => '/images/postImages/'.$name,
            ]);
        }else{
            $survey = Survey::create([
                'postId' => $postId,
                'authorId' => \Auth::id(),
                'order' => $order,
                'question' => $title,
                'image' => '/images/postImages/'.$name,
            ]);
        }

        foreach ($variants as $key => $variant) {

            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => addslashes($variant),
                'order' => $key+1
            ]);
        }
    }

    public function createPostAddVideo($postId, $url, $order){
        PostVideo::create([
            'postId' =>  $postId,
            'url' => $url,
            'order' => $order
        ]);
    }

    public function createPostAddSelection($postId, $leftFile, $rightFile, $description, $order){
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
        SelectOne::create([
            'postId' => $postId,
            'description' => $description,
            'urlLeft' => '/images/postImages/'.$leftName,
            'urlRight' => '/images/postImages/'.$rightName,
            'order' => $order,
        ]);
    }

    public function createPostAddSingleLikablePhoto($postId, $file, $description, $order){

        if($file) {
            $name = rand(0,999999).time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/postImages');
            $file->move($destinationPath, $name);
        }

        SingleLikableImage::create([
            'postId' => $postId,
            'description' => $description,
            'url' => '/images/postImages/'.$name,
            'order' => $order,
        ]);
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

    public function getMainBday(){
        $happy = HappyBirthsday::find(1);
        $data['img'] = $happy->img;
        $data['text'] = $happy->text;
        return json_encode($data);
    }

    public function addNewComparison(Request $request){
        $leftImage = $request->file('leftImage');
        $leftName = rand(0,999999).time().'.'.$leftImage->getClientOriginalExtension();
        $destinationPath = public_path('/images/compare');
        $leftImage->move($destinationPath, $leftName);

        $rightImage = $request->file('rightImage');

        $rightName = rand(0,999999).time().'.'.$rightImage->getClientOriginalExtension();
        $destinationPath = public_path('/images/compare');
        $rightImage->move($destinationPath, $rightName);

        $current = SelectOne::where('postId', 0)->first();
        if (!empty($current)){
            $deletableId = $current->id;
            $current->delete();
            LikesForLeftAndRight::where('serviceId', $deletableId)->delete();
        }
        SelectOne::create([
            'urlRight' => '/images/compare/'.$rightName,
            'urlLeft' => '/images/compare/'.$leftName,
            'postId' => 0,
            'order' => 0,
        ]);
        return ['success' => true];
    }

    public function addSinglePhoto(Request $request){
        $image = $request->file('image');
        $name = rand(0,999999).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/singlePhoto');
        $image->move($destinationPath, $name);

        $image = SingleLikableImage::where('postId', 0)->first();

        if (!empty($image)){
            $deletableId = $image->id;
            $image->delete();
            LikesForSingleImage::where('serviceId', $deletableId)->delete();
            DisLikesForSingleImage::where('serviceId', $deletableId)->delete();
        }
        SingleLikableImage::create([
            'url' => '/images/singlePhoto/'.$name,
            'postId' => 0,
            'order' => 0,
        ]);
        return ['success' => true];
    }

    public function getAllSurveys(){
        $allSurveys = Survey::all();
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

//            $survey = json_decode($survey);

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


//        $adminIds = Admins::all();
//        foreach ($adminIds as $adminId) {
//            if (!empty(User::where('id', $adminId->id)->first())){
//                $admin = User::where('id', $adminId->id)->first();
////                dd($admin);
//                $allAdmins[$admin->id]['email'] = $admin->email;
//                $allAdmins[$admin->id]['name']  = $admin->email;
//                $allAdmins[$admin->id]['name'] = $admin->name;
//                $allAdmins[$admin->id]['phone'] = $admin->phone;
//                $allAdmins[$admin->id]['password'] = 'нахуй он тут вообще нужен';
//                if ($admin->isOnline() == false){
//                    $allAdmins[$admin->id]['status'] = 'offline';
//                }else{
//                    $allAdmins[$admin->id]['status'] = 'online';
//                }
//            }
//        }
//        if (!empty($allAdmins)){
////            dd($allAdmins);
//            return json_encode($allAdmins);
//        }else{
//            return json_encode([]);
//        }
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
        MainSection::truncate();
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


    public function getAllMails(){
        $mails = Mail::all();

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

}
