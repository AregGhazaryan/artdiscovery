<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Section;

class PagesController extends Controller
{
    public function index(){
        $sections = Section::all();
        return view('pages.index')->with('sections', $sections);
    }
}
