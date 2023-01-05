<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="/beta-css/styles.css" />

    <title>produk</title>


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
                    <h2 style="font-weight: bold">INFORMASI PRODUK</h2>
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
                <div class="card shadow-lg p-3 mb-5 bg-white rounded w-75  mx-auto">
                    <h1 class="card-header text-white bg-success text-center"><b>{{ strtoupper($get->namaProduk) }}</b>
                    </h1>
                    <div class="card-body">
                        <div class="">
                            <form action="{{ route('updateProduct', $get->id) }}" method="post"
                                style="padding-top:20px" id="productUpdate">
                                @csrf
                                <div class="col-lg-12" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="font-weight: bold">Nama Produk</label>
                                        <input name="namaProduk" for="namaProduk" form="productUpdate" type="text"
                                            style="font-size:14px;"class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp"
                                            value="{{ old('namaProduk', $get->namaProduk) }}"
                                            placeholder="{{ $get->namaProduk }}">
                                    </div>
                                </div>

                                <div class="col-lg-12" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="font-weight: bold">Tambah Stok Produk | Stok terkini : {{$get->stokProduk}} unit</label>
                                        <input name="stokProduk" for="stokProduk" form="productUpdate"
                                            type="number" style="font-size:14px;"class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" {{-- value="{{ old('stokProduk', $get->stokProduk) }}" --}}
                                            placeholder="Tambah stok produk...">
                                    </div>
                                </div>
                                <div class="col-lg-12" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="font-weight: bold">Harga Produk</label>
                                        <input name="hargaProduk" for="hargaProduk" form="productUpdate"
                                            type="number" style="font-size:14px;"class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ old('hargaProduk', $get->hargaProduk) }}"
                                            placeholder="{{ $get->hargaProduk }}">
                                    </div>
                                </div>
                                <div class="col-lg-12" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <label class="font-weight-bold" style="font-weight: bold">Jenis Produk </label>


                                        <select name="jenisProduk" for="jenisProduk" form="productUpdate"
                                            style="
                                            font-size: 14px;
                                            padding-left:5px;
                                            padding-top:6px;
                                            padding-bottom:6px;"
                                            class='w-100' for="exampleFormControlSelect1" form="update"
                                            name="gender" id="gender">
                                            <option style="font-size: 14px;" class='form-control font-weight-bold'
                                                id="exampleFormControlSelect1" value="{{ $get->jenisProduk }}">
                                                @if ($get->jenisProduk == 1)
                                                    Gas 3Kg
                                                @elseif ($get->jenisProduk == 2)
                                                    Gas 12Kg
                                                @elseif ($get->jenisProduk == 3)
                                                    Bright Gas 5,5KG
                                                @elseif ($get->jenisProduk == 4)
                                                    Bright Gas 12KG
                                                @endif
                                            </option>
                                            <option class="opsi" value="1">Gas 3KG</option>
                                            <option class="opsi" value="2">Gas 12KG</option>
                                            <option class="opsi" value="3">Bright Gas 5,5KG</option>
                                            <option class="opsi" value="4">Bright Gas 12KG</option>
                                        </select>

                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                    <div class=" text-center" style="padding-bottom:15px">
                        <button type='submit' class='btn btn-success' form="productUpdate">Update</button>
                        <button type='reset' class='btn btn-secondary' form="productUpdate">Reset</button><br>
                    </div>
                </div>
                <!-- <div class="row my-5">

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
                </div> -->

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>


</body>

</html>
