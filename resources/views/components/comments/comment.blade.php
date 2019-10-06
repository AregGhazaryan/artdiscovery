<div class="comments-collapse">

  <div class="collapse border-bottom mb-0 p-1" id="description-collapse" aria-expanded="false">

    @foreach($post->comments as $item)
      <div class="bg-white comment rounded p-2">
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
  </div>

  <a role="button" class="collapsed d-block w-100 text-center" data-toggle="collapse" href="#description-collapse" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-caret-up"></i></a>

</div>
