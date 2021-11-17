<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function likesIndex()
    {   $user = \Auth::user();
        $like_items = \Auth::user()->likeItems()->orderBy('likes.created_at','desc')->get();
        return view('likes.index', [
          'title' => 'お気に入り一覧',
          'like_items' => $like_items,
          'user' => $user,
        ]);
    }
}
