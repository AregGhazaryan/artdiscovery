@extends('layouts.app')
@section('content')
  @include('includes.messages')
  @auth
  @if(Gate::allows('post-crud'))
  <div class="d-flex justify-content-center">
        <nav id="left-sidebar" class="left-sidebar js-pinned-left-sidebar">
          <nav id="sidebar">
          <div class="profile-image bg-white shadow-sm">
            <img src="/storage/profile_images/{{ Auth::user()->avatar}}">
          </div>
        </nav>
      </nav>

      <form id="post-publish" style="width: 771px;">
        <input type="text" name="title" class="card post-card post-main shadow-sm form-control mb-2" id="post-title" placeholder="@lang('posts.title')" required/>
        <div class="card post-card shadow-sm">
          <textarea name="content" id="editor" required autocomplete="off"></textarea>
          <div class="card-footer text-right bg-white d-flex justify-content-between">
            <div class="col-sm-6">
              <select name="section_id" class="form-control" id="section-id">
                @foreach($sections as $section)
                  <option value="{{ $section->id }}">{{$section->title}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <select name="subsection_id" class="form-control" id="subsection-id">
                @foreach($subsections as $section)
                  <option value="{{ $section->id }}">{{$section->title}}</option>
                @endforeach
              </select>
            </div>

          </div>

          <button type="button" class="btn btn-success" id="publish-post">
            <div class="spinner-border spinner-border-sm  submit-loading text-light" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            @lang('posts.publish')
          </button>

        </div>
      </form>
    </div>
      @endif
      @endauth
  <div class="main-container d-flex justify-content-center">
    @include('includes.left-sidemenu')

  @include('components.posts.main-posts')
</div>
@endsection
