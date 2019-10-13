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
        @auth
        @if(Auth::user()->isAdmin())
        <div class="dropdown post-options float-right">
          <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @if($user->isBanned())
            <a class="dropdown-item waves-light edit-post" data-toggle="modal" data-target="#confirm-ban" href="#confirm-ban">@lang('users.unban')</a>
            @else
            <a class="dropdown-item waves-light edit-post" data-toggle="modal" data-target="#confirm-ban" href="#confirm-ban">@lang('users.ban')</a>
            @endif
          </div>
        </div>
        @endif
        @endauth
        <div class="profile-details">

          <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$user->first_name . ' ' .$user->last_name}} @if($user->online ) <small
                class="profile-status">
                <div class="green-dot pulse"></div>
              </small>
              @endif
              @if(Auth::user()->id == $user->id)
              <a href="{{ route('profile.edit', $user->id) }}" class="float-right btn btn-sm btn-info"><i
                  class="fas fa-user-edit mr-2"></i>@lang('profile.edit')</a>
              @endif

            </li>
            @if(Auth::user()->isAdmin() || Auth::user()->id == $user->id)
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
@auth
@if(Auth::user()->isAdmin())
<div class="modal border-0 fade" tabindex="-1" role="dialog" id="confirm-ban"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('confirmation.check')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($user->isBanned())
        @lang('confirmation.unbanuser')
        @else
        @lang('confirmation.banuser')
        @endif
      </div>
      <div class="modal-footer">
        @if($user->isBanned())
        <a href="/user/{{$user->id}}/unban" class="btn btn-primary">@lang('confirmation.yes')</a>
        @else 
        <a href="/user/{{$user->id}}/ban" class="btn btn-primary">@lang('confirmation.yes')</a>
        @endif
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('confirmation.close')</button>
      </div>
    </div>
  </div>
</div>
@endif
@endauth
@endsection
