@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
  @endforeach
@endif
@if (session('message'))
  <div class="alert alert-success" role="alert">
      {{ session('message') }}
  </div>
@endif
@if (session('error-message'))
  <div class="alert alert-danger" role="alert">
      {{ session('error-message') }}
  </div>
@endif
