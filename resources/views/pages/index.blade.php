@extends('layouts.app')
@section('content')
  @include('includes.messages')
  @auth
  @if(Gate::allows('post-crud'))
    <form id="post-publish">
      <input type="text" name="title" class="card post-card post-main shadow-sm form-control mb-2" id="post-title" placeholder="@lang('posts.title')" required/>
      <div class="card post-card shadow-sm">
        <textarea name="content" id="editor" required autocomplete="off"></textarea>
        <div class="card-footer text-right bg-white">
          <button type="button" class="btn btn-success" id="publish-post">
            <div class="spinner-border spinner-border-sm  submit-loading text-light" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            @lang('posts.publish')</button>
        </div>
      </div>
    </form>
    @endif
    @endauth
  <div class="main-container d-flex justify-content-center">
    @include('includes.left-sidemenu')

  @include('components.posts.main-posts')
</div>
@endsection
