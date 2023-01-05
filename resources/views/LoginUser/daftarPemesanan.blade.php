<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Produk</title>
    <link rel="stylesheet" href="/pesanan-css/style.css?v=<?php echo time(); ?>">
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

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
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
    <div class="banner">
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="../asset-img/logo-4.png" class="lg">
            <ul>
                <li><a href="{{ url('/home') }}"> Home </a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('product') }}">Produk</a></li>
                <li><a href="{{ url('/getAllTransaction') }}">Pesanan</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('akun') }}"><i class="fa fa-fw fa-user"></i>
                        {{ strtok(strtoupper($user->fullname), ' ') }}</a></li>
            </ul>
        </nav>
        <div class="content">
            <div class="orders">
                <h1>DAFTAR PESANAN</h1>
                <hr>
                <div class="scrol">
                    @foreach ($transactions as $transaction)
                        <?php
                        $ulasan = '';
                        $bukti_pembayaran = '';
                        if ($transaction->statusPemesanan != 5) {
                            $ulasan = 'display: none;';
                        } else {
                            $ulasan = '';
                        }

                        if ($transaction->statusPemesanan != 1) {
                            $bukti_pembayaran = 'display: none;';
                        } else {
                            $bukti_pembayaran = '';
                        }
                        ?>
                        <div class="order">
                            <div class="order-content">
                                <h1>{{ $transaction->namaProduk }}</h1>
                                <table>
                                    <tr>
                                        <td class="col1">Tagihan</td>
                                        <td>: {{ rupiah($transaction->totalPembayaran) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pembayaran</td>
                                        <td>:
                                            @if ($transaction->metodePembayaran == 1)
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
                                        <td>Status</td>
                                        <td>:
                                            @if ($transaction->statusPemesanan == 1)
                                                Menunggu Upload Pembayaran &#128308;
                                            @elseif ($transaction->statusPemesanan == 2)
                                                Menunggu validasi bukti pembayaran &#128195;
                                            @elseif ($transaction->statusPemesanan == 3)
                                                Mempersiapkan pengiriman gas &#128230;
                                            @elseif ($transaction->statusPemesanan == 4)
                                                Produk dalam proses pengiriman  &#128667;
                                            @elseif ($transaction->statusPemesanan == 5)
                                                Produk telah diterima &#129309;
                                            @elseif ($transaction->statusPemesanan == 6)
                                                Pesanan ini telah selesai &#9989;
                                            @elseif ($transaction->statusPemesanan == 0)
                                                Bukti Pembayaran tidak valid &#128308;
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="button-pesanan">
                                <table class="button-table">
                                    <tr>
                                        <td><a href="{{ route('getTransactionData', $transaction->id) }}"><button
                                                    type="submit" class="detail"><i class='fas fa-file-alt'></i> Detail
                                                    Pesanan</button></a></td>
                                        <td>
                                            @if ($transaction->statusPemesanan == 1)
                                                <a href="/uploadBuktiPembayaran/{{ $transaction->id }}"><button
                                                        type="button" class="upload" style=""><i
                                                            class="fa fa-upload"></i>
                                                        Upload bukti pembayaran</button></a>
                                            @elseif ($transaction->statusPemesanan == 0)
                                                <a href="/viewBuktiPembayaranNew/{{ $transaction->id }}"><button
                                                        type="button" class="upload" style=""><i
                                                            class="fa fa-upload"></i>
                                                        Upload Ulang bukti pembayaran</button></a>
                                                {{-- @elseif($transaction->statusPemesanan > 1)
                                                <a href="{{ route('viewBuktiPembayaran', $transaction->id) }}"><button
                                                        type="button" class="upload" style=""><i
                                                            class="fa fa-upload"></i>
                                                        Lihat Bukti Pembayaran</button></a> --}}
                                            @elseif ($transaction->statusPemesanan == 5)
                                                <a href="{{ route('orderRating',$transaction->id)}}"><button type="submit" class="ulasan"
                                                        style="{{ $ulasan }}"><i class="fa fa-star"></i> Beri
                                                        Ulasan</button></a>
                                            @endif

                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php

                        ?>
                    @endforeach

                </div>

                <div></div>
            </div>

            <div>

            </div>
        </div>
    </div>
</body>
<?php
function rupiah($angka)
{
    $hasil = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil;
}
?>

</html>
