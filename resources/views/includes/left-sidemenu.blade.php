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
        <a href="{{ route('section', $section->id) }}">{{$section->title}}</a>
        {{-- @endif --}}
        </li>
        @endforeach
      </ul>
    </nav>

    <nav id="sidebar">
      <div class="about-us-sidebar bg-white shadow-sm">
        <ul class="list-unstyled components bg-white shadow-sm">
          <div class="sidebar-header text-dark">
            <h3>@lang('footer.aboutus')</h3>
          </div>
          <li class="sidemenu-head">
            <a href="{{ route('contact') }}"><i class="fas fa-envelope mr-2"></i>@lang('footer.contact')</a>
          </li>
          <li class="sidemenu-head">
            <a href="{{ route('activities') }}"><i class="fas fa-chalkboard mr-2"></i>@lang('footer.activities')</a>
          </li>
          <li class="sidemenu-head">
            <a href="{{ route('faq') }}"><i class="fas fa-question-circle mr-2"></i>@lang('footer.faq')</a>
          </li>
        </ul>
      </div>
    </nav>

    <nav id="sidebar">
      <div class="about-us-sidebar bg-white shadow-sm">
        <ul class="list-unstyled components bg-white shadow-sm">
          <div class="sidebar-header text-dark">
            <h4>@lang('footer.website')</h4>
          </div>
          <li class="sidemenu-head">
            <a href="{{ route('privacy-policy') }}"><i class="fas fa-file-contract mr-2"></i>@lang('footer.privacy')</a>
          </li>
          <li class="sidemenu-head">
            <a href="{{ route('terms-of-service') }}"><i class="fas fa-file-alt mr-2"></i>@lang('footer.services')</a>
          </li>
        </ul>
      </div>
    </nav>

  </div>
</div>
