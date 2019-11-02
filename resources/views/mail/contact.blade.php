<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
.logo{
  width: 100%;
}
.card{
  width: 50vw !important;
}
</style>
<div class="container">
  <div class="card shadow border-0">
    <div class="card-img-top p-5">
      <img class="logo" src="{{ asset('logo.png') }}">
    </div>
    <hr>
    <h1 class="text-center">{{ $name }}</h1>
    <div class="card-body">
      <p>{{ $body }}</p>
    </div>
    <div class="card-footer">{{ $email }}</div>
  </div>
</div>
