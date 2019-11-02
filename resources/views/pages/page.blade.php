@extends('layouts.app')
@section('content')
  <div class="container bg-white shadow-sm p-4">
    <h2 class="text-center">{{ $page->name }}</h2>
    <hr>
    <p>
      {!! $page->details !!}
    </p>
  </div>
@endsection
