<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function show($id){
      $user = User::find($id);
      return view('profile.index')->with('user', $user);
    }
}
