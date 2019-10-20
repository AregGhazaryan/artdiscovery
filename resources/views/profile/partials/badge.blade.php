@if($user->isAdmin())
<small><span class="badge badge-primary">@lang('badges.admin')</span></small>
@endif
@if($user->isAuthor())
  <span class="badge badge-success">@lang('badges.author')</span>
@endif
