@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow mt-5 border-0 auth-card">
        <div class="card-header bg-white text-center border-bottom border-orange">
          @lang('registration.register')</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.firstname')</label>

                  <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                    value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.lastname')</label>

                  <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                    value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="birth-date" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.birthdate')</label>

                  <div class="col-md-6">
                    <input type="text" name="birth_date" id="datepicker" class="form-control @error('birth_date') is-invalid @enderror" required>

                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.email')</label>

                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>
              <div class="form-group row">
                <label for="mobile" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.mobile')</label>

                  <div class="col-md-6">
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                    name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.address')</label>

                  <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" value="{{ old('address') }}" autocomplete="address">

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.gender')</label>
                  <div class="col-md-6">
                    <select class="form-control" id="gender" name="gender">
                      <option value="male">
                        @lang('registration.male')</option>
                      <option value="female">
                        @lang('registration.female')</option>
                    </select>
                  </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.password')</label>

                  <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                  @lang('registration.passconfirm')</label>

                  <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                  </div>
              </div>

              <div class="form-group">
                @error('terms')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="custom-control custom-checkbox row text-center">
                  <input type="checkbox" class="custom-control-input @error('terms') is-invalid @enderror" id="terms" name="terms">
                  <label class="custom-control-label" for="terms">
                    @lang('registration.terms')</label>
                </div>
              </div>

              <div class="form-group row d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                  @lang('registration.register')
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
