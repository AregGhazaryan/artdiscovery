@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@include('includes.messages')
<div class="container shadow p-4">
    <h2 class="text-center">
        @lang('videos.title')</h2>
        <hr>
        <div class="d-flex justify-content-around">
            @if($videos->isNotEmpty())
                @foreach($videos as $video)
                <div class="card video-card shadow" style="width: 18rem;">
                    <video class="playback" id="playback{{ $video->id }}" controls controlsList="nodownload" oncontextmenu="return false;">
                        <source class="source" src="{{ asset('storage/videos') }}/{{ $video->video }}">
                    </video>
                    <div class="card-body border-top">
                        <h5 class="card-title">{{ str_limit($video->title, 35)}}</h5>
                        <p class="card-text">{{ str_limit($video->description, 200)  }}</p>
                        <div class="cart-footer d-flex justify-content-between">
                            <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-2"></i>
                                @lang('videos.edit')
                            </a>
                            <form action="{{ route('admin.videos.delete', $video->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-edit mr-2"></i>
                                    @lang('videos.delete')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
        </div>
</div>

@endsection
