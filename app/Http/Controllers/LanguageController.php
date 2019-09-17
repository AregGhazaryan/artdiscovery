<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function store($lang)
    {
        $cookie = null;

        if (array_key_exists($lang, Config::get('app.locales'))) {
            $cookie = Cookie::forever('locale', $lang);
        }
        
        if ($cookie) {
            return Redirect::back()->withCookie($cookie);
        } 
        
        return back();
    }
}
