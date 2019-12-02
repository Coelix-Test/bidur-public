<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsLetter;
class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        if(is_null($request->email))
            return response()->json(['success',false,'errors' => 'Email required']);
        NewsLetter::create($request->all());
        return response()->json(['success' => true]);
    }
}
