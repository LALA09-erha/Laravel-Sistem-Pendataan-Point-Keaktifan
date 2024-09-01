@extends('auth\tamplate')
    
@section('content')
<h1 class="auth-title">Register.</h1>
<p class="auth-subtitle mb-5">Register yourself with correct personal data.</p>
@if (\Session::has('message'))
<div class="alert alert-danger">    
    <ul>
        <li>{!! \Session::get('message') !!}</li>
        
    </ul>
</div>
@endif
<form action="/prosesregist" method="post">
    @csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="number" class="form-control form-control-xl" name="nim" placeholder="Masukkan NIM" autofocus required>
        <div class="form-control-icon">
            <i class="bi bi-type-italic"></i>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="text" class="form-control form-control-xl" name="nama" placeholder="Masukkan Nama" required>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" class="form-control form-control-xl" name="email" placeholder="Masukkan Email" required>
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
    </div>
    {{-- <div class="form-group position-relative has-icon-left mb-4">
        <input type="number" class="form-control form-control-xl" name="tahun_ajaran" placeholder="Tahun Ajaran" required>
        <div class="form-control-icon">
            <i class="bi bi-clock"></i>
        </div>
    </div> --}}
    {{-- dropdown prodi di sini pada prodi yang ada di universitas --}}
    <div class="form-group position-relative has-icon-left mb-4">
        <select name="prodi" id="prodi" class="form-select" required >
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
            <option value="Teknik Industri">Teknik Industri</option>
            <option value="Teknik Mekatronika">Teknik Mekatronika</option>
        </select>
    </div>



    <div class="form-group position-relative has-icon-left mb-4"> 
        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Register</button>
    <a href="/login" class="btn btn-outline-primary btn-block btn-lg shadow-lg mt-1">Login</a>

</form>
@endsection