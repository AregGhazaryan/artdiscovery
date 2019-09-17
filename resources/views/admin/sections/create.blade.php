@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container shadow p-4">
    <h2 class="text-center">
        @lang('sections.create')</h2>
        <form action="{{ route('sections.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title-hy">
                    @lang('sections.title_hy')</label>
                    <input type="text" name="title_hy" class="form-control" id="title-hy" placeholder="@lang('sections.title_hy')">
            </div>
            <div class="form-group">
                <label for="title-en">
                    @lang('sections.title_en')</label>
                    <input type="text" name="title_en" class="form-control" id="title-en" placeholder="@lang('sections.title_en')">
            </div>
            <div class="form-group">
                <label for="title-ru">
                    @lang('sections.title_ru')</label>
                    <input type="text" name="title_ru" class="form-control" id="title-ru" placeholder="@lang('sections.title_ru')">
            </div>
            <div class="form-group">
                <label for="title-en">@lang('sections.color')</label>
                    <input type="text" name="color" class="form-control jscolor" id="color" placeholder="@lang('sections.color')" value="ab2567">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success" value="@lang('sections.submit')">
            </div>
        </form>
</div>
@endsection
