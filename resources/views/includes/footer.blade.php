<footer class="page-footer font-small stylish-color-dark pt-4">
  <div class="container text-center text-md-left">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <img src="{{ asset('img/footer-logo.png') }}" class="footer-logo" />
      </div>
      <hr class="clearfix w-100 d-md-none">
      <div class="col mx-auto text-center">
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">
          @lang('footer.website')</h6>
          <ul class="list-unstyled">
            <li>
              <a href="{{route('privacy-policy')}}">
                @lang('footer.privacy')</a>
            </li>
            <li>
              <a href="{{route('terms-of-service')}}">
                @lang('footer.services')</a>
            </li>
          </ul>
      </div>
      <hr class="clearfix w-100 d-md-none">
      <div class="col mx-auto text-center">
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">
          @lang('footer.aboutus')</h6>
          <ul class="list-unstyled">
            <li>
              <a href="{{route('contact')}}">
                @lang('footer.contact')</a>
            </li>
            <li>
              <a href="#!">
                @lang('footer.faq')</a>
            </li>
          </ul>
      </div>
      <hr class="clearfix w-100 d-md-none">
      <div class="col mx-auto text-center">
        <h6 class="font-weight-bold text-uppercase mt-3 mb-4">
          @lang('footer.developer')</h6>
          <a href="https://areg.site" target="_blank">
            <img class="footer-dev-logo" src="{{ asset('img/a.png') }}"></a>
      </div>
    </div>
  </div>
  <hr>
  @guest
  <ul class="list-unstyled list-inline text-center py-2">
    <li class="list-inline-item">
      <h5 class="mb-1">
        @lang('footer.register')</h5>
    </li>
    <li class="list-inline-item bg-success pulse rounded">
      <a href="{{route('register')}}" class="btn btn-success">
        @lang('footer.registerbtn')</a>
    </li>
  </ul>
  <hr>
  @endguest
  <ul class="list-unstyled list-inline text-center">
    <li class="list-inline-item">
      <a class="btn-floating btn-fb mx-1" href="https://www.facebook.com/artdiscovery.online/" target="_blank">
        <i class="fab fa-facebook-square fa-3x"></i>
      </a>
    </li>
  </ul>
  <div class="footer-copyright text-center py-3">© {{date('Y')}} Copyright:
    <a href="{{route('home')}}">ArtDiscovery.online</a>
  </div>
</footer>
