<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Response;
use Auth;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create()
    {
        if(Auth::user()->isAuthor() || Auth::user()->isAdmin()) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if(Auth::user()->id === $post->user_id || Auth::user()->isAdmin()) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function delete(User $user,Post $post)
    {
        if($user->id == $post->user_id || $user->isAdmin()) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
