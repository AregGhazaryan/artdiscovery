@extends('layouts.app')
@section('content')
  @include('includes.messages')
  <div class="main-container d-flex justify-content-center">
    @include('includes.left-sidemenu')

  @include('components.posts.main-posts')
</div>
@endsection
