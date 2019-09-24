@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@include('includes.messages')
<div class="container shadow p-4">
  @if(!$sections->isEmpty())
    <h2 class="text-center">
      @lang('videos.edit')</h2>
      <hr>
      <form action="{{ route('admin.videos.update', $video->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
          <div class="form-group col">
            <label for="title-hy">
              @lang('videoupload.title_hy')</label>
              <input type="text" name="title_hy" class="form-control" id="title-hy" value="{{ $video->title_hy }}" placeholder="@lang('videoupload.title_hy')">
          </div>
          <div class="form-group col">
            <label for="title-en">
              @lang('videoupload.title_en')</label>
              <input type="text" name="title_en" class="form-control" id="title-en" value="{{ $video->title_en }}" placeholder="@lang('videoupload.title_en')">
          </div>
          <div class="form-group col">
            <label for="title-en">
              @lang('videoupload.title_ru')</label>
              <input type="text" name="title_ru" class="form-control" id="title-ru" value="{{ $video->title_ru }}" placeholder="@lang('videoupload.title_ru')">
          </div>
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="section">
              @lang('videoupload.section')</label>
              <select name="section_id" id="section" class="form-control">
                @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->title }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col">
            <label for="subsection">
              @lang('videoupload.subsection')</label>
              <select name="subsection_id" id="subsection" class="form-control">
                @foreach($subsections as $section)
                <option value="{{ $section->id }}">{{ $section->title }}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="video">
            @lang('videoupload.file')</label>
            <div class="custom-file">
              <input type="text" class="form-control" name="video" id="video" value="{{ $video->video }}">
            </div>
        </div>
        <div class="form-group">
          <label for="date">
            @lang('videoupload.date')</label>
            <div class="row">
              <div class="col">
                <label for="start_date">
                  @lang('videoupload.start_date')</label>
                  <input type="text" name="start_date" class="form-control" id="start_date" placeholder="1440-08-23" value="{{ $video->start_date }}">
              </div>
              <div class="col">
                <label for="end_date">
                  @lang('videoupload.end_date')</label>
                  <input type="text" name="end_date" class="form-control" id="end_date" placeholder="1440-08-23" value="{{ $video->end_date }}">
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="section">
                    @lang('videoupload.price')</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <select name="currency_id" id="currency-id" class="input-group-text dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          @foreach($currencies as $currency)
                          @if($currency->id === $video->currency_id)
                            <option selected value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                            @else
                            <option value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                            @endif
                            @endforeach
                        </select>
                      </div>
                      <input type="text" class="form-control" aria-label="price" name="price" placeholder="@lang('videoupload.price')">
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="form-group">
          <label for="description-hy">
            @lang('videoupload.description_hy')</label>
            <textarea name="description_hy" class="form-control textarea" id="description-hy" placeholder="@lang('videoupload.description_hy')">{{ $video->description_hy }}</textarea>
        </div>
        <div class="form-group">
          <label for="description-en">
            @lang('videoupload.description_en')</label>
            <textarea name="description_en" class="form-control textarea" id="description-en" placeholder="@lang('videoupload.description_en')">{{ $video->description_en }}</textarea>
        </div>
        <div class="form-group">
          <label for="description-ru">
            @lang('videoupload.description_ru')</label>
            <textarea name="description_ru" class="form-control textarea" id="description-ru" placeholder="@lang('videoupload.description_ru')">{{ $video->description_ru }}</textarea>
        </div>
        <div class="text-center">
          <input class="btn btn-success" type="submit" value="@lang('videoupload.submit')">
        </div>
      </form>
</div>

@else
<h3 class="text-center">
  @lang('videoupload.notallowed')</h3>
  @endif
  @endsection
