@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container shadow p-4">
    <h2 class="text-center">@lang('sections.edit')</h2>
    <form action="{{ route('sections.update', $subsection->id) }}" method="post">
      @method('put')
      @csrf
      <div class="form-group">
          <label for="section_id">
              @lang('subsections.section')</label>
              <select name="section_id" class="form-control">
                  @foreach($sections as $item)
                      <option value="{{ $item->id }}">
                          {{ $item->title }}
                      </option>
                  @endforeach
              </select>
      </div>
        <div class="form-group">
            <label for="title-hy">@lang('sections.title_hy')</label>
            <input type="text" name="title_hy" class="form-control" id="title-hy" placeholder="@lang('sections.title_hy')" value="{{ $subsection->title_hy }}" required>
        </div>
        <div class="form-group">
            <label for="title-en">@lang('sections.title_en')</label>
            <input type="text" name="title_en" class="form-control" id="title-en" placeholder="@lang('sections.title_en')" value="{{ $subsection->title_en }}" required>
        </div>
        <div class="form-group">
            <label for="title-ru">@lang('sections.title_ru')</label>
            <input type="text" name="title_ru" class="form-control" id="title-ru" placeholder="@lang('sections.title_ru')" value="{{ $subsection->title_ru }}" required>
        </div>
        <div class="form-group">
            <label for="title-en">@lang('sections.color')</label>
            <input type="text" name="color" class="form-control jscolor" id="color" placeholder="@lang('sections.color')" value="{{$subsection->color}}" required>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-success" value="@lang('sections.edit')">
        </div>
    </form>
</div>
@endsection
