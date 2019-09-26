@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@include('includes.messages')
<div class="container shadow p-4">
    <h2 class="text-center">
        @lang('videos.title')</h2>
        <hr>
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Section</th>
                    <th scope="col">Subsection</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>

        {{-- <div class="d-flex justify-content-around admin-video-container">
            
                @foreach($videos as $video)
                <div class="card video-card shadow" style="width: 18rem;">
                    {!! $video->video !!}
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
        </div> --}}
</div>

@endsection
