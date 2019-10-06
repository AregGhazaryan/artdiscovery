<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('activity');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        return view('profile.index')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id !== $id) {
            return Redirect::route('home')->with('error-message', 'Unauthorized Access');
        }else{
            $user = User::findOrFail($id);
            return view('profile.edit')->with('user', $user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->id !== $id) {
            return Redirect::back()->with('error-message', 'Unauthorized Access');
        }else{
            $user = User::findOrFail($id);

            $validatedData = $request->validate(
                [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'string|max:255|email|unique:users,email,'.Auth::user()->id,
                'password' => 'min:8|string|nullable|confirmed',
                'mobile' => 'required|string|numeric',
                'birth_date' => 'required|date',
                'gender' => 'required',
                ]
            );
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->birthday = $request->birth_date;
            $user->gender = $request->gender;

            if($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('file')) {
                $imageName = time().'.'.$request->file->getClientOriginalExtension();
                $path = Storage::putFileAs('public/profile_images/', new File($request->file), $imageName);
                if($user->avatar !== 'default.png') {
                    Storage::delete('public/profile_images/' . $user->avatar);
                }
                $user->avatar = $imageName;
            }
            $user->save();
            return Redirect::route('profile.show', $user->id)->with('message', trans('profile.success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
