@foreach($post->comments as $comment)
<div class="comment-wrapper">
  <div class="bg-white comment rounded p-2 shadow-sm">
    <div class="comment-header mb-1">
      <a href="{{ route('profile.show', $comment->user->id) }}"><img class="comment-by-image mr-2"
          src="storage/profile_images/{{ $comment->user->avatar }}" />
        {{ $comment->user->fullname }}
      </a>
      @auth
      @if(Auth::user()->isAdmin() || $comment->user->id == Auth::user()->id)
      <div class="dropdown post-options float-right dropleft comment-dropdowns">
        <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          {{-- <a class="dropdown-item waves-light edit-post"
            href="{{route('comment.edit', $post->id)}}">@lang('posts.edit')</a> --}}
          <a class="dropdown-item waves-light delete-comment" data-id="{{ $comment->id }}">@lang('posts.delete')</a>
        </div>
      </div>
      @endif
      @endauth
    </div>
    <div class="comment-body">
      {{ $comment->body }}
    </div>
    <div class="replies-wrapper text-right">
      @if($comment->replies()->exists())
      <a data-toggle="collapse" href="#replies{{$comment->id}}" role="button">@lang('comments.viewreplies')</a>
      @endif
      @auth
      <a data-toggle="collapse" href="#reply{{$comment->id}}" class="ml-3" role="button">@lang('comments.reply')</a>
      <div class="collapse" id="reply{{ $comment->id }}">
        <div class="input-group">
          <input type="text" name="comment_body" class="form-control" class="form-control" />
          <button data-comment="{{ $comment->id }}" data-parent="true" data-post="{{ $post->id }}" type="submit"
            class="btn btn-primary add-comment-button submit-reply">@lang('comments.reply')</button>
        </div>
      </div>
      @endauth
    </div>
    <div class="comment-footer text-right">
      <small class="text-muted">{{ $comment->created_at }}</small>
    </div>
  </div>
  <div class="collapse replies-collapse" id="replies{{ $comment->id }}">
    @include('components.comments.comment-reply')
  </div>
</div>
@endforeach
