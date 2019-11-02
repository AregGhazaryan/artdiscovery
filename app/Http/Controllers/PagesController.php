<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Section;
use App\Page;
use App\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Auth;

class PagesController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.index')->with('posts', $posts);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function video($id)
    {
        $video = Video::where('id', $id)->first();
        return view('pages.video')->with('video', $video);
    }

    public function sections()
    {
        $sections = Section::all();
        return view('pages.sections')->with('sections', $sections);
    }

    public function sendMail(Request $request)
    {
        $validatedData = $request->validate(
            [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'string|max:255|email|required',
            'g-recaptcha-response' => new Captcha()
            ]
        );

        $name = $request->first_name . ' ' . $request->last_name;
        $email = $request->email;
        $body = $request->body;
        Mail::to('info@artdiscovery.online')->send(new Contact($name, $email, $body));
        return Redirect::back()->with('message', trans('contact.sent'));
    }

    public function privacyPolicy(){
      $page = Page::find('1');
      return view('pages.page')->with('page', $page);
    }

    public function termsOfService(){
      $page = Page::find('2');
      return view('pages.page')->with('page', $page);
    }
}
