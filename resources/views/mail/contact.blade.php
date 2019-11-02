<style>
  body {
    background-color: #f1f1f1;
  }

  *:not(i) {
    font-family: 'Trebuchet MS', sans-serif;
  }

  .logo {
    width: 100%;
  }

  p{
    font-size: 16pt;
  }

  .container {
    max-width: min-content;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }

  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border-radius: 0.25rem;
    width: 50vw !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
  }

  .card-img-top {
    padding: 3rem !important;
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
  }

  hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    margin-right: 0;
    margin-left: 0;
  }

  h1 {
    text-align: center !important;
    font-size: 2.25rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
  }

  .card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
  }

  .card-footer {
    border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
    padding: 0.75rem 1.25rem;
    background-color: rgba(0, 0, 0, 0.03);
    border-top: 1px solid rgba(0, 0, 0, 0.125);
  }

  .p-5 {
    padding: 3rem !important;
  }
</style>
<div class="container">
  <div class="card border-0">
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
