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
    <link rel="stylesheet" href="/detail_pesanan-css/style.css?v=<?php echo time(); ?>">
    <style>
        .checked {
            color: orange;
        }
        .unchecked{
            color: rgb(0, 0, 0);
        }

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
            background-color: rgb(45, 151, 91);
            margin: auto;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 20px;
            border-radius: 10px;
            border: 5px solid rgb(96, 255, 162);
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
                <h1>DETAIL PESANAN</h1>
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h1>BUKTI PEMBAYARAN</h1>
                        <img class="popup" src="/bukti_pembayaran/{{ $transaction->buktiPembayaran }}">
                    </div>

                </div>
                <hr>
                <div class="scrol">
                    <div class="order">
                        <div class="order-content">
                            <h1>{{ $product->namaProduk }}</h1>
                            <table>
                                <tr>
                                    <td class="col1">Kode Pesanan</td>
                                    <td>: {{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan Pesanan</td>
                                    <td>:{{ $transaction->deskripsi }}</td>
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
                                    <td>Penerima</td>
                                    <td>: {{ $user->fullname }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Penerima</td>
                                    <td>: {{ $user->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Status Pesanan</td>
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
                                        @elseif ($transaction->statusPemesanan == 6)
                                            Bukti pembayaran tidak valid &#9989;
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Rating</td>
                                    <td>:
                                        @if ($getRating == 1)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span> <span>&#x1F61E;</span>
                                        @elseif ($getRating == 2)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span> <span>&#x1F641;</span>
                                        @elseif ($getRating == 3)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star unchecked"></span>
                                            <span class="fa fa-star unchecked"></span> <span>&#x1F642;</span>
                                        @elseif ($getRating == 4)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star unchecked"></span> <span>&#x1F600;</span>
                                        @elseif ($getRating == 5)
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span> <span>&#129321;</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Ulasan</td>
                                    <td>: {{ $getUlasan }}</td>
                                </tr>
                                <tr>
                                    <td>Bukti pembayaran</td>
                                    <td>:
                                        @if ($transaction->statusPemesanan == 1)
                                            Anda belum upload bukti pembayaran
                                        @elseif ($transaction->statusPemesanan == 0)
                                            Bukti pembayaran tidak valid
                                        @else
                                            <button type="submit" id="myBtn" class="detail"><i
                                                    class='fas fa-file-alt'></i>
                                                LIHAT STRUK</button></a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="button-pesanan">
                            <td><a href="/getAllTransaction"><button type="submit" class="detail"><i
                                            class='fas fa-file-alt'></i>
                                        KEMBALI</button></a></td>

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
