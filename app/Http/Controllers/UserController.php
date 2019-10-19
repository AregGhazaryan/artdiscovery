<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('edit', 'update', 'show');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(30);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->id !== $id || Auth::user()->type !== 'admin'){
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ban($id){
      $user = User::find($id);
      $user->status_id = 3;
      $user->save();
      return Redirect::back()->with('message', trans('users.banned'));
    }

    public function unban($id){
      $user = User::find($id);
      $user->status_id = 1;
      $user->save();
      return Redirect::back()->with('message', trans('users.unbanned'));
    }

    public function setAuthor($id){
      $user = User::find($id);
      $user->role_id = 3;
      $user->save();
      return Redirect::back()->with('message', trans('users.authorset'));
    }

    public function unsetAuthor($id){
      $user = User::find($id);
      $user->role_id = 2;
      $user->save();
      return Redirect::back()->with('message', trans('users.authorunset'));
    }
}
