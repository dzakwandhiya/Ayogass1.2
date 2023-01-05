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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- CSS -->
    <link rel="stylesheet" href="crud-css/style.css">
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{--  --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Data Supplier</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="/dist/output.css" rel="stylesheet">
    <style>
        table.dataTable td {
            font-size: 13px;
            /* font-weight: bold; */
        }

        table.dataTable th {
            font-size: 14px;
            color: aliceblue;
            background-color: seagreen;
            font-weight: 800;
        }
    </style>
</head>

<body>

    <div class="navb">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <img src="../asset-img/logo-4.png" class="logo">
        <ul>

            <li><a href="{{ route('supplier')}}">Produk</a></li>
                <li><a href="{{ route('test')}}">Pemesanan</a></li>
                <li><a href="{{ route('akunSupplier') }}"><i class="fa fa-fw fa-user"></i>
                        {{ strtok(strtoupper($user->fullname), ' ') }}</a></li>
        </ul>
    </div>

    <div class="mx-auto">
        @include('sweetalert::alert')
        <div class="card shadow-lg p-3 mb-5 w-100  bg-white rounded">


            {{-- Modal Untuk Tambah Data --}}
            <div class="modal fade" id="quoteForm" tabindex="-1" role="dialog" aria-labelledby="quoteForm"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content p-lg-3">
                        <div class="modal-header">
                            <h3 class="modal-title font-weight-bold">TAMBAH <span class="text-success">PRODUCT</span>
                            </h3>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <form action={{ route('create') }} method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;"
                                            for="namaProduk">Nama Produk<span class="text-danger ml-1">*</span></label>
                                        <input class="form-control" id="namaProduk" name="namaProduk" type="text"
                                            style="font-size: 13px;" placeholder="Masukkan Nama Produk" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;"
                                            for="hargaProduk">Harga Produk<span
                                                class="text-danger ml-1">*</span></label>
                                        <input class="form-control" style="font-size: 13px;"id="hargaProduk"
                                            name="hargaProduk" type="number" placeholder="Masukkan Jenis Produk" />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;"
                                            for="stokProduk">Stok Produk<span class="text-danger ml-1">*</span></label>
                                        <input class="form-control" style="font-size: 13px;" id="stokProduk"
                                            name="stokProduk" type="number" placeholder="Masukkan Stok Produk Minimal 50 Unit" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="font-weight-bold text-small" style="font-size: 13px;"
                                            for="jenisProduk">Jenis Produk<span
                                                class="text-danger ml-1">*</span></label>
                                        <select class="form-control" name="jenisProduk" id="jenisProduk"
                                            style="font-size: 13px;">
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
                                    <button type="submit" class="btn btn-success w-25 p-3 "data-target="#quoteForm"
                                        data-toggle="modal"
                                        style=" font-size: 13px; font-weight:bold">Tambahkan</button>
                                    <button type="reset" class="btn btn-danger w-25 p-3 "
                                        style=" font-size: 13px; font-weight:bold">Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--  --}}
            {{-- Modal Untuk Edit --}}

            {{--  --}}
            {{-- <h1 class="card-header text-white bg-success" style="margin-bottom: 5px"><b>DAFTAR PRODUK

                </b>

            </h1> --}}
            {{-- <div class="container mt-10"> --}}
            <h1 class="card-header text-white bg-success" style="margin-bottom: 5px"><b>DAFTAR PRODUK

                </b>

            </h1>
            <div class="w-25 p-3">
                <button type="button" class="btn btn-success w-75 p-3  rounded-rounded"data-target="#quoteForm"
                    data-toggle="modal" style="margin-left:-10px;font-size: 15px; font-weight:bold"><i
                        class='fas fa-plus'></i>
                    Tambah
                    Product</button>
            </div>

            {{-- <div class="w-25 p-3">
                <button type="button" class="btn btn-success w-75 p-3  rounded-rounded" data-target="#updateForm"
                    data-toggle="modal" style="margin-left:-10px;font-size: 15px; font-weight:bold"><i
                        class='fas fa-plus'></i>
                    Update</button>
            </div> --}}
            {{-- <h2 class="mb-4">Laravel 7|8 Yajra Datatables Example</h2> --}}
            <table class="table-bordered yajra-datatable">

                <thead>
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
                <tbody>
                </tbody>
            </table>
            {{-- </div> --}}
            {{-- <div class="">

                <div class="">

                    <div class="table-responsive rounded">
                        <table class="table">
                            <thead>
                                <tr class="tr-judul bg-success">
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jenis Produk</th>
                                    <th scope="col">Stok Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Produk terjual</th>
                                    <th scope="col">Action</th>
                                <tr>
                            <tbody>
                                <?php $nomor = 0;
                                $color = '';
                                function rupiah($angka)
                                {
                                    $hasil = 'Rp ' . number_format($angka, 2, ',', '.');
                                    return $hasil;
                                }
                                ?>

                                @foreach ($test as $getProduct)
                                    <?php $nomor++;
                                    if ($nomor % 2 == 0) {
                                        $color = 'background-color: rgb(226, 255, 239)';
                                    } else {
                                        $color = '';
                                    }
                                    ?>
                                    <tr style="{{ $color }}">
                                        <th scope='row'class='align-middle'>{{ $nomor }}</th>
                                        <th scope='row'class='align-middle'>{{ $getProduct->namaProduk }}</th>
                                        <th scope='row'class='align-middle'>
                                            @if ($getProduct->jenisProduk == 1)
                                                GAS 3KG
                                            @elseif ($getProduct->jenisProduk == 2)
                                                GAS 12KG
                                            @endif
                                            {{ $getProduct->jenisProduk }}
                                        </th>
                                        <th scope='row'class='align-middle'>{{ $getProduct->stokProduk }}</th>
                                        <th scope='row'class='align-middle'>{{ rupiah($getProduct->hargaProduk) }}
                                        </th>
                                        <th scope='row'class='align-middle'>{{ $getProduct->produkTerjual }}</th>
                                        <th scope='row'class='align-middle'>
                                            <button type="button" class="btn btn-warning w-25"><i class='fas fa-edit' style="font-size: 15px"></i></button>
                                            <button type="button" class="btn btn-danger w-25"><i class="fa fa-trash-o" style="font-size: 15px"></i></button>


                                        </th>
                                    <tr>
                                @endforeach
                            </tbody>
                            <thead>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Keluar dari Website ?`,
                text: "Anda akan keluar dari website",
                icon: "warning",
                buttons: true,
                dangerMode: true,

            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
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

</html>
