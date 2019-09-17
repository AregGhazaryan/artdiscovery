@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@include('includes.messages')
<div class="container shadow p-4">
  @if(!$sections->isEmpty())
  <h2 class="text-center">@lang('videos.edit')</h2>
  <hr>
    <form action="{{ route('admin.videos.update', $video->id) }}" method="post">
      @csrf
      @method('put')
        <div class="row">
            <div class="form-group col">
                <label for="title-hy">@lang('videoupload.title_hy')</label>
                <input type="text" name="title_hy" class="form-control" id="title-hy" value="{{ $video->title_hy }}"
                    placeholder="@lang('videoupload.title_hy')">
            </div>
            <div class="form-group col">
                <label for="title-en">@lang('videoupload.title_en')</label>
                <input type="text" name="title_en" class="form-control" id="title-en" value="{{ $video->title_en }}"
                    placeholder="@lang('videoupload.title_en')">
            </div>
        </div>
        <div class="form-group">
            <label for="section">@lang('videoupload.section')</label>
            <select name="section_id" id="section" class="form-control">
              @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->title }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">@lang('videoupload.date')</label>
            <input type="text" name="date" class="form-control" id="date" placeholder="@lang('videoupload.date')" value="{{ $video->date }}">
        </div>
        <div class="form-group">
            <label for="description-hy">@lang('videoupload.description_hy')</label>
            <textarea name="description_hy" class="form-control textarea" id="description-hy"
                placeholder="@lang('videoupload.description_hy')">{{ $video->description_hy }}</textarea>
        </div>
        <div class="form-group">
            <label for="description-en">@lang('videoupload.description_en')</label>
            <textarea name="description_en" class="form-control textarea" id="description-en"
                placeholder="@lang('videoupload.description_en')">{{ $video->description_en }}</textarea>
        </div>
        <div class="text-center">
          <input class="btn btn-success" type="submit" value="@lang('videoupload.submit')">
        </div>
    </form>
</div>

@else
<h3 class="text-center">@lang('videoupload.notallowed')</h3>
@endif
@endsection
