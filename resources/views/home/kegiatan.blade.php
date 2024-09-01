@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kegiatan Mahasiswa</h3>
                <p class="text-subtitle text-muted">Page ini berisikan tentang Daftar Kegiatan Mahasiswa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kegiatan Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    Tambah Daftar Kegiatan Mahasiswa
                </button>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Tambah Kegiatan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/tambahkegiatan" method="post" style="width:100%">
                                    @csrf
                                    <div class="form-group has-icon-left" style="width: 100%">
                                        <label for="password-id-icon">Kegiatan Mahasiswa</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="nama_kegiatan"
                                                placeholder="Kegiatan Mahasiswa" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                           
                                        </div>
                                        <label for="test-id-icon">Kategori Kegiatan</label>
                                        <div class="position-relative">
                                            {{-- dropdown kategori wajib dan pilihan --}}
                                            <select class="form-select" name="kategori_kegiatan" id="test-id-icon" required>
                                                <option value="Wajib">Wajib</option>
                                                <option value="Pilihan">Pilihan</option>
                                            </select>
                                        </div>
                                        <label for="kdudukan-id-icon">Kedudukan Kegiatan</label>
                                        <div class="position-relative">
                                            {{-- dropdown kedudukan ambil dari $kedudukan --}}
                                            <select class="form-select" name="kedudukan_kegiatan" id="kdudukan-id-icon" required>
                                                @foreach ($kedudukans as $kedudukan)
                                                    <option value="{{$kedudukan['nama_kedudukan']}}">{{$kedudukan['nama_kedudukan']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="kdudukan-id-icon">Sub Kategori Kegiatan</label>
                                        <div class="position-relative">
                                            {{-- dropdown kedudukan ambil dari $kedudukan --}}
                                            <select class="form-select" name="subkategori_kegiatan" id="kdudukan-id-icon" required>
                                                @foreach ($subkategoris as $subkategori)
                                                    <option value="{{$subkategori['nama_subkategori']}}">{{$subkategori['nama_subkategori']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- dropdown tingkat kegiatan  prodi,fakultas,univ/kab/kota, prov/regional, nasional, internasional--}}
                                        <label for="kdudukan-id-icon">Tingkat Kegiatan</label>
                                        <div class="position-relative">
                                            <select class="form-select" name="tingkat_kegiatan" id="kdudukan-id-icon" required>
                                                <option value="Prodi">Prodi</option>
                                                <option value="Fakultas">Fakultas</option>
                                                <option value="Universitas/Kab/Kota">Universitas/Kab/Kota</option>
                                                <option value="Prov/Regional">Prov/Regional</option>
                                                <option value="Nasional">Nasional</option>
                                                <option value="Internasional">Internasional</option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                        <label for="point-id-icon">Point Kegiatan</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="point_kegiatan"
                                                placeholder="Point Kegiatan" id="point-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-pencil"></i>        
                                            </div>                                     
                                        </div>
                                        {{-- <label for="point-id-icon">Tahun Kegiatan</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="tahun_kegiatan"
                                                placeholder="Tahun Kegiatan" id="point-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-clock"></i>        
                                            </div>                                     
                                        </div> --}}
                                    </div>                                                                                            
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kegiatan Mahasiswa</th> 
                            <th>Kategori Kegiatan</th>    
                            <th>Sub Kategori Kegiatan</th>
                            <th>Kedudukan Kegiatan</th>
                            <th>Tingkat Kegiatan</th>
                            <th>Point Kegiatan</th>
                            {{-- <th>Tahun Kegiatan</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @php
                        $index = 1;
                        @endphp
                        
                        @foreach ($kegiatans as $kegiatan)                      
                        <tr>
                            <td>{{$index++}}</td>
                            <td>{{$kegiatan['nama_kegiatan']}}</td>
                            <td>{{$kegiatan['kategori_kegiatan']}}</td>
                            <td>{{$kegiatan['subkategori_kegiatan']}}</td>
                            <td>{{$kegiatan['kedudukan_kegiatan']}}</td>
                            <td>{{$kegiatan['tingkat_kegiatan']}}</td>
                            <td>{{$kegiatan['point_kegiatan']}}</td>
                            {{-- <td>{{$kegiatan['tahun_kegiatan']}}</td> --}}
                            <td>
                                <button data-bs-target="#kegiatanedit{{$kegiatan['id']}}" data-bs-toggle="modal" class="btn btn-primary">Edit</button>
                                <button data-bs-target="#delete{{$kegiatan['id']}}" data-bs-toggle="modal" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <div class="modal fade text-left" id="delete{{$kegiatan['id']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel130"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title white" id="myModalLabel130">
                                            Delete kegiatan
                                        </h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete kegiatan?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/deletekegiatan" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$kegiatan['id']}}">
                                            <button type="button"
                                                class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" name="logout" class="btn btn-danger ml-1">
                                                Accept
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade text-left" id="kegiatanedit{{$kegiatan['id']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            Edit kegiatan</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/editkegiatan" method="post" style="width:100%">
                                            @csrf
                                            <div class="form-group has-icon-left" style="width: 100%">
                                                <label for="password-id-icon">Daftar Kegiatan Mahasiswa</label>
                                                <div class="position-relative">
                                                    <input type="hidden" name="id" value="{{$kegiatan['id']}}">
                                                    <input type="text" class="form-control" name="nama_kegiatan"
                                                        placeholder="Daftar Kegiatan Mahasiswa" id="password-id-icon" value="{{$kegiatan['nama_kegiatan']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-book"></i>
                                                    </div>
                                                </div>

                                                <div class="position-relative">
                                                    {{-- dropdown kategori kegiatan --}}
                                                    <label for="test-id-icon">Kategori Kegiatan</label>
                                                    <select class="form-select" name="kategori_kegiatan" id="test-id-icon" required>
                                                        <option value="Wajib" {{$kegiatan['kategori_kegiatan']=='Wajib'?'selected':''}}>Wajib</option>
                                                        <option value="Pilihan" {{$kegiatan['kategori_kegiatan']=='Pilihan'?'selected':''}}>Pilihan</option>
                                                    </select>
                                                </div>
                                                {{-- kedudukan kegiatan --}}
                                                <div class="position-relative">
                                                    <label for="kdudukan-id-icon">Kedudukan Kegiatan</label>
                                                    <select class="form-select" name="kedudukan_kegiatan" id="kdudukan-id-icon" required>
                                                        @foreach ($kedudukans as $kedudukan)
                                                            <option value="{{$kedudukan['nama_kedudukan']}}" {{$kegiatan['kedudukan_kegiatan']==$kedudukan['nama_kedudukan']?'selected':''}}>{{$kedudukan['nama_kedudukan']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>  
                                                {{-- sub kategori kegiatan --}}
                                                <div class="position-relative">
                                                    <label for="kdudukan-id-icon">Sub Kategori Kegiatan</label>
                                                    <select class="form-select" name="subkategori_kegiatan" id="kdudukan-id-icon" required>
                                                        @foreach ($subkategoris as $subktgr)
                                                            <option value="{{$subktgr['nama_subkategori']}}" {{$kegiatan['subkategori_kegiatan']==$subktgr['nama_subkategori']?'selected':''}}>{{$subktgr['nama_subkategori']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>  
                                                {{-- tingkat kegiatan --}}
                                                <div class="position-relative">
                                                    <label for="kdudukan-id-icon">Tingkat Kegiatan</label>
                                                    <select class="form-select" name="tingkat_kegiatan" id="kdudukan-id-icon" required>
                                                        <option value="Prodi" {{$kegiatan['tingkat_kegiatan']=='Prodi'?'selected':''}}>Prodi</option>
                                                        <option value="Fakultas" {{$kegiatan['tingkat_kegiatan']=='Fakultas'?'selected':''}}>Fakultas</option>
                                                        <option value="Universitas/Kab/Kota" {{$kegiatan['tingkat_kegiatan']=='Universitas/Kab/Kota'?'selected':''}}>Universitas/Kab/Kota</option>
                                                        <option value="Prov/Regional" {{$kegiatan['tingkat_kegiatan']=='Prov/Regional'?'selected':''}}>Prov/Regional</option>
                                                        <option value="Nasional" {{$kegiatan['tingkat_kegiatan']=='Nasional'?'selected':''}}>Nasional</option>
                                                        <option value="Internasional" {{$kegiatan['tingkat_kegiatan']=='Internasional'?'selected':''}}>Internasional</option>
                                                        <option value="-" {{$kegiatan['tingkat_kegiatan']=='-'?'selected':''}}>-</option>
                                                    </select>
                                                </div>

                                                {{-- point kegiatan --}}
                                                <div class="position-relative">
                                                    <label for="point-id-icon">Point Kegiatan</label>
                                                    <input type="number" class="form-control" name="point_kegiatan"
                                                        placeholder="Point Kegiatan" id="point-id-icon" value="{{$kegiatan['point_kegiatan']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-pencil"></i>
                                                    </div>
                                                </div>
                                                {{-- <div class="position-relative">
                                                    <label for="point-id-icon">Tahun Kegiatan</label>
                                                    <input type="number" class="form-control" name="tahun_kegiatan"
                                                        placeholder="Tahun Kegiatan" id="point-id-icon" value="{{$kegiatan['tahun_kegiatan']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-pencil"></i>
                                                    </div>
                                                </div> --}}
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
            </div>
        </div>

    </section>
</div>
@endsection