<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Auth;


class PostController extends Controller
{
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
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();
        $post->refresh();
        $data = [
          'post' => $post,
          'user' => $post->user,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('components.posts.edit-post')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post                $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return Redirect::route('home')->with('message', trans('posts.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->images !== null) {
            foreach($request->images as $image){
                $exp = explode('/', $image);
                $name = end($exp);
                Storage::delete('public/post_images/' . $name);
            }
        }
        $post = Post::find($id);
        foreach($post->comments as $comment){
            $comment->delete();
        }
        $post->delete();
        return response()->json(['success'], 200);
        // return Redirect::route('home')->with('message', trans('posts.deleted'));
    }

    public function imageUpload(Request $request)
    {
        $request->validate(['upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        $imageName = time().'.'.$request->upload->getClientOriginalExtension();
        $path = Storage::putFileAs('public/post_images', new File($request->upload), $imageName);
        $exp = explode('/', $path);
        unset($exp[0]);
        $realpath = implode('/', $exp);
        $data = [
          "url" => route('home').'//storage/' .$realpath,
        ];
        return response()->json($data, 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}
