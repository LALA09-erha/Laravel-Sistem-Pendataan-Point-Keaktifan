@extends('home/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Jenis Kedudukan</h3>
                <p class="text-subtitle text-muted">Page ini berisikan tentang jenis kedudukan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jenis Kedudukan</li>
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
                    Tambah Jenis Kedudukan
                </button>
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Tambah Kedudukan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/tambahkedudukan" method="post" style="width:100%">
                                    @csrf
                                    <div class="form-group has-icon-left" style="width: 100%">
                                        <label for="password-id-icon">Jenis Kedudukan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="nama_kedudukan"
                                                placeholder="Jenis kedudukan" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
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
                            <th>ID</th>
                            <th>Jenis Kedudukan</th>     
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @php
                        
                        $index = 1;
                        @endphp
                        
                        @foreach ($kedudukans as $kedudukan)   
                        <tr>
                            <td>{{$index++}}</td>
                            <td>{{$kedudukan['nama_kedudukan']}}</td>
                            <td>
                                <button data-bs-target="#inlineForm{{$kedudukan['id']}}" data-bs-toggle="modal" class="btn btn-primary">Edit</button>
                                <button data-bs-target="#delete{{$kedudukan['id']}}" data-bs-toggle="modal" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <div class="modal fade text-left" id="delete{{$kedudukan['id']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel130"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title white" id="myModalLabel130">
                                            Delete Kedudukan
                                        </h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    Are you sure you want to delete Kedudukan?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/deletekedudukan" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$kedudukan['id']}}">
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

                        <div class="modal fade text-left" id="inlineForm{{$kedudukan['id']}}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            Edit Kedudukan</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/editkedudukan" method="post" style="width:100%">
                                            @csrf
                                            <div class="form-group has-icon-left" style="width: 100%">
                                                <label for="password-id-icon">Jenis Kedudukan</label>
                                                <div class="position-relative">
                                                    <input type="hidden" name="id" value="{{$kedudukan['id']}}">
                                                    <input type="text" class="form-control" name="nama_kedudukan"
                                                        placeholder="Jenis kedudukan" id="password-id-icon" value="{{$kedudukan['nama_kedudukan']}}" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-book"></i>
                                                    </div>
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