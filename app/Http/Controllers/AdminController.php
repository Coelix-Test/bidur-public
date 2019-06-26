<?php


namespace App\Http\Controllers;
use App\Admins;
use App\DisLikesForSingleImage;
use App\HappyBirthsday;
use App\Hashtag;
use App\HashtagPosts;
use App\Http\Middleware\Admin;
use App\LikesForLeftAndRight;
use App\LikesForSingleImage;
use App\Post;
use App\PostContent;
use App\PostTitle;
use App\PostVideo;
use App\SelectOne;
use App\SingleLikableImage;
use App\Survey;
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


    public function getAllPosts(Request $request ){
//        $offset = 3;

        if (!empty($request->get('offset'))){
            $offset = $request->get('offset');
        }else{
            $offset = 0;
        }

        $posts = Post::offset($offset)->limit(12)->get();

        foreach ($posts as $key => $post) {
            $allPosts[$key]['title'] = $post->metaTitle;
            $allPosts[$key]['author'] = $post->author;

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

            $allPosts[$key]['createdAt'] = $createdAt;
        }
        return json_encode($allPosts);
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
                $this->post = $this->createPostHeaderMeta($metaTitle, $hashtags, $hot, $author, $date);
            }
            elseif($section['type'] == 'content'){
                $content = $section['content'];
                $this->createPostAddContent($this->post->id, $content, $key);
            }
            elseif($section['type'] == 'title'){
                $title = $section['title'];
                $this->createPostAddTitle($this->post->id, $title, $key);
            }
            elseif($section['type'] == 'video'){
                $url = $section['video'];
                $this->createPostAddTitle($this->post->id, $url, $key);
            }
            elseif($section['type'] == 'survey'){
                $title = $section['title'];
                if ($section['right'] != null){
                    $right = $section['right'];
                }
                $this->createPostAddSurvey($section['variants'], $title, $this->post->id, $key, $right);
            }
            elseif ($section['type'] == 'image'){
                exit(0);
            }
            elseif ($section['type'] == 'imageWithText'){
                exit(0);
            }
        }
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

    public function createPostAddContent($postId, $content, $order){
        PostContent::create([
            'postId' =>  $postId,
            'content' => $content,
            'order' => $order
        ]);
    }
    public function createPostAddImage(){
    }

    public function createPostAddTitle($postId, $title, $order){
        PostTitle::create([
            'postId' =>  $postId,
            'titleText' => $title,
            'order' => $order
        ]);
    }
    public function createPostAddImageWithText(){
    }

    public function createPostAddSurvey($variants, $title, $postId, $order, $right){
        $survey = Survey::create([
            'postId' => $postId,
            'authorId' => \Auth::id(),
            'order' => $order,
            'question' => $title
        ]);
        foreach ($variants as $key => $variant) {
            $status = false;
            if ($survey == $key){
                $status = true;
            }
            SurveyAnswerVariant::create([
                'surveyId' => $survey->id,
                'question' => $variant,
                'right' => $status,
                'order' => $key
            ]);
        }
    }

    public function createPostAddVideo($postId, $url, $order){
        PostVideo::create([
            'postId' =>  $postId,
            'titleText' => $url,
            'order' => $order
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

    public function addHappyBirthday(Request $request){
        HappyBirthsday::truncate();
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/happyBirthday');
        $image->move($destinationPath, $name);
        HappyBirthsday::create([
            'text' => $request->get('text'),
            'img' => '/images/happyBirthday/'.$name,
        ]);
    }

    public function addNewComparison(Request $request){
        SelectOne::truncate();
        LikesForLeftAndRight::truncate();
        $leftImage = $request->file('leftImage');
        $leftName = time().'.'.$leftImage->getClientOriginalExtension();
        $destinationPath = public_path('/images/happyBirthday');
        $leftImage->move($destinationPath, $leftName);

        $rightImage = $request->file('rightImage');
        $rightName = time().'.'.$rightImage->getClientOriginalExtension();
        $destinationPath = public_path('/images/happyBirthday');
        $rightImage->move($destinationPath, $rightName);
        
        SelectOne::create([
            'urlRight' => '/images/compare/'.$rightName,
            'urlLeft' => '/images/compare/'.$leftName,
        ]);
    }

    public function addSinglePhoto(Request $request){
        SingleLikableImage::truncate();
        DisLikesForSingleImage::truncate();
        LikesForSingleImage::truncate();

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/happyBirthday');
        $image->move($destinationPath, $name);

        SingleLikableImage::create([
            'url' => '/images/singlePhoto/'.$name,
        ]);
    }

    public function getAllSurveys(){
        $allSurveys = Survey::all();
        foreach ($allSurveys as $key => $survey) {
            $all[$key]['survey'] = $survey;
            $all[$key]['variants'] = $survey->getAllVariants()->orderBy('order');
        }
        return json_encode($all);
    }
    

    public function showAllAdmins(){
        $adminIds = Admins::all();
        foreach ($adminIds as $adminId) {
            if (!empty(User::where('id', $adminId->id)->first())){
                $admin = User::where('id', $adminId->id)->first();
//                dd($admin);
                $allAdmins[$admin->id]['email'] = $admin->email;
                $allAdmins[$admin->id]['name']  = $admin->email;
                $allAdmins[$admin->id]['name'] = $admin->name;
                $allAdmins[$admin->id]['phone'] = $admin->phone;
                $allAdmins[$admin->id]['password'] = 'нахуй он тут вообще нужен';
                if ($admin->isOnline() == false){
                    $allAdmins[$admin->id]['status'] = 'offline';
                }else{
                    $allAdmins[$admin->id]['status'] = 'online';
                }
            }
        }
        if (!empty($allAdmins)){
//            dd($allAdmins);
            return json_encode($allAdmins);
        }else{
            return json_encode([]);
        }
    }

    public function editAdmin(Request $request){
        $name   = $request->get('name');
        $email  = $request->get('email');
        $phone  = $request->get('phone');
        $id     = $request->get('id');
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
        $id = $request->get('id');
        Admins::find($id)->delete();
        return $this->showAllAdmins();
    }

    public function makeUserAdmin(Request $request){
        Admins::create([
            'userId' => $request->get('id'),
        ]);
        return json_encode(['success' => true]);
    }
}
