<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}">
    @include('link')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="{{ asset('/icon/logo_ppm.jpeg') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PPM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item fixed-bottom">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </button>
                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 d-flex justify-content-center align-items-center">
                        <div class="col-sm-12 px-5">
                            <h1>Data Laporan Pengaduan</h1>
                        </div>
                        <div class="col-sm-12 px-5">
                            <label for="kategoriFilter">Filter by Category:</label>
                            <select id="kategoriFilter">
                                <option value="all">All Categories</option>
                                @foreach ($laporan as $data)
                                    <option value="{{ $data->kategori }}">{{ $data->kategori }}</option>
                                @endforeach
                                <!-- Tambahkan opsi kategori sesuai kebutuhan -->
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content px-5">
                <!-- Default box -->
                <div class="table-responsive">
                    <table class="table" id="laporanTable">
                        <thead>
                            <tr>

                                <th>NO</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Nama Pelapor</th>
                                <th>Alamat</th>
                                <th>Aspirasi</th>
                                <th>Keterangan</th>
                                <th>Gambar</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>

                        <tbody id="laporanTableBody">
                            @forelse ($laporan as $key => $data)
                                <tr data-category="{{ $data->kategori }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <b>
                                            <span
                                                class="badge rounded-pill
                                                @if ($data->status == 'pending') bg-danger
                                                @elseif($data->status == 'progress') bg-warning
                                                @elseif($data->status == 'done') bg-success @endif">
                                                {{ $data->status }}
                                            </span>
                                        </b>
                                    </td>
                                    <td>{{ $data->kategori }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->aspirasi }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td>
                                        <img src="{{ asset($data->gambar_kejadian) }}" alt="" width="50">
                                    </td>
                                    <td><a href="{{ route('laporan.show', ['id' => $data->id]) }}">View</a></td>
                                    <td>
                                        <form action="{{ route('laporan.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr id="table-none">
                                    <td colspan="10">
                                        <div class="container">
                                            <div class="row d-flex justify-content-center align-items-center text-align-center"
                                                style="height: 55vh;">
                                                <h3 class="text-secondary">Data Kosong !</h3>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2024. </strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
{{-- ------------------------------------------------------------------------------------- --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@include('script')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById("kategoriFilter");

        selectElement.addEventListener("change", function() {
            var selectedCategory = selectElement.value;
            var tableRows = document.querySelectorAll("#laporanTableBody tr");

            tableRows.forEach(function(row) {
                var rowCategory = row.getAttribute("data-category");

                // Check if the selected category is "all" or matches the row's data-category attribute
                if (selectedCategory === "all" || selectedCategory === rowCategory) {
                    row.style.display = ""; // Display the row
                } else {
                    row.style.display = "none"; // Hide the row
                }
            });
        });
    });
</script>


</html>


{{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </div> --}}
