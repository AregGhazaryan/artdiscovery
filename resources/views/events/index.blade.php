@extends('layouts.app')
@section('content')
<div class="container bg-white shadow-sm p-3">
  @include('includes.messages')
  <h1 class="text-center p-3 border-bottom">
    @lang('events.index')</h1>
    @if(Gate::allows('events-crud'))
      <div class="d-flex justify-content-between">
        <a href="{{ route('events.create') }}" class="btn btn-success btn-sm"><i class="fas fa-calendar-plus mr-2"></i>@lang('events.create')</a>
        <a href="{{ route('events.list') }}" class="btn btn-info btn-sm"><i class="far fa-calendar-alt mr-2"></i>@lang('events.list')</a>
      </div>
    @endif
    <div class="row">
    <div id="calendar" class="p-4 col-lg-6"></div>
    <div class="p-4 col-lg-6 event-card" id="info-container">
    </div>
  </div>
</div>
@endsection
