<?php

namespace App\Http\Controllers;

use App\Insta;
use Illuminate\Http\Request;

class InstaController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request){
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/insta');
        $image->move($destinationPath, $name);

        $link = $request->get('link');

        $insta = Insta::create([
            'linkToInsta' => $link,
            'imageUrl' => '/images/insta/'.$image,
        ]);

        return json_encode(['success' => true, 'insta' => $insta]);
    }

    public function show(){
        $insta = Insta::find(1);
        $instaArray['img'] = $insta->imageUrl;
        $instaArray['link'] = $insta->linkToInsta;

        return json_encode($instaArray);
    }
}
