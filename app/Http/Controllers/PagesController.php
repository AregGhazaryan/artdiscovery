<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Section;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
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
