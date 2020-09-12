<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Models\Setting;
use App\Traits\General;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use General;
    public function home(){
        $posts=Post::take(10)->get();
        $donations=DonationRequest::take(10)->get();
        return view('front.home',compact('posts','donations'));
    }
    public function about(){
        return view('front.about');
    }
    public function posts(){
        $posts=Post::all();
        return view('front.posts',compact('posts'));
    }
    public function postDetails($id){
        $posts=Post::findOrFail($id);
        return view('front.postsDetails',compact('posts'));
    }
}
