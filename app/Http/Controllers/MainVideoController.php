<?php

namespace App\Http\Controllers;

use App\MainVideo;
use Illuminate\Http\Request;
use App\Exceptions\InvalidInputException;

class MainVideoController extends Controller
{


  public function store(Request $request){

    $item = new MainVideo();

		if(!$request->author) {
			throw new InvalidInputException('No author specified');
		}

		$item->title = $request->title;
		$item->author = $request->author;
		$item->order_num = $request->order_num;

    if($request->hasFile('thumbnail')) {
      $thumbnail = $request->file('thumbnail');
      $name = rand(0, 999999).time() . '.' . $thumbnail->getClientOriginalExtension();
      $url = '/images/videos-thumbnail';
      $path = public_path($url);
      $thumbnail->move($path, $name);
      $item->thumbnail = $url . '/' . $name;
    } else {
      throw new InvalidInputException('No thumbnail specified');
    }

		// dd($request->file('video'));

		if($request->hasFile('video')) {
      $video = $request->file('video');
      $name = rand(0, 999999).time() . '.' . $video->getClientOriginalExtension();
      $url = '/images/videos';
      $path = public_path($url);
      $video->move($path, $name);
      $item->video = $url . '/' . $name;
    } else {
      throw new InvalidInputException('No video specified');
    }

    $item->save();
  }


  public function remove(Request $request, $id){
    MainVideo::where('id', $id)
      ->first()
      ->remove();
  }


  // move to admin contreoller when it'll have separeted
  public function indexAdmin() {
    return MainVideo::all();
  }


  public function index() {
    return MainVideo::all();
  }
}
