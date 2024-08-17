@extends('auth\tamplate')
    
@section('content')
<h1 class="auth-title">Log in.</h1>
<p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
@if (\Session::has('message'))
<div class="alert alert-danger">    
    <ul>
        <li>{!! \Session::get('message') !!}</li>
        
    </ul>
</div>
@endif
<form action="/prosesLogin" method="post">
    @csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" class="form-control form-control-xl" name="nim" placeholder="Masukkan NIM">
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4"> 
        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
</form>
@endsection