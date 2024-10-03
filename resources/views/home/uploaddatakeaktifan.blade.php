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
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal Anda Pada Saat Kegiatan" required>                                                
                    </div>                 

                    <div class="form-group">
                        <label for="sub_kategori">Sub Kategori</label>
                        <select class="form-select" id="sub_kategori" name="sub_kategori" required 
                                onchange="updateKegiatanDiv(this.value)">
                            <option value='null'>Pilih Sub Kegiatan</option>
                            @foreach ($subkategori_kegiatan as $sub)
                            <option value="{{$sub['nama_subkategori']}}">{{$sub['nama_subkategori']}}</option>                            
                            @endforeach
                        </select>
                    </div>
                    
                    @foreach ($temp_kegiatan as $key => $kegiatans)
                        <div class="form-group kelas_kegiatan" id="kegiatan_div_{{$key}}" style="display: none">
                            <label for="kegiatan">Kegiatan</label>
                            <select class="form-select" id="kegiatan" name="kegiatan_{{$key}}" onchange="showSubKegiatan(this.value)">
                                <option value='null'>Pilih Kegiatan</option>
                                @foreach ($kegiatans as $keg)
                                <option value="{{$keg}}">{{$keg}}</option>
                                @endforeach
                            </select>
                         </div>
                    @endforeach

                    <div class="form-group sub_kegiatan" id="sub_kegiatan" style="display: none">
                        <label for="sub_kegiatan">Sub Kegiatan</label>
                        <input type="text" name="sub_kegiatan" id="sub_kegiatan" class="form-control" placeholder="Masukkan Sub Kegiatan">
                    </div>
                    
                    @foreach ($temp_kedudukan as $key => $kedudukans)
                        <div class="form-group kelas_kegiatan" id="kedudukan_div_{{$key}}" style="display: none">
                            <label for="kedudukan">Kedudukan</label>
                            <select class="form-select" id="kedudukan" name="kedudukan_{{$key}}">
                                <option value='null'>Pilih Kedudukan</option>
                                @foreach ($kedudukans as $ked)
                                <option value="{{$ked}}">{{$ked}}</option>
                                @endforeach
                            </select>
                         </div>
                    @endforeach
                    
                    @foreach ($temp_tingkatan as $key => $tingkatans)
                        <div class="form-group kelas_kegiatan" id="tingkatan_div_{{$key}}" style="display: none">
                            <label for="tingkatan">Tingkatan</label>
                            <select class="form-select" id="tingkatan" name="tingkatan_{{$key}}">
                                <option >Pilih Tingkatan</option>
                                @foreach ($tingkatans as $ting)
                                <option value="{{$ting}}">{{$ting}}</option>
                                @endforeach
                            </select>
                         </div>
                    @endforeach

                    {{-- Submit --}}
                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>                
            </div>
        </div>

    </section>
</div>
@endsection
<script>
    function updateKegiatanDiv(selectedValue) {
        // Sembunyikan semua div kegiatan, kedudukan, dan tingkatan
        document.querySelectorAll('.kelas_kegiatan').forEach(function(div) {
            div.style.display = 'none';
        });
        // Tampilkan div yang sesuai dengan nilai sub_kategori yang dipilih
        var kegiatanDivId = 'kegiatan_div_' + selectedValue;
        var kedudukanDivId = 'kedudukan_div_' + selectedValue;
        var tingkatanDivId = 'tingkatan_div_' + selectedValue;
    
        var kegiatanDiv = document.getElementById(kegiatanDivId);
        var kedudukanDiv = document.getElementById(kedudukanDivId);
        var tingkatanDiv = document.getElementById(tingkatanDivId);
    
        if (kegiatanDiv) {
            kegiatanDiv.style.display = 'block';
            // get the value of the selected option 
            var kegiatanValue = kegiatanDiv.querySelector('select').value;
            // update the sub_kegiatan div with the selected value
            if(kegiatanValue != 'null'){
                kegiatanDiv.querySelector('select').value = 'null';
            }
        }
        if (kedudukanDiv) {
            kedudukanDiv.style.display = 'block';
        }
        if (tingkatanDiv) {
            tingkatanDiv.style.display = 'block';
        }        
    }

    function showSubKegiatan(selectedValue) {
        var subKegiatanDiv = document.getElementById('sub_kegiatan');
        if (selectedValue.toLocaleLowerCase().includes('lainnya')) {
            subKegiatanDiv.style.display = 'block';
        }else{
            subKegiatanDiv.style.display = 'none';
        }
    }
    </script>