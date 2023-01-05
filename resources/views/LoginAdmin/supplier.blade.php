<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="admin-css/style.css">
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Data Supplier</title>
</head>

<body>

    <div class="navb">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="../asset-img/logo-4.png" class="logo">
        <ul>
            <li><a href="">Supplier</a></li>
            <li><a href="">Produk</a></li>
            <li><a href="">Pemesanan</a></li>

            <li><a href=""><i class="fa fa-fw fa-user"></i> Akun</a></li>

        </ul>
    </div>
    <div class="mx-auto">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="w-25 p-3">
                <button type="button" class="btn btn-success w-50 p-3 "data-target="#quoteForm" data-toggle="modal"
                    style=" font-size: 15px; font-weight:bold">Tambah Toko</button>
            </div>
            {{-- <h1 class="card-header text-white bg-success"><b>DAFTAR INFORMASI PRODUK</b></h1> --}}
            <div class="modal fade" id="quoteForm" tabindex="-1" role="dialog" aria-labelledby="quoteForm"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content p-lg-3">
                        <div class="modal-header">
                            <h3 class="modal-title font-weight-bold">TAMBAH <span class="text-success">SUPPLIER</span></h3>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="#">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;" for="firstname">Nama Toko<span
                                                class="text-danger ml-1">*</span></label>
                                        <input class="form-control" id="firstname" type="text"
                                        style="font-size: 13px;"
                                            placeholder="Masukkan Nama Toko" required="" />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;" for="firstname">Alamat Toko<span
                                                class="text-danger ml-1">*</span></label>
                                        <input class="form-control" style="font-size: 13px;" id="firstname" type="text"
                                            placeholder="Masukkan Alamat Toko" required="" />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;" for="phone">Nomor Telepon<span
                                            class="text-danger ml-1">*</span></label>
                                        <input class="form-control" id="phone" style="font-size: 13px;" type="tel"
                                            placeholder="Masukkan Nomor telepon" />
                                    </div>

                                    {{-- <div class="form-group col-lg-6">
                                        <button class="btn btn-primary" type="button">Submit your request</button>
                                    </div> --}}

                                </div>

                                <div class="w-100 p-3 text-center">
                                    <button type="button" class="btn btn-success w-25 p-3 "data-target="#quoteForm"
                                        data-toggle="modal" style=" font-size: 13px; font-weight:bold">Tambahkan</button>
                                    <button type="reset" class="btn btn-danger w-25 p-3 "
                                         style=" font-size: 13px; font-weight:bold">Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="tr-judul bg-success">
                                <th scope="col">No.</th>
                                <th scope="col">Nama Toko</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Status</th>
                            <tr>
                        <tbody>
                            <?php $nomor = 0; ?>
                            @foreach ($toko as $getToko)
                                <?php $nomor++; ?>
                                <tr>
                                    <th scope='row'class='align-middle'>{{ $nomor }}</th>
                                    <th scope='row'class='align-middle'>{{ $getToko->namaToko }}</th>
                                    <th scope='row'class='align-middle'>{{ $getToko->alamatToko }}</th>
                                    <th scope='row'class='align-middle'>{{ $getToko->nomorTelepon }}</th>
                                    <th scope='row'class='align-middle'>{{ $getToko->statusToko }}</th>
                                <tr>
                            @endforeach
                        </tbody>
                        <thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script></script>

</html>
