<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="beta-css/styles.css" />
    <title>produk</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-success" id="sidebar-wrapper">
            <div class="sidebar-heading py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><img
                    src="../asset-img/logo-4.png" class="float-left" style="max-width:180px"></div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('test3') }}"
                    class="list-group-item list-group-item-action text-white econd-text fw-bold hovr"><i
                        class="fas fa-shopping-cart me-2"></i>PEMESANAN</a>
                <a href="{{route('test4')}}" class="list-group-item list-group-item-action bg-white active"><i
                        class="fas fa-gift me-2"></i>PRODUK</a>
                <a href="{{route('akunSupplier')}}" class="list-group-item list-group-item-action text-white fw-bold hovr">
                    <i class="fas fa-user me-2"></i></i>PROFIL</a>
                {{-- <a href="/logout" class="list-group-item text-white fw-bold hovr show_confirm"><i
                        class="fas fa-power-off me-2"></i>KELUAR</a> --}}
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 style="font-weight: bold">DAFTAR PRODUK</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>{{ strtok(strtoupper($user->fullname), ' ') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('akunSupplier')}}">Pengaturan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">

                <div class="w-25 p-3" style="margin-top:-20px">
                    <button type="button" class="btn btn-success rounded-rounded"data-target="#quoteForm"
                        data-toggle="modal" style="margin-left:-10px;font-size: 15px; font-weight:bold"><i
                            class='fas fa-plus'></i>
                        Tambah
                        Product</button>
                </div>
                {{-- Modal Untuk Tambah Data --}}
                <div class="modal fade" id="quoteForm" tabindex="-1" role="dialog" aria-labelledby="quoteForm"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content p-lg-3">
                            <div class="modal-header">
                                <h3 class="modal-title" style="font-weight: bold">TAMBAH <span
                                        class="text-success">PRODUCT</span>
                                </h3>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form action={{ route('create') }} method="post">
                                    @csrf
                                    <div class="row">
                                        <div style="margin-bottom: 10px" class="form-group col-lg-12">
                                            <label style="font-weight:600" class="font-weight-bold text-small" for="namaProduk">Nama
                                                Produk<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" id="namaProduk" name="namaProduk"
                                                type="text" placeholder="Masukkan Nama Produk" />
                                        </div>
                                        <div style="margin-bottom: 10px" class="form-group col-lg-12">
                                            <label style="font-weight:600" class="font-weight-bold text-small" for="hargaProduk">Harga
                                                Produk<span class="text-danger ml-1">*</span></label>
                                            <input class="form-control" id="hargaProduk" name="hargaProduk"
                                                type="number" placeholder="Masukkan Jenis Produk" />
                                        </div>

                                        <div style="margin-bottom: 10px" class="form-group col-lg-12">
                                            <label style="font-weight:600" class="font-weight-bold text-small" for="stokProduk">Stok
                                                Produk<span class="text-danger ml-1">*</span> minimal 50 Unit</label>
                                            <input class="form-control" id="stokProduk" name="stokProduk"
                                                type="number" placeholder="Masukkan Stok Produk" />
                                        </div>
                                        <div style="margin-bottom: 10px" class="form-group col-lg-12">
                                            <label style="font-weight:600" class="font-weight-bold text-small" for="jenisProduk">Jenis
                                                Produk<span class="text-danger ml-1">*</span></label>
                                            <select class="form-control" name="jenisProduk" id="jenisProduk">

                                                <option value="" class="text-secondary">-- Daftar sebagai --
                                                </option>
                                                <option class="opsi" value="1">Gas 3KG</option>
                                                <option class="opsi" value="2">Gas 12KG</option>
                                                <option class="opsi" value="3">Bright Gas 5,5KG</option>
                                                <option class="opsi" value="4">Bright Gas 12KG</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="w-100 p-3 text-center">
                                        <button type="submit" class="btn btn-success"data-target="#quoteForm"
                                            data-toggle="modal">Tambahkan</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">

                    <div class="col">
                        <table class="table table-bordered rounded shadow-sm  table-hover yajra-datatable">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Jenis Produk</th>
                                    <th>Stok Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Produk Terjual</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- /#page-content-wrapper -->
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>

    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getProducts') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'namaProduk',
                        name: 'namaProduk'
                    },
                    {
                        data: 'jenisProduk',
                        name: 'jenisProduk'
                    },
                    {
                        data: 'stokProduk',
                        name: 'stokProduk'
                    },
                    {
                        data: 'hargaProduk',
                        name: 'hargaProduk'
                    },
                    {
                        data: 'produkTerjual',
                        name: 'produkTerjual'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>

</body>
<?php
function rupiah($angka)
{
    $hasil = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil;
} ?>

</html>
