@extends('layouts.app')
@section('content')
@include('includes.adminnav')
<div class="container shadow p-4 bg-white">
    <h2 class="text-center">
        @lang('subsections.create')</h2>
        <form action="{{ route('subsections.store') }}" method="post">
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
                <label for="title-hy">
                    @lang('subsections.title_hy')</label>
                    <input type="text" name="title_hy" class="form-control" id="title-hy" placeholder="@lang('subsections.title_hy')" required>
            </div>
            <div class="form-group">
                <label for="title-en">
                    @lang('subsections.title_en')</label>
                    <input type="text" name="title_en" class="form-control" id="title-en" placeholder="@lang('subsections.title_en')" required>
            </div>
            <div class="form-group">
                <label for="title-ru">
                    @lang('subsections.title_ru')</label>
                    <input type="text" name="title_ru" class="form-control" id="title-ru" placeholder="@lang('subsections.title_ru')" required>
            </div>
            <div class="form-group">
                <label for="title-en">@lang('subsections.color')</label>
                    <input type="text" name="color" class="form-control jscolor" id="color" placeholder="@lang('subsections.color')" value="ab2567" required>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success" value="@lang('subsections.submit')">
            </div>
        </form>
</div>
@endsection
