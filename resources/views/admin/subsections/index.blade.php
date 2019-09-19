@extends('layouts.app')
@section('content')
@include('includes.adminnav')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
  @endif
    <div class="container shadow p-4">
        <a href="{{ route('subsections.create') }}" class="btn btn-success btn-sm mb-2"><i class="fas fa-plus mr-2"></i>
            @lang('subsections.create')</a>
            <h2 class="text-center">
                @lang('subsections.index')</h2>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    @lang('subsections.title_hy')</th>
                                <th scope="col">
                                    @lang('subsections.title_en')</th>
                                <th scope="col">
                                    @lang('subsections.title_ru')</th>
                                <th scope="col">
                                    @lang('subsections.color')</th>
                                <th scope="col">
                                    @lang('subsections.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subsections as $section)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $section->title_hy }}</td>
                                <td>{{ $section->title_en }}</td>
                                <td>{{ $section->title_ru }}</td>
                                <td>
                                    <div class="section-color-pallete" style="background-color:#{{ $section->color }};"></div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('subsections.edit', $section->id) }}" class="btn btn-sm contain-button-sm btn-primary mr-2"><i class="fas fa-edit mr-2"></i>
                                            @lang('subsections.edit')</a>
                                            <form class="contain-button-sm" action="{{ route('subsections.destroy', $section->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-2"></i>
                                                    @lang('subsections.delete')</button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </div>
    @endsection
