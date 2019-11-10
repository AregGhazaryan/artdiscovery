<div class="left-sidebar js-pinned-left-sidebar" id="left-sidebar">
  <div class="left-sidebar--sticky-container js-sticky-leftnav">

    <nav id="sidebar">
      <ul class="list-unstyled components bg-white shadow-sm">
        <div class="sidebar-header text-dark">
          <h3>
            @lang('sections.index')</h3>
        </div>
        @foreach($sections as $section)
        <li class="active sidemenu-head">
          {{-- @if($section->subsection())
            <a href="#section{{ $section->id }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{$section->title}}</a>
            <ul class="list-unstyled collapse sidemenu-item" id="section{{ $section->id }}"> --}}
              {{-- @foreach($section->subsection as $subsection)
                <li>
                  <a href="#" class="text-orange">{{ $subsection->title }}</a>
                </li>
                @endforeach --}}
            {{-- </ul> --}}
            {{-- @else --}}
            <a href="#section{{ $section->id }}">{{$section->title}}</a>
          {{-- @endif --}}
        </li>
        @endforeach
      </ul>
    </nav>
  </div>
</div>
