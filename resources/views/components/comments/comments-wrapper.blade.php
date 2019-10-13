@if($post->comments->count() > 3)
{{-- <div class="comments-collapse"> --}}

<div class="collapse border-bottom mb-0" id="description-collapse" aria-expanded="false">
  <div class="comments-placeholder">
    @include('components.comments.comment')
  </div>
</div>
<a role="button" class="collapsed d-block w-100 text-center" data-toggle="collapse" href="#description-collapse"
  aria-expanded="false" aria-controls="collapseExample">@lang('comments.comments')<i class="ml-2 fas fa-sort-down"></i></a>

{{-- </div> --}}
@else
<div class="comments-wrapper">
  <div class="comments-placeholder">
    @include('components.comments.comment')
  </div>
</div>
@endif
