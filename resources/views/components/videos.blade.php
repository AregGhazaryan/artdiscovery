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
        data-subsection="0">@lang('sections.all')</a>
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
        {!! $video->video !!}
        <div class="card-body p-2">
          <h5 class="card-title m-0">{{ $video->title }}</h5>
          <div class="text-muted mb-1">
            <small>
              {{ $video->start_date }}{{ $video->end_date ? ' - ' . $video->end_date  : '' }} | <i class="fas fa-eye"></i>  {{ $video->views }}
            </small>
            <span class="float-right font-weight-bold text-dark">{{ $video->price }}{{ $video->currency->symbol }}</span>
          </div>
          <div class="d-flex justify-content-between pt-2 card-video-button-wrapper">
            <button class="btn-sm btn btn-orange"><i class="fas fa-cart-plus mr-2"></i>@lang('store.addtocart')</button>
            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-money-bill mr-2"></i>@lang('store.buy')</a>
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
