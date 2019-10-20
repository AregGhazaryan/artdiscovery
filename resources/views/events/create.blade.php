@extends('layouts.app')
@section('content')
<div class="container bg-white p-3 shadow-sm">
  <h1 class="text-center p-3 border-bottom">
    @lang('events.create')</h1>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group pt-4 row">
        <div class="col-lg-6">
          <div class="col-sm-12">
            <label for="title" class="col-form-label">
              @lang('events.title')</label>
          </div>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="title" name="title" placeholder="@lang('events.title')">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="col-sm-12">
            <label for="location" class="col-form-label">
              @lang('events.location')</label>
          </div>
          <div class="col-sm-12">
            <input type="text" class="form-control" id="location" name="location" placeholder="@lang('events.location')">
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-6">
          <label for="date" class="col-sm-12 col-form-label">
            @lang('events.start_date')</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="start-date" name="start_date" placeholder="2019-04-28 18:00">
            </div>
        </div>
        <div class="col-lg-6">
          <label for="date" class="col-sm-12 col-form-label">
            @lang('events.end_date')</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="title" name="end_date" placeholder="2019-06-18 20:00">
            </div>
        </div>
      </div>
      <div class="custom-file form-group">
        <div class="col-lg-12">
          <div class="col-sm-12">
            <input type="file" name="image" class="custom-file-input" id="imgInp">
            <label class="custom-file-label" for="customFile">
              @lang('events.image')</label>
          </div>
        </div>
      </div>
      <div id="image-preview" class="event-img-preview d-flex justify-content-center p-3"><img id="img"></div>

      <div class="form-group p-3">
        <textarea id="event-description" name="description"></textarea>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-lg">
          @lang('events.store')
        </button>
      </div>
    </form>
</div>
@endsection
