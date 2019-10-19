<div class="page-loader">
  <div class="spinner-grow text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
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
  <div id="new-added"></div>

  <div class="infinite-scroll">
    @foreach($posts as $post)
    <div class="card post-card shadow-sm mt-2">
      <div class="card-header bg-white p-3 post-by">
        <a href="{{ route('profile.show', $post->user->id) }}"><img class="post-by-image mr-2" src="storage/profile_images/{{ $post->user->avatar }}" />
          {{ $post->user->fullname }}
        </a>
        @auth
        @if(Gate::allows('post-menu', $post, Auth::user()))
        <div class="dropdown post-options float-right">
          <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item waves-light edit-post" href="{{route('post.edit', $post->id)}}">@lang('posts.edit')</a>
            <a class="dropdown-item waves-light delete-post" data-id="{{ $post->id }}">@lang('posts.delete')</a>
          </div>
        </div>
        @endif
      @endauth
      </div>
      <div class="card-header bg-white p-3 align-middle post-title">
        {{$post->title}}
      </div>
      <div class="card-body post-content">
        {!! $post->content !!}
      </div>
      <div class="card-footer p-2">
        @include('components.comments.comments-section')
      </div>
    </div>
    @endforeach
    {{ $posts->links() }}

  </div>
  @section('scripts')
  <script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
      $('.infinite-scroll').jscroll({
        loadingHtml: '<div class="spinner-border infinite-loading spinner-border-sm  submit-loading text-light" role="status"><span class="sr-only">Loading...</span><div>',
        padding: 20,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'div.infinite-scroll',
        callback: function() {
          $('ul.pagination').remove();
        }
      });

    });
  </script>
  @endsection
