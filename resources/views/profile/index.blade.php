@extends('layouts.app')
@section('content')
<div class="container bg-white profile-container-wrapper shadow-sm">
  <div class="row profile-container">
    <div class="col-lg-3 profile-image-wrapper">
      <div class="profile-image d-flex justify-content-center">
        <img src="{{ asset('storage/profile_images/'. $user->avatar) }}" alt="Profile Image">
      </div>
    </div>
    <div class="col-lg-9">
      <div class="profile-details-wrapper">
        <div class="profile-details">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$user->first_name . ' ' .$user->last_name}}</li>
            @if(Auth::user()->type == 'admin')
              <li class="list-group-item">{{$user->email}}</li>
              @endif
              <li class="list-group-item">{{$user->gender}}</li>
              @if(Auth::user()->type == 'admin')
              <li class="list-group-item">{{$user->mobile}}</li>
              @endif
              <li class="list-group-item">{{$user->bio}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
