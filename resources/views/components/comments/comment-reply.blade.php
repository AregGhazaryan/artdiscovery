@foreach($comment->replies as $reply)
<div class="comment comment-reply shadow-sm p-2">
  <div class="comment-header mb-1">
    <a href="{{ route('profile.show', $reply->user->id) }}"><img class="comment-by-image mr-2"
        src="storage/profile_images/{{ $reply->user->avatar }}" />{{ $comment->user->fullname }}</a>
    @auth
    @if(Auth::user()->isAdmin() || $reply->user->id == Auth::user()->id)
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
    {{ $reply->body }}
  </div>
  @auth
  <div class="replies-wrapper text-right">
    <a data-toggle="collapse" href="#reply{{$reply->id}}" role="button">@lang('comments.reply')</a>
    <div class="collapse" id="reply{{ $reply->id }}">
      <div class="input-group">
        <input type="text" name="comment_body" class="form-control" class="form-control" />
        <button data-comment="{{ $comment->id }}" data-post="{{ $post->id }}" data-parent="true" type="submit"
          class="btn btn-primary add-comment-button submit-reply">@lang('comments.reply')</button>
      </div>
    </div>
  </div>
  @endauth
<div class="comment-footer text-right"><small class="text-muted">{{ $comment->created_at }}</small></div>
</div>
@endforeach
