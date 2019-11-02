@extends('layouts.app')
@section('content')
  @include('includes.adminnav')
  <div class="container bg-white shadow-sm">
    <h2 class="text-center pt-2">@lang('adminnav.pages')</h2>
    <hr>
    <div class="table-responsive">
      <table class="table centered-table">
        <thead>
          <tr>
            <th>
              @lang('pages.name')
            </th>
            <th>
              @lang('pages.actions')
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($pages as $page)
            <tr>
              <td>
                {{ $page->name }}
              </td>
              <td>
                <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-success btn-sm">
                  <i class="fas fa-edit mr-1"></i>
                  @lang('pages.edit')
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $pages->links() }}
    </div>
  </div>
@endsection
