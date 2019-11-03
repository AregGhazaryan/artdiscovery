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

                  <div class="col-md-6 birthday-container">
                    {{-- <input type="text" name="birth_date" id="datepicker" class="form-control @error('birth_date') is-invalid @enderror" required> --}}
                    <select class="day form-control col-sm-4 float-left" name="day">
                      @for($day=1; $day <= 31; $day++)
                      <option value="{{ $day }}">
                        {{$day}}
                      </option>
                      @endfor
                    </select>
                    <select class="month form-control col-sm-4 float-left" name="month">
                      @for($month=1; $month <= 12; $month++)
                        <option value="{{ $month }}">
                        {{$month}}
                      </option>
                      @endfor
                    </select>
                    <select class="year form-control col-sm-4 float-left" name="year">
                      @for($year=1900; $year <= date("Y"); $year++)
                      <option value="{{ $year }}">
                        {{$year}}
                      </option>
                      @endfor
                    </select>
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
          <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>
          @if ($errors->has('g-recaptcha-response'))
          <span class="invalid-feedback" style="display: block;">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
          </span>
          @endif
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
