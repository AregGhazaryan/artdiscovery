@extends('layouts.app')
@section('content')
<div class="container bg-white p-4 shadow-sm">
  @include('includes.messages')
  <h1 class="text-center">
    @lang('events.list')</h1>
    <hr>
    <div class="table-responsive table-centered">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>
              @lang('events.title')</th>
            <th>
              @lang('events.date')</th>
            <th>
              @lang('events.actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($events as $event)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->start }}{{ $event->end ? ' - ' . $event->end : " "}}</td>
            <td>
              <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info btn-sm">@lang('events.edit')</a>
              <a href="{{ route('events.destroy', $event->id) }}" class="btn btn-danger btn-sm">@lang('events.delete')</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{ $events->links() }}
</div>
@endsection
