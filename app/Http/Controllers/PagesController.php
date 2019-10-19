<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Video;
use App\Section;
use App\Post;
use Illuminate\Support\Facades\Cache;
use Auth;

class PagesController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.index')->with('posts', $posts);
    }

    public function contact(){

    }

    public function video($id){
      $video = Video::where('id', $id)->first();
      return view('pages.video')->with('video', $video);
    }

    public function sections(){
      $sections = Section::all();
      return view('pages.sections')->with('sections', $sections);
    }
}
