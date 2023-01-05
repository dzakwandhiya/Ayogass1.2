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
    <style>
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .popup {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: auto;
            max-width: 90%;
            max-height: 400px;
        }

        /* Modal Content */
        .modal-content {
            text-align: center;
            background-color: rgb(146, 224, 180);
            margin: auto;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 20px;
            border-radius: 10px;
            border: 5px solid rgb(26, 59, 40);
            width: 50%;
        }

        .modal-content h1 {
            margin-top: 10px;
            margin-bottom: 10px;
            color: white;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>


</head>

<body>

    @include('sweetalert::alert')
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-success" id="sidebar-wrapper">
            <div class="sidebar-heading py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><img
                    src="../asset-img/logo-4.png" class="float-left" style="max-width:180px"></div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('test3') }}" class="list-group-item list-group-item-action bg-white active"><i
                        class="fas fa-shopping-cart me-2"></i>PEMESANAN</a>
                <a href="{{ route('test4') }}"
                    class="list-group-item list-group-item-action text-white econd-text fw-bold hovr"><i
                        class="fas fa-gift me-2"></i>PRODUK</a>
                <a href="{{ route('akunSupplier') }}"
                    class="list-group-item list-group-item-action text-white fw-bold hovr">
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
                                <li><a class="dropdown-item" href="{{ route('akunSupplier') }}">Pengaturan</a></li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid px-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded w-75  mx-auto">
                    <h1 class="card-header text-white bg-success text-center"><b>PESANAN
                            {{ strtoupper("$product->namaProduk") }}</b>
                    </h1>
                    <div class="card-body">
                        <div class="">
                            <form action="{{ route('updateBySupplier', $transaction->id) }}" method="POST"
                                style="padding-top:20px" id="productUpdate">
                                @csrf
                                <div class="col-lg-12" style="margin-bottom: 10px">
                                    <div class="form-group">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="w-25" style="font-weight:bold">Nama Produk</td>
                                                <td>: {{ $product->namaProduk }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight:bold">Nama Pembeli</td>
                                                <td>: {{ $agen->fullname }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight:bold">Total Pembayaran</td>
                                                <td>: {{ rupiah($transaction->totalPembayaran) }} | @if ($transaction->metodePembayaran == 1)
                                                        Via BRI - 1111321456
                                                    @elseif ($transaction->metodePembayaran == 2)
                                                        Via DANA - 2222123654
                                                    @elseif ($transaction->metodePembayaran == 3)
                                                        Via MANDIRI - 3333456321
                                                    @elseif ($transaction->metodePembayaran == 4)
                                                        Via BCA - 4444765123
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight:bold">Bukti Pembayaran</td>
                                                <td>
                                                    @if ($transaction->statusPemesanan == 1)
                                                        Agen belum mengupload bukti pembayaran
                                                    @elseif ($transaction->statusPemesanan == 0)
                                                        Menunggu Agen mengupload ulang bukti pembayaran
                                                    @else
                                                        <button type="button" id="myBtn" class="btn btn-success">
                                                            <i class='fas fa-file-alt'></i>
                                                            LIHAT STRUK</button></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight:bold">Status</td>
                                                <td>
                                                    <div class="col-lg-12" style="margin-bottom: 10px">
                                                        <div class="form-group">

                                                            <select name="statusPemesanan" id="statusPemesanan"
                                                                class="form-select" aria-label="Default select example"
                                                                @if ($transaction->statusPemesanan == 1) disabled
                                                                @elseif($transaction->statusPemesanan == 2)
                                                                disabled
                                                                @elseif($transaction->statusPemesanan == 5)
                                                                disabled
                                                                @elseif($transaction->statusPemesanan == 6)
                                                                disabled
                                                                @elseif($transaction->statusPemesanan == 0)
                                                                disabled @endif>
                                                                <option value="">
                                                                    @if ($transaction->statusPemesanan == 1)
                                                                        Menunggu Upload Pembayaran &#128308;
                                                                    @elseif ($transaction->statusPemesanan == 2)
                                                                        Menunggu validasi bukti pembayaran &#128195;
                                                                    @elseif ($transaction->statusPemesanan == 3)
                                                                        Mempersiapkan pengiriman gas &#128230;
                                                                    @elseif ($transaction->statusPemesanan == 4)
                                                                        Produk dalam proses pengiriman &#128667;
                                                                    @elseif ($transaction->statusPemesanan == 5)
                                                                        Produk telah diterima &#129309;
                                                                    @elseif ($transaction->statusPemesanan == 6)
                                                                        Pesanan ini telah selesai &#9989;
                                                                    @elseif ($transaction->statusPemesanan == 0)
                                                                        Bukti pembayaran tidak valid &#128308;
                                                                    @endif
                                                                </option>
                                                                @if ($transaction->statusPemesanan == 2)
                                                                    <option value="3">Mempersiapkan pengiriman gas
                                                                    </option>
                                                                    <option value="4">Produk dalam proses
                                                                        pengiriman
                                                                    </option>
                                                                    <option value="5">Produk telah diterima
                                                                    </option>
                                                                @elseif ($transaction->statusPemesanan == 3)
                                                                    <option value="4">Produk dalam proses
                                                                        pengiriman
                                                                    </option>
                                                                    <option value="5">Produk telah diterima
                                                                    </option>
                                                                @elseif ($transaction->statusPemesanan == 4)
                                                                    <option value="5">Produk telah diterima
                                                                    </option>
                                                                @elseif ($transaction->statusPemesanan == 5)
                                                                    <option value="5" disabled>Produk telah
                                                                        diterima
                                                                    </option>
                                                                @endif

                                                            </select>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div id="myModal" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h1
                                            style="
                                        text-shadow: 1px 1px 3px #000000;
                                        font-weight:bold">
                                            BUKTI PEMBAYARAN</h1>
                                        <img class="popup"
                                            src="/bukti_pembayaran/{{ $transaction->buktiPembayaran }}">
                                        <div style="max-width: 100%; margin-top: 20px">
                                            @if ($transaction->statusPemesanan == 2)
                                                <a href="/pembayaranTidakValid/{{ $transaction->id }}"><button
                                                        onclick="return confirm('Apakah bukti pembayaran tidak valid?')"
                                                        class="btn btn-danger w-25" type="submit"
                                                        form="tidakValid">TIDAK VALID</button></a>
                                                <a href="/pembayaranValid/{{ $transaction->id }}"><button
                                                        onclick="return confirm('Apakah bukti pembayaran sudah valid?')"
                                                        class="btn btn-success w-25" type="submit"
                                                        form="valid">SUDAH
                                                        VALID</button></a>
                                            @endif

                                        </div>


                                    </div>

                                </div>
                        </div>
                    </div>
                    </form>
                    <form action="{{ route('test3') }}" method="GET" id="back"></form>
                    <div class=" text-center" style="padding-bottom:15px">
                        @if ($transaction->statusPemesanan < 5)
                            <button type='submit' class='btn btn-success' form="productUpdate">Update</button>
                            <button type='reset' class='btn btn-secondary' form="productUpdate">Reset</button><br>
                        @else
                            <button type='submit' class='btn btn-success' form="back">KEMBALI</button><br>
                        @endif
                    </div>
                </div>

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
    <?php
    function rupiah($angka)
    {
        $hasil = 'Rp ' . number_format($angka, 2, ',', '.');
        return $hasil;
    }
    ?>

</body>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>
