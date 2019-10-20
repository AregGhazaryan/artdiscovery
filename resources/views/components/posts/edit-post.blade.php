@extends('layouts.app')
<div class="page-loader">
  <div class="spinner-grow text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
@section('content')
<div class="container bg-white p-4 shadow-sm">
  <h2 class="text-center">
    @lang('posts.edit')</h2>
    <hr>
    <form class="card post-card" action="{{ route('post.update', $post->id) }}" method="post">
      @csrf
      @method('put')
      <input type="text" class="form-control mb-2" value="{{ $post->title }}" name="title" />
      <textarea id="editor" name="content">{!! $post->content !!}</textarea>
      <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-success">
          @lang('posts.edit')</button>
      </div>
    </form>
</div>
@endsection
