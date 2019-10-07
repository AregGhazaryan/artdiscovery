@foreach($post->comments as $item)
  <div class="bg-white comment rounded p-2 shadow-sm">
    <div class="comment-header mb-1">
      <a href="{{ route('profile.show', $item->user->id) }}"><img class="comment-by-image mr-2" src="storage/profile_images/{{ $post->user->avatar }}" />
        {{ $item->user->fullname }}
      </a>
    </div>
    <div class="comment-body">
      {{ $item->body }}
    </div>
    <div class="comment-footer text-right">
      <small class="text-muted">{{ $item->created_at }}</small>
    </div>
  </div>
  @endforeach
