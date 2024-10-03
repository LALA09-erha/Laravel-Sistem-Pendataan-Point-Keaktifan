<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/fontawesome/all.min.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('images.png')}}">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/">
                                <p style="font-size:70% ;"><strong><img src="{{asset('images.png')}}" alt=""> Sistem Pendataan Keaktifan Mahasiswa</strong></p>
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (\Session::has('message'))
                            <li class="sidebar-item">
                                <div class="alert alert-success alert-dismissible show fade">
                                    {!! \Session::get('message') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible show fade">
                                    {!! \Session::get('error') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </li>
                            @endif

                        <li class="sidebar-title">Menu</li>

                        @if( "level")
                        <li class="sidebar-item {{
                            Request::is('/') ? 'active' : ''
                        }} ">
                            <a href="/" class='sidebar-link '>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @endif

                        @if(session('user')['role'] == 'Admin' || session('user')['role'] == 'Dosen')
                        <li class="sidebar-item {{
                            $title=='Data Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/keaktifanmahasiswa" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Data Keaktifan Mahasiswa</span>
                            </a>
                        </li>
                       
                        <li class="sidebar-item {{$title =='Validasi Keaktifan Mahasiswa | Sistem Pendataan Keaktifan Mahasiswa' ? 'active':''}}">
                            <a href="/validasidatakeaktifan" class='sidebar-link'>
                                <i class="bi bi-file-check-fill"></i>
                                <span>Validasi Data Keaktifan</span>
                            </a>
                        </li>
                        @endif

                        {{-- HALAMAN UNTUK ADMIN --}}
                        
                        @if(session('user')['role'] == 'Admin')
                        <li class="sidebar-title">Management Data</li>

                        <li class="sidebar-item {{
                            $title=='Daftar Kegiatan | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/kegiatan" class='sidebar-link'>
                                <i class="bi bi-calendar2-minus"></i>
                                <span>Daftar Kegiatan</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item {{
                            $title=='Jenis Kedudukan | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/kedudukan" class='sidebar-link'>
                                <i class="bi bi-journal-bookmark-fill"></i>
                                <span>Jenis kedudukan Kegiatan</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{
                            $title=='Sub Kategori | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/kategori" class='sidebar-link'>
                                <i class="bi bi-journal-text"></i>
                                <span>Sub Kategori</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item {{
                            $title=='Data Dosen | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/data-dosen" class='sidebar-link'>
                                <i class="bi bi-funnel"></i>
                                <span>Data Dosen</span>
                            </a>
                        </li>


                        @endif
                        {{-- END HALAMAN ADMIN --}}

                        @if(session('user')['role'] == 'Mahasiswa')

                        {{-- Letter Archives --}}
                        <li class="sidebar-title">Menu Akademik</li>

                        <li class="sidebar-item {{
                            $title=='Upload Data Keaktifan  | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/uploaddatakeaktifan" class='sidebar-link'>
                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                <span>Upload Data Keaktifan</span>
                            </a>
                        </li>
                       


                        <li class="sidebar-item  {{
                            $title=='Transkip Point Keaktifan  | Sistem Pendataan Keaktifan Mahasiswa' ? 'active' : ''
                        }}">
                            <a href="/transkippointkeaktifan" class='sidebar-link'>
                                <i class="bi bi-card-checklist"></i>
                                <span>Transkip Point Keaktifan </span>
                            </a>
                        </li>
                        @endif

                        {{-- END HALAMAN MAHASISWA --}}
                       


                        <li class="sidebar-title">Action</li>                
                        <li class="sidebar-item  ">
                            <button type="button" class="btn btn-lg btn-block sidebar-link"data-bs-toggle="modal" data-bs-target="#info">
                                <i class="bi bi-box-arrow-left">
                                    </i><span>Log Out</span></button>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <!--info theme Modal -->
        <div class="modal fade text-left" id="info" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel130"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title white" id="myModalLabel130">
                            Logout
                        </h5>
                        <button type="button" class="close"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                       Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <form action="/logout" method="post">
                            @csrf
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
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Universitas Trunojoyo Madura</p>
                    </div>
                    
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/extensions/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
</body>

</html>