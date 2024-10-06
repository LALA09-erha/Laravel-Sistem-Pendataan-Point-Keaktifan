@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <h3 class="m-2">Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8">
            <div class="card m-2">
                <h5 class="text-center m-2">Selamat Datang {{ $user['name']? $user['name'] :"User"}}</h5>                        
                    <div class="card m-2">
                        <p class="m-2" style="text-align: justify">&emsp; Selamat Datang di Sistem Pendataan Keaktifan Mahasiswa. Sistem Pendataan Keaktifan Mahasiswa adalah sistem yang memungkinkan para civitas akademika Universitas Trunojoyo Madura untuk menerima informasi tentang point mahasiswa. Sistem ini diharapkan dapat memberi kemudahan setiap civitas akademika untuk melakukan aktivitas-aktivitas akademik dan proses belajar mengajar. Selamat menggunakan fasilitas ini.</p>
                    </div>
            </div>

            <div class="card m-2">
                    <div class="card m-2">
                        <p class="m-2" style="text-align: justify">&emsp; Berdasarkan Keputusan Rektor Universitas Trunojoyo Madura NOMOR 174/UN46/HK.02/2022 Tentang Kurikulum Kemahasiswaan. Bahwa Ditjen Belmawa terus mengupayakan agar kepedulian PT terus meningkat dalam bidang kemahasiswaan oleh karena itu Ditjen Belmawa memprakasi penyelenggaraan program klasterisasi dan pemeringkatan bidang kemahasiswaan yang ditujukan untuk menjadi wahanabagi PT melaporkan prestasi-prestasi mahasiswa dan institusi bidang kemahasiswaan terkait.Sistem Informasi Manajemen Pemeringkatan Kemahasiswaan (SIMKATMAWA) ini merupakan acuan bagi kementerian dan perguruan tinggi dalam melaksanakan pelaporan kinerja dan atau prestasi dalam bidang kemahasiswaan. Proses penilaian pemeringkatan bidang kemahasiswaan ditentukan berdasarkan empat aspek penilaian yaitu: <br>a. Institusi, <br>b.Prestasi Ko dan Ekstrakurikuler Belmawa, <br>c. Prestasi Ko dan Ekstrakurikuler Mandiri, <br>d. Non Lomba/Pengakuan/Rekognisi</p>
                    </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card m-2">
                <img src="https://i.pinimg.com/originals/33/ba/c0/33bac083ba44f180c1435fc41975bf36.jpg" class="card-img-top" alt="...">
                <h5 class="m-2" > Data User:</h5>
                <p class="m-2" >{{$user['name']}}</p>
                <p class="m-2" >{{$user['role']=='Mahasiswa'?$user['nim']:$user['nip']}}</p>
                <p class="m-2" >{{$user['email']}}</p>
                <span class="btn btn-primary m-2" data-bs-target="#modal-profile" data-bs-toggle="modal">Edit Profile</span>
            </div>
        </div>
        <div class="modal fade text-left" id="modal-profile" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Edit Detail Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x">X</i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/edit-profile" method="post" style="width:100%">
                        @csrf
                        <div class="form-group has-icon-left" style="width: 100%">
                            <input type="hidden" name="role" value="{{ $user['role'] }}">
                            <label for="password-id-icon">{{$user['role']=='Mahasiswa'?'NIM':'NIP'}}</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="{{ $user['role']=='Mahasiswa'?'nim':'nip' }}" readonly
                                    placeholder="NIM" id="password-id-icon" required
                                    value="{{ $user['role']=='Mahasiswa'?$user['nim']:$user['nip'] }}">
                                <div class="form-control-icon">
                                    <i class="bi bi-calendar"></i>
                                </div>
                            </div>
                            <label for="password-id-icon">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Email" id="password-id-icon" required
                                    value="{{ $user['email'] }}">
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>
                            <label for="password-id-icon">Name</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Name" id="password-id-icon" required
                                    value="{{ $user['name'] }}">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>                            

                            <label for="password-id-icon">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" name="password" value="{{ $user['password'] }}"
                                    placeholder="Password" id="password-id-icon" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <small class="text-danger">Harap Ingat Password Anda</small>
                        </div>                                                                                            
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="close"
                                class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </section>
</div>
@endsection