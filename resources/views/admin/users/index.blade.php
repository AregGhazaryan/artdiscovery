@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container shadow p-4">
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
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        {{ $user->first_name . " " . $user->last_name  }}
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
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection
