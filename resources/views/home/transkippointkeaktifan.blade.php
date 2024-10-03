@extends('home/tamplate')
    
@section('content')
 

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Transkip Point Mahasiswa </h3>
                <p class="text-subtitle text-muted">atas nama {{session('user')['name']}}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transkip Point Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                {{-- jika mahasiswa null atau count == 0 maka disable downlod transkip point--}}
                {{-- dalam bentuk form --}}

                <form action="/downloadtranskippointkeaktifan" method="post">
                    @csrf
                    <input type="hidden" name="nim" value="{{$nim}}">
                    <button  onclick="return alert('Download Transkip Segera Di Lakukan, Harap Tunggu')" 
                    @if($mahasiswa == null || count($mahasiswa) == 0)
                        disabled
                    @endif
                    class="btn btn-primary" name="download" value="download" type="submit"><i class="bi bi-download" id="transkipbutton" ></i> Download Transkip Point</button>                     
                </form>          
            </div>
            
            <div class="card-body">
                @if($mahasiswa == null || count($mahasiswa) == 0)
                        {{-- jika data mahasiswa kosong --}}
                        <div class="alert alert-warning" role="alert">
                            Mahasiswa Belum Memiliki Record Keaktifan
                        </div>
                        {{-- else if --}}
                @else
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                               
                            <th>Kegiatan</th>
                            <th>Kedudukan</th>
                            <th>Tingkat Kegiatan</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Tanggal Kegiatan</th>                            
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>  
                        
                        @foreach ($mahasiswa as $mhs)   
                        <tr>
                            <td>{{$mhs['nim']}}</td>
                            <td>{{$mhs['nama_mahasiswa']}}</td>
                             <td>{{$mhs['data_kegiatan']}}</td>                            
                             <td>{{$mhs['kedudukan_kegiatan']}}</td>
                             <td>{{$mhs['tingkat_kegiatan']}}</td>
                             <td>{{$mhs['kategori_kegiatan']}}</td>
                             <td>{{$mhs['subkategori_kegiatan']}}</td>       
                             <td>{{$mhs['tanggal_kegiatan']}}</td>                      
                             <td>{{$mhs['status']}}</td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
                @endif
            </div>        
        </div>
    </section>
</div>

<script>
    function loader(){
        
    }
</script>

@endsection
