@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Keaktifan </h3>
                <p class="text-subtitle text-muted">atas nama {{$data['name']}}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/keaktifanmahasiswa">Keaktifan Mahasiswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Keaktifan Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="/keaktifanmahasiswa" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </div>
            <div class="card-body">
                @if($mahasiswa ==null)
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
                            <th>Semester</th>  
                            <th>Kegiatan | Kedudukan</th>
                            <th>Point Kegiatan</th>
                            <th>Bukti File Kegiatan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                        
                        @foreach ($mahasiswa as $mhs)   
                        <tr>
                            <td>{{$mhs['nim']}}</td>
                            <td>{{$mhs['nama_mahasiswa']}}</td>
                            <td>{{$mhs['semester']}}</td>
                            <td>{{$mhs['data_kegiatan']}}</td>                            
                             <td>{{$mhs['point_kegiatan']}}</td>
                             <td><a href="/filekegiatan/{{$mhs['file_kegiatan']}}" target="_blank">{{$mhs['file_kegiatan']}}</a></td>
                             <td>{{$mhs['status']}}</td>
                            <td>
                                {{-- detail by nim --}}
                                <button data-bs-target="#detailkeaktifan{{$mhs['id']}}" data-bs-toggle="modal" class="btn btn-primary">Edit</button>
                            </td>
                        </tr>
                        <div class="modal fade text-left" id="detailkeaktifan{{$mhs['id']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            Edit Detail Keaktifan Mahasiswa</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x">X</i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/editdetailkeaktifan" method="post" style="width:100%">
                                            @csrf
                                            <div class="form-group has-icon-left" style="width: 100%">
                                                <label for="password-id-icon">Nama Mahasiswa</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="nama_mahasiswa"
                                                        placeholder="Nama Mahasiswa" id="password-id-icon" value="{{$mhs['nama_mahasiswa']}}" required readonly>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">NIM</label>
                                                <div class="position-relative">
                                                    <input type="hidden" name="id" value="{{$mhs['id']}}">
                                                    <input type="hidden" name="point_kegiatan" value="{{$mhs['point_kegiatan']}}">
                                                    <input type="text" class="form-control" name="nim"
                                                    placeholder="NIM" id="password-id-icon" value="{{$mhs['nim']}}" required readonly>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-pen"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">Semester</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="semester"
                                                    placeholder="semester" id="password-id-icon" value="{{$mhs['semester']}}" required readonly>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-megaphone"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">Data Kegiatan</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="data_kegiatan"
                                                    placeholder="data_kegiatan" id="password-id-icon" value="{{$mhs['data_kegiatan']}}" required readonly>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-info"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">Status</label>
                                                <div class="position-relative">
                                                    {{-- dropdown status dengan pilihan Disetujui , Ditolak, Menunggu --}}
                                                    <select class="form-select" name="status" id="status" required>
                                                        {{-- jika data $mhs['status sama maka pilih'] --}}
                                                        <option value="Disetujui" {{$mhs['status'] == 'Disetujui' ? 'selected' : ''}}>Disetujui</option>
                                                        <option value="Ditolak" {{$mhs['status'] == 'Ditolak' ? 'selected' : ''}}>Ditolak</option>
                                                        <option value="Menunggu" {{$mhs['status'] == 'Menunggu' ? 'selected' : ''}}>Menunggu</option>
                                                    </select>
                                                </div>
                                                
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
                        @endforeach                    
                    </tbody>
                </table>
                @endif
            </div>
        </div>

    </section>
</div>
@endsection