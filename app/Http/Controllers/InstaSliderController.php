<?php

namespace App\Http\Controllers;

use App\InstaSlider;
use Illuminate\Http\Request;
use App\Exceptions\InvalidInputException;

class InstaSliderController extends Controller
{


  public function store(Request $request){

    $item = new InstaSlider();

    $item->hashtag_id = $request->input('hashtag_id');
    if($request->hasFile('file')) {
      $image = $request->file('file');
      $name = rand(0, 999999).time() . '.' . $image->getClientOriginalExtension();
      $url = '/images/insta-slider';
      $path = public_path($url);
      $image->move($path, $name);
      $item->image = $url . '/' . $name;
    } else {
      throw new InvalidInputException('No file specified');
    }

    $item->save();
  }


  public function remove(Request $request, $id){
    InstaSlider::where('id', $id)
      ->first()
      ->remove();
  }


  public function getByInsta($hashtag_id) {
    return InstaSlider::where('hashtag_id', '=', $hashtag_id)
      ->get()
      ->toJson();
  }

  // move to admin contreoller when it'll have separeted
  public function getByInstaAdmin() {
    return InstaSlider::where('hashtag_id', $hashtag_id)->toJson();
  }
}
