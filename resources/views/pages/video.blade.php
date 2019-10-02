@extends('layouts.app')
@section('content')
<div class="bg-white p-4">
  <div class="row">
    {{-- {{ $video->title }} --}}
    <div class="col-lg-8 shadow video-container p-0">
      {!! $video->video !!}
      <div class="col-lg-12">
        <div class=" video-title border-bottom border-primary">
          {{ $video->title }}
        </div>
        <div class="video-description">
          <p class="collapse border-bottom mb-0" id="description-collapse" aria-expanded="false">{{$video->description}}
          </p>

          <a role="button" class="collapsed d-block w-100 text-center" data-toggle="collapse" href="#description-collapse" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-caret-up"></i></a>
        </div>
      </div>

    </div>
    <div class="col-lg-4">

    </div>
  </div>
</div>
@endsection
