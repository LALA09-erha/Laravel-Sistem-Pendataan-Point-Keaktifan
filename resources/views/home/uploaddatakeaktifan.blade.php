@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Upload Point Keaktifan</h3>
                <p class="text-subtitle text-muted">Siapkan data yang diperlukan, Mahasiswa dapat mengirim berkali-kali.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Upload Point Keaktifan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                {{-- Masukkan form dengan input Nama, NIM, yang sudah terisi dari $data dan tidak bisa di ubah, lalu Semester , Data dari database $kegiatan dropdon, upload file pdf dengan max 10MB  tanpa error massage--}}
                <form action="/uploadpoint" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        {{-- check value if role == "mahasiswa" maka tampilin nim jika bukan nip --}}
                        <input type="text" class="form-control" id="nim" name="nim" value="{{$data['role'] == 'Mahasiswa' ? $data['nim'] : $data['nip']}}" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$data['name']}}" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" placeholder="Masukkan Semester Anda Pada Saat Kegiatan" required>                                                
                    </div>  

                    <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <select class="form-select" id="kegiatan" name="kegiatan" required>
                            <option selected>Pilih Kegiatan</option>
                            @foreach ($kegiatan as $kg)
                            <option value="{{$kg['id']}}">{{$kg['nama_kegiatan']}} | {{$kg['kedudukan_kegiatan']}} | {{$kg['tingkat_kegiatan']}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                        
                
               
            </div>
        </div>

    </section>
</div>
@endsection