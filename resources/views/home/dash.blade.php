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
                <h5 class="m-2" > Data User:</h5>
                <p class="m-2" >{{$user['name']}}</p>
                <p class="m-2" >{{$user['role']=='Mahasiswa'?$user['nim']:$user['nip']}}</p>
                <p class="m-2" >{{$user['email']}}</p>
            </div>
        </div>

    </section>
</div>
@endsection