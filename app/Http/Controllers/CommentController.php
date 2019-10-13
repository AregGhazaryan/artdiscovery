<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Comment;
use App\Post;
use Auth;

class CommentController extends Controller
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

      $validatedData = Validator::make($request->all(), 
          [
          'comment_body' => 'required|string|max:2000',
          ]
        );
        if($validatedData->fails()){
          $data = [
            'errors' => $validatedData->errors(),
          ];
          
        return response()->json($data, 400);
      }else{
          $comment = new Comment;
          $comment->post_id = $request->post_id;
          $comment->body = $request->comment_body;
          $comment->user()->associate($request->user());
          $post = Post::find($request->post_id);
          $post->comments()->save($comment);
          $comment = Comment::orderBy('created_at','desc')->first();
          $data = [
            'user' => $comment->user,
            'comment' => $comment,
          ];
        return Response::json([$data],200);
      }
        
    }

    public function replyStore(Request $request)
    {

        $validatedData = Validator::make($request->all(), 
          [
          'comment_body' => 'required|string|max:2000',
          ]
        );
        if ($validatedData->fails()) {
            $data = [
            'errors' => $validatedData->errors(),
          ];
            return response()->json($data, 400);
        }else{
          $reply = new Comment;
          $reply->body = $request->comment_body;
          $reply->user()->associate($request->user());
          $reply->parent_id = $request->comment_id;
          $post = Post::find($request->post_id);
          $reply->post_id = $request->post_id;
          $post->comments()->save($reply);
          
          
          $comments = Comment::orderBy('created_at','desc')->first();
          $data = [
            'user' => $comments->user,
            'comment' => $comments,
            'parent' => true,
          ];
        }

        return response()->json($data, 200);
        
        // $comments = Comment::find($reply->id);
        // return response(view('components.comments.comment-reply',compact('comments', 'user')),200, ['Content-Type' => 'application/json']);
        // return Response::json([view('components.comments.comment-reply')->with('comment', $reply)],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::find($id);

      if(Auth::user()->isAdmin() || $comment->user_id == Auth::user()->id){
        $comment->delete();
        return response()->json(['Success', 200]);
      }else{
        return response()->json(['Unauthorized Access', 401]);        
      }
    }

    public function reply(){

    }
}
