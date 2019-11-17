<div class="comments-section mt-2">
@auth
    <div class="input-group">
      <input type="text" name="comment_body" class="form-control" />
      <button data-post="{{ $post->id }}" type="button" class="btn btn-primary add-comment-button submit-comment">
      @lang('comments.add')</button>
    </div>

@endauth

    @include('components.comments.comments-wrapper')
</div>
