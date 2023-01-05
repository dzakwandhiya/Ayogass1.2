<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Produk</title>
    <link rel="stylesheet" href="/detail_pesanan-css/style.css?v=<?php echo time(); ?>">
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
                <h1 style="font-weight: bold">UPLOAD ULANG BUKTI PEMBAYARAN</h1>
                <hr>
                <div class="scrol">
                    <div class="order">
                        <div class="order-content">
                            <h1 style="font-weight: bold; font-size:30px">{{ $product->namaProduk }}</h1>
                            <table>
                                <tr>
                                    <td class="col1">Kode Pesanan</td>
                                    <td>: {{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <td>Produk</td>
                                    <td>:{{ $transaction->totalPembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>: {{ $transaction->stokPemesanan }}</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>: {{ $transaction->totalPembayaran }}</td>
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
                                    <td>Status Pesanan </td>
                                    <td>:
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
                                    </td>
                                </tr>
                            </table>
                            <form action="{{ route('uploadUlangBuktiPembayaran', $transaction->id) }}" method="POST"
                                id="upload" enctype="multipart/form-data">
                                @csrf
                                <div style="margin-left:auto; margin-right:auto; width: 50%">

                                    <div class="mb-3 w-100">
                                        <p class="text-center" style="font-weight: bold; margin-top:20px">UPLOAD ULANG FOTO
                                            BUKTI PEMBAYARAN DIBAWAH:</p>
                                        <input class="form-control" form="upload" type="file" name="img"
                                            required>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-center" style="margin-bottom: 20px">

                            <a href="{{ url('/getAllTransaction') }}"><button type="submit" style="font-size:15px"
                                    class="bg-secondary text-white"><i class='fas fa-file-alt'></i>
                                    KEMBALI</button></a>
                            <button type="submit" form="upload" style="font-size:15px"
                                class="bg-success text-white"><i class='fas fa-file-alt'></i>
                                UPLOAD</button>

                        </div>
                    </div>


                </div>

                <div></div>
            </div>

            <!--
      <div class="cards">
        <div class="card card1" id="style-15">
          <div class="container">
            <img src="../asset-img/blueGaz.jpg">
          </div>
          <div class="details">
            <h3>BLUE GAS 12KG</h3>
            <h4>
              <table style="width: 100%;">
                <tr>
                  <td><i class='fas fa-store-alt'></i> </td>
                  <td>Toko Jaya</td>
                </tr>
                <tr>
                  <td><i class='fas fa-check-circle'> </i></td>
                  <td>Stok : 400 Unit </td>
                </tr>
                <tr>
                  <td> <i class='fas fa-money-bill'></i></td>
                  <td>Harga Rp. 400.000,00 </td>
                </tr>
              </table>
            </h4>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-cart-plus'></i> Beli
                Produk</button></a>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-comment'></i> Chat
                penjual</button></a>
          </div>
        </div>
        <div class="card card1" id="style-15">
          <div class="container">
            <img src="../asset-img/blueGaz.jpg">
          </div>
          <div class="details">
            <h3>BLUE GAS 12KG</h3>
            <h4>
              <table style="width: 100%;">
                <tr>
                  <td><i class='fas fa-store-alt'></i> </td>
                  <td>Toko Jaya</td>
                </tr>
                <tr>
                  <td><i class='fas fa-check-circle'> </i></td>
                  <td>Stok : 400 Unit </td>
                </tr>
                <tr>
                  <td> <i class='fas fa-money-bill'></i></td>
                  <td>Harga Rp. 400.000,00 </td>
                </tr>
              </table>
            </h4>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-cart-plus'></i> Beli
                Produk</button></a>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-comment'></i> Chat
                penjual</button></a>
          </div>
        </div>
        <div class="card card1" id="style-15">
          <div class="container">
            <img src="../asset-img/blueGaz.jpg">
          </div>
          <div class="details">
            <h3>BLUE GAS 12KG</h3>
            <h4>
              <table style="width: 100%;">
                <tr>
                  <td><i class='fas fa-store-alt'></i> </td>
                  <td>Toko Jaya</td>
                </tr>
                <tr>
                  <td><i class='fas fa-check-circle'> </i></td>
                  <td>Stok : 400 Unit </td>
                </tr>
                <tr>
                  <td> <i class='fas fa-money-bill'></i></td>
                  <td>Harga Rp. 400.000,00 </td>
                </tr>
              </table>
            </h4>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-cart-plus'></i> Beli
                Produk</button></a>
            <a href="#"><button type="button" class="beli buy"><i class='fas fa-comment'></i> Chat
                penjual</button></a>
          </div>
        </div>
        <div class="card card3">
          <div class="container">
            <img src="singapore.jpg">
          </div>
          <div class="details">
            <h3>Singapore</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci
              exercitationem.</p>
          </div>
        </div>
      </div> -->

            <div>

            </div>
        </div>
    </div>
</body>

</html>
