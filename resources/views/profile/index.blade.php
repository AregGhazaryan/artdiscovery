@extends('layouts.app')
@section('content')
<div class="container bg-white profile-container-wrapper shadow-sm pb-1">
  @include('includes.messages')
  <div class="row profile-container border-0">
    <div class="col-lg-4 profile-image-wrapper mb-4 d-flex justify-content-center">
      <div class="profile-image row">
        <img src="{{ asset('storage/profile_images/'. $user->avatar) }}" alt="Profile Image">
      </div>
    </div>
    <div class="col-lg-8">
      <div class="profile-details-wrapper">
        <div class="profile-details">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$user->first_name . ' ' .$user->last_name}} @if($user->online ) <small class="profile-status"><div class="green-dot pulse"></div></small> @endif <a href="{{ route('profile.edit', $user->id) }}" class="float-right btn btn-sm btn-info"><i class="fas fa-user-edit mr-2"></i>@lang('profile.edit')</a></li>
            @if(Auth::user()->type == 'admin' || Auth::user()->id == $user->id)
              <li class="list-group-item">@lang('profile.email') : {{$user->email}}</li>
              <li class="list-group-item">@lang('profile.gender') : {{$user->sex}}</li>
              <li class="list-group-item">@lang('profile.address') : {{$user->address}}</li>
              <li class="list-group-item">@lang('profile.birthday') : {{$user->birthday}}</li>
              <li class="list-group-item">@lang('profile.mobile') : {{$user->mobile}}</li>
              @else
              <li class="list-group-item">@lang('profile.gender') : {{$user->sex}}</li>
              <li class="list-group-item">@lang('profile.birthday') : {{$user->birthday}}</li>
              @endif
              <li class="list-group-item"><small class="text-muted">@lang('profile.disclaimer')</small></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  {{-- @include('components.posts.profile-posts') --}}
</div>
@endsection
