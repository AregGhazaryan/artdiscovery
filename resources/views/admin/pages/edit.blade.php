@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container bg-white shadow-sm p-4">
  @include('includes.messages')
  <h2 class="text-center pt-2">
    @lang('pages.edit')</h2>
    <hr>
    <form action="{{ route('pages.update', $page->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title_hy">@lang('pages.namehy')</label>
        <input type="text" name="title_hy" class="form-control" placeholder="@lang('pages.namehy')" value="{{ $page->title_hy }}">
      </div>
      <div class="form-group">
        <textarea class="page-editor" name="description_hy">{!! $page->description_hy !!}</textarea>
      </div>
      <div class="form-group">
        <label for="title_en">@lang('pages.nameen')</label>
        <input type="text" name="title_en" class="form-control" placeholder="@lang('pages.nameen')" value="{{ $page->title_en }}">
      </div>
      <div class="form-group">
        <textarea class="page-editor" name="description_en">{!! $page->description_en !!}</textarea>
      </div>
      <div class="form-group">
        <label for="title_ru">@lang('pages.nameru')</label>
        <input type="text" name="title_ru" class="form-control" placeholder="@lang('pages.nameru')" value="{{ $page->title_ru }}">
      </div>
      <div class="form-group">
        <textarea class="page-editor" name="description_ru">{!! $page->description_ru !!}</textarea>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-lg btn-success">@lang('pages.edit')</button>
      </div>
    </form>
</div>
@endsection
