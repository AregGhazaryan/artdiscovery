<div class="comments-section mt-2">
@auth
    <div class="input-group">
      <input type="text" name="comment_body" class="form-control" />
      <button data-post="{{ $post->id }}" type="button" style="text-shadow: 2px 1px 2px #5B5B5B; background-color:#{{ $post->section !== null ? $post->section->color : ''}}" class="text-light btn font-weight-bold add-comment-button submit-comment">
      @lang('comments.add')</button>
    </div>

@endauth

    @include('components.comments.comments-wrapper')
</div>
