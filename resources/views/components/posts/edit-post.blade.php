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
      <div class="card-footer text-right bg-white d-flex justify-content-between">
        <div class="col-sm-6">
          <select name="section_id" class="form-control" id="section-id">
            @foreach($sections as $section)
              <option value="{{ $section->id }}" {{ ( $section->id == $post->section_id) ? 'selected' : '' }}>{{$section->title}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6">
          <select name="subsection_id" class="form-control" id="subsection-id">
            @foreach($subsections as $section)
              <option value="{{ $section->id }}" {{ ( $section->id == $post->subsection_id) ? 'selected' : '' }}>{{$section->title}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-success">
          @lang('posts.submit')</button>
      </div>
    </form>

</div>
@endsection
