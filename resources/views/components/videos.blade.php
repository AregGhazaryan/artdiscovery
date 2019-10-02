@foreach($sections as $section)
<div class="container section-container">
  <div class="header section-headline d-flex justify-content-between" style="border-color: #{{ $section->color }}">
    <div class="title">
      {{ $section->title }}
    </div>
    <div class="spinner-grow text-primary m-auto" style="color:#{{ $section->color }} !important" role="status">
    <span class="sr-only">Loading...</span>
  </div>

  @if($section->subsection)
  <div class="btn-group">
    <button type="button" class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      @lang('subsections.index')
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item subsection-picker" data-section="{{ $section->id }}"
        data-subsection="0" data-name="{{$section->title}}">@lang('sections.all')</a>
      @foreach($section->subsection as $subsection)
      <a class="dropdown-item subsection-picker" data-section="{{ $section->id }}"
        data-subsection="{{ $subsection->id }}">{{$subsection->title}}</a>
      @endforeach
    </div>
  </div>
  @endif
</div>
@if($section->video()->exists())
<div class="inner-container d-flex justify-content-between">
  <button class="btn btn-white scroll-btn scroll-left-button">
    <i class="fas fa-chevron-left"></i>
  </button>
  <div class="video-body">
    <div class="section-body">
      @foreach($section->video as $video)
      <div class="video-card card m-3" style="width: 18rem;">
        <div class="h-100 buy-btn-wrapper">
          <a href="#" class="btn btn-success buy-btn"><i class="fas fa-unlock mr-2"></i>@lang('store.buy')</a>
        </div>

        {{-- {!! $video->video !!} --}}
        <div class="card-body p-2">
          <h5 class="card-title m-0"><a href="{{ route('page.video', $video->id) }}" title="{{ $video->title }}">{{ $video->title }}</a></h5>
          <div class="text-muted mb-1">
            <small>
              {{ $video->start_date }}{{ $video->end_date ? ' - ' . $video->end_date  : '' }} | <i class="fas fa-eye"></i>  {{ $video->views }}
            </small>
            <span class="float-right font-weight-bold text-dark">{{ $video->price }}{{ $video->currency->symbol }}</span>
          </div>
          <div class="d-flex justify-content-between pt-2 card-video-button-wrapper">
            <button class="btn-sm btn btn-orange"><i class="fas fa-cart-plus mr-2"></i>@lang('store.addtocart')</button>
            <a href="#" class="btn btn-info text-white" data-toggle="modal" data-target="#m{{ $video->id }}"><i class="fas fa-info-circle mr-1"></i>@lang('store.info')</a>
          </div>
        </div>
      </div>
      {{-- Video modal --}}
      <div class="modal fade" id="m{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="Video info" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered video-info-modal" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">{{ $video->title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! $video->description !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">@lang('store.close')</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <button class="btn btn-white scroll-btn scroll-right-button">
    <i class="fas fa-chevron-right"></i>
  </button>
</div>
@endif
</div>
@endforeach
<!-- Modal -->
