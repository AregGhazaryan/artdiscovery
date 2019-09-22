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
            @foreach($section->subsection as $subsection)
                
                <div class="accordion" id="subsection-accordion">
                    <div class="card">
                        <div class="card-header" style="background-color: #{{ $subsection->color }}" id="subsection{{ $subsection->id }}">
                            <h2 class="mb-0">
                              <a data-toggle="collapse" class="nav-link section-link" href="#subcol{{ $subsection->id }}" role="button" aria-expanded="false" aria-controls="subcol{{ $subsection->id }}">
                              <div class="section" id="{{ $subsection->id }}">
                            {{-- <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#subcol{{ $subsection->id }}" aria-expanded="true" aria-controls="collapseOne"> --}}
                                        <script>
                                            insertText('{{ $subsection->color }}', '{{ $subsection->id }}', '{{ $subsection->title }}')
                                        </script>
                                {{-- </button> --}}
                                </div>
                            </a>
                            </h2>
                        </div>

                        <div id="subcol{{ $subsection->id }}" class="collapse" aria-labelledby="{{ $subsection->title }}" data-parent="#subsection-accordion">
                            <div class="card-body" id="subsection-container{{ $subsection->id }}">
                                <div data-section-id="{{ $section->id }}" data-sub-section-id="{{ $subsection->id }}" class="timeline"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
                <script>
                    makeid('#subsection-container{{ $subsection->id }}', 4)
                </script>
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
