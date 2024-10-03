@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Dosen</h3>
                <p class="text-subtitle text-muted">Page ini berisikan tentang Data Dosen</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Dosen</li>
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
                    Tambah Dosen
                </button>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Tambah Dosen</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/adddosen" method="post" style="width:100%">
                                    @csrf
                                    <div class="form-group has-icon-left" style="width: 100%">
                                        <label for="password-id-icon">NIP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="nip"
                                                placeholder="Masukkan NIP" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar2"></i>
                                            </div>
                                        </div>
                                        <label for="password-id-icon">Nama</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="nama"
                                                placeholder="Masukkan Nama" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                        <label for="password-id-icon">Role</label>
                                        <div class="position-relative">
                                            <select name="role" id="role" class="form-select">
                                                <option value="Dosen">Dosen</option>                                        
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
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
                            <th>NIP</th>     
                            <th>NAMA</th>     
                            <th>JABATAN</th>     
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                       
                        @foreach ($data as $dt)   
                        <tr>
                            <td>{{$dt['nip']}}</td>
                            <td>{{$dt['name']}}</td>
                            <td>{{$dt['role']}}</td>
                            <td>
                                <button data-bs-target="#inlineForm{{$dt['nip']}}" data-bs-toggle="modal" class="btn btn-primary">Edit</button>
                                <button data-bs-target="#delete{{$dt['nip']}}" data-bs-toggle="modal" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <div class="modal fade text-left" id="delete{{$dt['nip']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel130"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title white" id="myModalLabel130">
                                            Delete Dosen
                                        </h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete Dosen?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/deletedosen" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$dt['nip']}}">
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

                        <div class="modal fade text-left" id="inlineForm{{$dt['nip']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            Edit Dosen</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/editdosen" method="post" style="width:100%">
                                            @csrf
                                            <div class="form-group has-icon-left" style="width: 100%">
                                                <input type="hidden" name="id" value="{{$dt['nip']}}">
                                                <label for="password-id-icon">NIP</label>
                                                <div class="position-relative">
                                                    <input type="number" class="form-control" name="nip"
                                                        placeholder="NIP Dosen" id="password-id-icon" value="{{$dt['nip']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar2"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">Nama Dosen</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="nama"
                                                        placeholder="Nama Dosen" id="password-id-icon" value="{{$dt['name']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                                <label for="password-id-icon">Role</label>
                                                <div class="position-relative">
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="Dosen" <?php if($dt['role'] == 'Dosen'){echo "selected";}?>>Dosen</option>                                        
                                                        <option value="Admin" <?php if($dt['role'] == 'Admin'){echo "selected";}?>>Admin</option>
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
            </div>
        </div>

    </section>
</div>
@endsection