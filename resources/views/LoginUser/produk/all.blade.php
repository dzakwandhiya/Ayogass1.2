
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link rel="stylesheet" href="produk-css/style.css?v=<?php echo time(); ?>">

    <title>Product</title>
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
            <div class="select">
                <a href="{{ route('product') }}"><button type="button" class="active">All</button></a>
                <a href="{{ route('productGas3Kg') }}"><button type="button" class="nonactive">Elpiji 3KG</button></a>
                <a href="{{ route('productGas12Kg') }}"><button type="button" class="nonactive">Gas 12Kg</button></a>
                <a href="{{ route('productBrightGas5Kg') }}"><button type="button" class="nonactive">Bright Gas
                        5,5Kg</button></a>
                <a href="{{ route('productBrightGas12Kg') }}"><button type="button" class="nonactive">Bright Gas
                        12Kg</button></a>
            </div>
            <div class="cards">
                @foreach ($getAllProducts as $products)
                    <?php

                    if ($products->stokProduk < 25) {
                        $disabled = 'disabled';
                        $bg_disabled = 'background-color: rgb(59, 59, 59)';
                        $stok = 'Kosong';
                    } else {
                        $disabled = '';
                        $bg_disabled = '';
                        $stok = $products->stokProduk . ' Unit';
                        $icon_stok = '';
                    }

                    ?>
                    <div class="card card1" id="style-15">
                        <div class="container">
                            <img
                                src="
                                @if ($products->stokProduk < 25)
                                @if ($products->jenisProduk == 4)
                                ../asset-img/br12kg-bw.jpg
                                @elseif ($products->jenisProduk == 3)
                                ../asset-img/bg5Kg-bw.jpg
                                @elseif ($products->jenisProduk == 2)
                                ../asset-img/gas12kg-bw.jpg
                                @elseif ($products->jenisProduk == 1)
                                ../asset-img/gas3kg-bw.jpg @endif
                                @else
                                @if ($products->jenisProduk == 4) ../asset-img/br12kg.jpg
                                @elseif ($products->jenisProduk == 3)
                                ../asset-img/bg5Kg.jpg
                                @elseif ($products->jenisProduk == 2)
                                ../asset-img/gas12kg.jpg
                                @elseif ($products->jenisProduk == 1)
                                ../asset-img/gas3kg.png @endif
                                @endif

                            ">
                        </div>
                        <div class="details">
                            <h3>{{ strtoupper($products->namaProduk) }}</h3>
                            <h4>
                                <table style="width: 100%;">
                                    <tr>
                                        <td><i class='fas fa-store-alt'></i> </td>
                                        <td>Toko {{ $products->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if ($products->stokProduk < 25)
                                                <i class='fas fa-times-circle' style='color: rgb(240, 71, 71)'></i>
                                            @else
                                                <i class='fas fa-check-circle' style='color:seagreen'> </i>
                                            @endif
                                        </td>
                                        <td>Stok : {{ $stok }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td><i class="fa fa-star" style="color: rgb(241, 184, 26)"></i></td>
                                        <td>Rating : -</td>
                                    </tr> --}}
                                    <tr>
                                        <td><i class='fas fa-chart-line'></i></td>
                                        <td>Terjual : {{ $products->produkTerjual }}</td>
                                    </tr>
                                    <tr>
                                        <td> <i class='fas fa-wallet' style="color: rgb(139, 43, 43)"></i></td>
                                        <td>Harga {{ rupiah($products->hargaProduk) }}</td>
                                    </tr>
                                </table>
                            </h4>
                            <a href="{{ route('transaction', $products->id) }}"><button type="button" class="beli buy"
                                    style="{{ $bg_disabled }}" {{ $disabled }}><i class='fas fa-cart-plus'></i>
                                    Beli
                                    Produk</button></a>
                            <a href="https://wa.me/{{ $products->nomorTelepon }}"><button type="button"
                                    class="beli buy"><i class='fas fa-comment'></i>
                                    Chat
                                    penjual</button></a>
                        </div>
                    </div>
                @endforeach
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
