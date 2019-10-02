@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@include('includes.messages')
<div class="container shadow p-4 bg-white">
  <h2 class="text-center">
    @lang('videos.title')</h2>
    <hr>
    {{ $videos->links() }}
    <div class="d-flex justify-content-around admin-video-container table-responsive">
      <table class="table centered-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">
              @lang('adminvideos.title')</th>
            <th scope="col">
              @lang('adminvideos.dates')</th>
            <th scope="col">
              @lang('adminvideos.section')</th>
            <th scope="col">
              @lang('adminvideos.subsection')</th>
            <th scope="col">
              @lang('adminvideos.actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($videos as $video)
          <tr>
            <td>
              {{ $loop->iteration }}
            </td>
            <td>
              {{ $video->title }}
            </td>
            <td>
              {{ $video->date }}
            </td>
            <td>
              {{ $video->section->title }}
            </td>
            <td>
              {{ $video->subsection->title }}
            </td>
            <td>
              <div class="d-flex justify-content-center">

              <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-sm btn-primary mr-1">
                <i class="fas fa-edit"></i>
                @lang('videos.edit')
              </a>
              <form action="{{ route('admin.videos.delete', $video->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash-alt"></i>
                  @lang('videos.delete')
                </button>
              </form>
            </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
</div>

@endsection
