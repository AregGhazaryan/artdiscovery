<div class="ml-2 d-flex flex-column video-sidebar">
@foreach($videos as $video)
  <div class="video-box m-2">
    {!! $video->video !!}
  </div>
@endforeach
</div>
