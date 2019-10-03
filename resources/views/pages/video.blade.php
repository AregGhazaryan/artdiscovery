@extends('layouts.app')
@section('content')
<div class="bg-white p-4">
  <div class="row">
    {{-- {{ $video->title }} --}}
    <div class="col-lg-8 shadow video-container p-0">
      <div class="video-wrapper">
        {!! $video->video !!}
      </div>
      <div class="col-lg-12">
        <div class="video-headline pb-2  border-bottom border-primary">
          <div class="video-title-wrapper d-flex justify-content-between">
            <div class="video-title">
              {{ $video->title }}
            </div>
            <div class="video-views mt-1"><i class="fas fa-eye mr-2"></i>{{ $video->views }} @lang('videos.views')</div>
          </div>
          <small class="text-muted">{{ $video->date }}</small>
        </div>
        <div class="video-description">
          <div class="collapse border-bottom mb-0 p-1" id="description-collapse" aria-expanded="false">{!!$video->description!!}</div>

          <a role="button" class="collapsed d-block w-100 text-center" data-toggle="collapse" href="#description-collapse" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-caret-up"></i></a>
        </div>
      </div>

    </div>
    <div class="col-lg-4">

    </div>
  </div>
</div>
@endsection
