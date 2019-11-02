@extends('layouts.app')
@section('content')
<div class="container bg-white shadow-sm p-4">
  @include('includes.messages')
  <h2 class="text-center p-3 border-bottom">
    @lang('footer.contact')</h2>
    <div class="row">
      <div class="p-3 col-lg-6">
        <div class="p-4 rounded-pill border row m-2">
          <div class="col-lg-3 text-center">
            <i class="fa-4x fas fa-address-card text-primary"></i>
          </div>
          <div class="col-lg-9 text-center">
            <h4>
              @lang('contact.artdirector')</h4>
              <h5>
                @lang('contact.anush')</h5>
          </div>
        </div>
      </div>
      <div class="p-3 col-lg-6">
        <div class="p-4 rounded-pill border row m-2">
          <div class="col-lg-3 text-center">
            <i class="fa-4x fas fa-address-card text-primary"></i>
          </div>
          <div class="col-lg-9 text-center">
            <h4>
              @lang('contact.administrator')</h4>
              <h5>
                @lang('contact.ruben')</h5>
          </div>
        </div>
      </div>
    </div>
    <form action="{{ route('send-mail') }}" method="post" class="p-2">
      @csrf
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" name="first_name" placeholder="@lang('contact.firstname')">
        </div>
        <div class="col">
          <input type="text" class="form-control" name="last_name" placeholder="@lang('contact.lastname')">
        </div>
        <div class="col">
          <input type="email" class="form-control" name="email" placeholder="@lang('contact.email')">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <textarea maxlength="3000" class="textarea form-control mt-3" name="body"></textarea>
        </div>
      </div>
      <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>
      @if ($errors->has('g-recaptcha-response'))
      <span class="invalid-feedback" style="display: block;">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
      </span>
      @endif
      <div class="d-flex justify-content-center mt-3">
        <button type="submit" class="text-center btn btn-success btn-lg">
          @lang('contact.send')</button>
      </div>
    </form>
</div>
@endsection
