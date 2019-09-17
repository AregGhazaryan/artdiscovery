@extends('layouts.app')
@section('content')

<div class="accordion section-accordion" id="accordion">
    @foreach($sections as $section)
    <div class="card">
        <div class="card-header" style="background-color: #{{ $section->color }}" id="heading{{$section->id}}">
            <a data-toggle="collapse" class="nav-link section-link" href="#collapse{{ $section->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $section->id }}">
                <div class="section" id="{{ $section->id }}">
                    <script>
                        insertText('{{ $section->color }}', '{{ $section->id }}', '{{ $section->title }}')
                    </script>
                </div>
            </a>
        </div>

        <div id="collapse{{$section->id}}" class="collapse" aria-labelledby="heading{{$section->id}}" data-parent="#accordion">
            <div class="card-body">
                <div class="timeline"></div>
                <script>makeid('#collapse{{ $section->id }}',4)</script>
            </div>
        </div>
    </div>


    @endforeach
</div>

<div id="item-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    folder = '{{ asset("storage/videos") }}';
</script>
<script src={{ asset('js/timeline.js') }}></script>
@endsection
