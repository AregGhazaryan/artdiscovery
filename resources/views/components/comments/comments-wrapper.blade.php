@if($post->comments->count() > 3)
  <div class="comments-collapse">

    <div class="collapse border-bottom mb-0 comments-placeholder" id="description-collapse" aria-expanded="false">
      @include('components.comments.comment')
    </div>
    <a role="button" class="collapsed d-block w-100 text-center" data-toggle="collapse" href="#description-collapse" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-caret-up"></i></a>

  </div>
  @else
  <div class="comments-wrapper">
    <div class="comments-placeholder">
      @include('components.comments.comment')
    </div>
  </div>
  @endif
