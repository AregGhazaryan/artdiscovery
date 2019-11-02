<nav class="navbar navbar-expand-md navbar-light bg-white admin-nav">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin-nav-collapse"
      aria-controls="admin-nav-collapse" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin-nav-collapse">
      <ul class="navbar-nav w-100 justify-content-between">
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-video mr-1"></i>
            @lang('adminnav.videos')<span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('admin.videos.create') }}">
              <i class="fas fa-file-video mr-1"></i>
              @lang('adminnav.addvideo')
            </a>
            <a class="dropdown-item" href="{{ route('admin.videos.adminIndex') }}">
              <i class="fas fa-film mr-1"></i>
              @lang('adminnav.allvideos')
            </a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-list mr-1"></i>
            @lang('adminnav.sections')<span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('sections.index') }}">
              <i class="fas fa-bars mr-1"></i>
              @lang('adminnav.sections')
            </a>
            <a class="dropdown-item" href="{{ route('subsections.index') }}">
              <i class="fas fa-grip-lines mr-1"></i>
              @lang('adminnav.subsections')
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users mr-1"></i>
            @lang('adminnav.users')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.purchases') }}"><i class="fas fa-scroll mr-1"></i>
            @lang('adminnav.purchases')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pages.index') }}"><i class="fas fa-file-alt mr-1"></i>
            @lang('adminnav.pages')</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
