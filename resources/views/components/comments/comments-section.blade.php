<div class="comments-section">

    <div class="input-group">
      <input type="text" name="comment_body" class="form-control" />
      <button data-post="{{ $post->id }}" type="button" id="submit-comment" class="btn btn-primary add-comment-button" />
      @lang('comments.add')</button>
    </div>
  <hr />

  
  <div id="comments">
    @include('components.comments.comment')
  </div>
</div>
