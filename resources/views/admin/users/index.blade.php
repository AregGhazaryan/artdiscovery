@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container shadow p-4 bg-white">
  <h2 class="text-center">
    @lang('users.index')</h2>
    <table class="table text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">
            @lang('users.fullname')</th>
          <th scope="col">
            @lang('users.email')</th>
          <th scope="col">
            @lang('users.gender')</th>
            <th scope="col">
              @lang('users.actions')
            </th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>
            <a href="{{ route('profile.show', $user->id) }}">{{ $user->first_name . " " . $user->last_name  }}</a>
          </td>
          <td>
            {{ $user->email }}
          </td>
          <td>
            @if($user->gender === 'male')
              @lang('users.male')
              @else
              @lang('users.female')
              @endif
          </td>
          <td>
            @if($user->isBanned())
              <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('users.unban')" href="{{ route('user.unban', $user->id) }}"><i class="fas fa-unlock"></i></a>
            @else
              <a class="btn btn-danger" href="{{ route('user.ban', $user->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('users.ban')"><i class="fas fa-ban"></i></a>
            @endif
            @if($user->isAuthor())
              <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('users.unsetauthor')" href="{{ route('user.unset-author', $user->id) }}"><i class="fas fa-user-alt-slash"></i></a>
            @else
              <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="@lang('users.setauthor')" href="{{ route('user.set-author', $user->id) }}"><i class="fas fa-id-badge"></i></a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
