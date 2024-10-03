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
    <label for="nim">NIM Mahasiswa</label>
    <div class="form-group position-relative has-icon-left mb-2">
        <input type="number" class="form-control form-control-xl" name="nim" placeholder="Masukkan NIM" autofocus required>
        <div class="form-control-icon">
            <i class="bi bi-type-italic"></i>
        </div>
    </div>
    <label for="name">Nama Mahasiswa</label>
    <div class="form-group position-relative has-icon-left mb-2">
        <input type="text" class="form-control form-control-xl" name="nama" placeholder="Masukkan Nama" required>
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <label for="email">Email Mahasiswa </label>
    <div class="form-group position-relative has-icon-left mb-2">
        <input type="email" class="form-control form-control-xl" name="email" placeholder="Masukkan Email" required>
        <div class="form-control-icon">
            <i class="bi bi-envelope"></i>
        </div>
    </div>
    
    <label for="dosen">Dosen Wali</label>
    <div class="form-group position-relative has-icon-left mb-2">
        <select name="dosen" id="dosen" class="form-select" required >
            @foreach ($dosen as $dsn)
            <option value="{{$dsn->nip}}">{{$dsn->name}}</option>
            @endforeach
        </select>
    </div>

    <label for="prodi">Program Studi</label>
    <div class="form-group position-relative has-icon-left mb-2">
        <select name="prodi" id="prodi" class="form-select" required >
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
            <option value="Teknik Industri">Teknik Industri</option>
            <option value="Teknik Mekatronika">Teknik Mekatronika</option>
        </select>
    </div>


    <label for="password">Password</label>
    <div class="form-group position-relative has-icon-left mb-2"> 
        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Register</button>
    <a href="/login" class="btn btn-outline-primary btn-block btn-lg shadow-lg mt-1">Login</a>

</form>
@endsection