@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Keaktifan Mahasiswa</h3>
                <p class="text-subtitle text-muted">Page ini berisikan tentang Data Keaktifan Mahasiswa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Keaktifan Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            
            <div class="card-body">
                
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            {{-- <th>Tahun Ajaran</th>   --}}
                            <th>Program Prodi</th>
                            <th>Total Point</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                         
                        @foreach ($mahasiswas as $mahasiswa)   
                        <tr>
                            <td>{{$mahasiswa['nim']}}</td>
                            <td>{{$mahasiswa['name']}}</td>
                            {{-- <td>{{$mahasiswa['tahun_ajaran']}}</td> --}}
                            <td>{{$mahasiswa['prodi']}}</td>                            
                             <td>{{$mahasiswa['total_point']}}</td>
                            <td>
                                {{-- detail by nim --}}
                                <a href="/keaktifanmahasiswa/detail/{{$mahasiswa['nim']}}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection