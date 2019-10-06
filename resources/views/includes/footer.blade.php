<footer class="page-footer font-small stylish-color-dark pt-4">
  <div class="container text-center text-md-left">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <img src="{{ asset('img/footer-logo.png') }}" class="footer-logo" />
      </div>
      <hr class="clearfix w-100 d-md-none">
      <div class="col mx-auto text-center">
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
          @lang('footer.website')</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#">
                @lang('footer.privacy')</a>
            </li>
            <li>
              <a href="#!">
                @lang('footer.services')</a>
            </li>
          </ul>
      </div>
      <hr class="clearfix w-100 d-md-none">
      <div class="col mx-auto text-center">
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
          @lang('footer.aboutus')</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#!">
                @lang('footer.contact')</a>
            </li>
            <li>
              <a href="#!">
                @lang('footer.faq')</a>
            </li>
          </ul>
      </div>
      <hr class="clearfix w-100 d-md-none">
    </div>
  </div>
  <hr>
  @guest
  <ul class="list-unstyled list-inline text-center py-2">
    <li class="list-inline-item">
      <h5 class="mb-1">
        @lang('footer.register')</h5>
    </li>
    <li class="list-inline-item">
      <a href="{{route('register')}}" class="btn btn-danger btn-rounded">
        @lang('footer.registerbtn')</a>
    </li>
  </ul>
  <hr>
  @endguest
  <ul class="list-unstyled list-inline text-center">
    <li class="list-inline-item">
      <a class="btn-floating btn-fb mx-1" href="https://www.facebook.com/artdiscovery.online/" target="_blank">
        <i class="fab fa-facebook-f"> </i>
      </a>
    </li>
  </ul>
  <div class="footer-copyright text-center py-3">© {{date('Y')}} Copyright:
    <a href="{{route('home')}}">ArtDiscovery.online</a>
  </div>
</footer>
