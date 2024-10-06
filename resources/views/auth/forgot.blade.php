@extends('auth\tamplate')
    
@section('content')
<h1 class="auth-title">Forgot Password.</h1>
<p class="auth-subtitle mb-1">Enter your email and we will send you a link to reset your password.</p>
@if (\Session::has('message'))
<div class="alert alert-danger">    
    <ul>
        <li>{!! \Session::get('message') !!}</li>
    </ul>
</div>
@endif
<form action="/prosesForgot" method="post">
    @csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" class="form-control form-control-xl" name="email" placeholder="Masukkan Alamat Email">
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
    </div>
     
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" onclick="loader()">Submit</button>
    <a href="/login" class="btn btn-outline-primary btn-block btn-lg shadow-lg mt-1">Login</a>
</form>

<div class='loading' 
    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/YouTube_loading_symbol_3_%28transparent%29.gif" alt='loading'>
    <h1 class="text-white text-center ">Loading...</h1>
 </div>

<script>
    // ketika loader di klik maka loading akan muncul selama proses mengirimkan email 
    document.querySelector('.loading').style.display = 'none';

    function loader() {

        document.querySelector('.loading').style.display = 'flex';
    }

</script>

@endsection