@extends('layouts.app')
@section('content')
<form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="container bg-white profile-container-wrapper shadow-sm pb-1">
    @include('includes.messages')
    <div class="row profile-container">
      <div class="col-xl-4 profile-image-wrapper d-flex justify-content-center">
        <div class="inner-wrapper pb-4">
          <div class="profile-image row">
            <img id="preview" src="{{ asset('storage/profile_images/'. $user->avatar) }}" alt="Profile Image">
          </div>
          <div class="file btn btn-primary row">
            <i class="fas fa-upload mr-1"></i>
            @lang('profile.changeimg')
            <input type="file" name="file" id="image" />
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="profile-details-wrapper">
          <div class="profile-details">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="first-name">
                  @lang('registration.firstname')</label>
                  <input type="text" class="form-control" value="{{ $user->first_name }}" id="first-name" name="first_name" placeholder="@lang('registration.firstname')">
              </div>
              <div class="form-group col-md-6">
                <label for="last-name">
                  @lang('registration.lastname')</label>
                  <input type="text" class="form-control" value="{{ $user->last_name }}" id="last-name" name="last_name" placeholder="@lang('registration.lastname')">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">
                  @lang('registration.email')</label>
                  <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="@lang('registration.email')">
              </div>
              <div class="form-group col-md-6">
                <label for="gender">
                  @lang('registration.gender')</label>
                  <select name="gender" class="form-control">
                    <option value='male' @if($user->gender == "male") selected @endif>@lang('registration.male')</option>
                    <option value='female' @if($user->gender == "female") selected @endif>@lang('registration.female')</option>
                  </select>
              </div>
            </div>

            <div class="form-row">
              {{-- <div class="form-group col-md-6">
                <label for="address">
                  @lang('registration.address')</label>
                  <input type="text" class="form-control" value="{{ $user->address }}" id="address" name="address" placeholder="@lang('registration.address')">
              </div> --}}

              <div class="form-group col-md-6">
                <label for="birthday">
                  @lang('registration.birthdate')</label>
                  <input type="text" name="birth_date" id="datepicker" value="{{ $user->birthday }}" class="form-control">
              </div>
            </div>

            {{-- <div class="form-group">
              <label for="mobile">
                @lang('registration.mobile')</label>
                <input id="mobile" value="{{ $user->mobile }}" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" autocomplete="mobile">
            </div> --}}
            <a href="#" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse">
                @lang('registration.changepass')
              </a>

            <div class="form-row collapse" id="collapse">
              <div class="form-group col-md-6">
                <label for="password">
                  @lang('registration.password')</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="password-confirm">
                  @lang('registration.passconfirm')</label>
                  <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>
    <div class="save-wrapper text-right">
      <button type="submit" class="btn btn-success btn-lg my-3">
        @lang('profile.save')</button>
    </div>
  </div>
</form>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#image").change(function() {
    readURL(this);
  });
</script>
@endsection
