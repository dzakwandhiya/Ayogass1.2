<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Pembayaran</title>

    <link rel="stylesheet" href="/transaksi-css/style.css?v=<?php echo time(); ?>">
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
            <!--<label class="logo">DesignX</label>-->
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
            <div class="pemesanan">
                <h1>DETAIL PEMESANAN</h1>
                <form action="{{ route('tambahTransaksi', $product->id) }}" method="post" id="pesan">
                    @csrf
                    <table>
                        <tr>
                            <td class="left"></i>Nama</i></td>
                            <td>
                                {{ $user->fullname }}
                            </td>
                        </tr>
                        <tr>
                            <td class="left">Alamat</td>
                            <td>
                                {{ $user->alamat }}
                            </td>
                        </tr>
                        <tr>
                            <td class="left">No. Telepon</td>
                            <td>
                                {{ $user->nomorTelepon }}
                            </td>
                        </tr>
                        <tr>
                            <td class="left">Pesanan</td>
                            <td>
                                {{ $product->namaProduk }}
                            </td>
                        </tr>
                        <tr>
                            <td class="left">Jumlah</td>
                            <td>
                                25 Unit @if ($product->stokProduk <= 30)
                                <div style="color: red; font-weight:500">Stok tersisa sedikit lagi !!!</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="left">Catatan</td>
                            <td>
                                <textarea style="font-size:12px; padding-left:5px; padding-top:5px;" rows="3" cols="50" form="pesan"
                                    name="deskripsi"></textarea>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <h1>METODE PEMBAYARAN</h1>
                    <table class="table-2">
                        <tr>
                            <td class="radio-row">
                                <input type="radio" id="bri" name="metodePembayaran" value="1">
                            </td>
                            <td class="logo-row"> <label for="bri"><img src="../asset-img/bri.png"
                                        class="logo-bank"></label></td>
                            <td class="bank-row"><label for="bri"><b>BRI-MOBILE</b><br>Perlu Bukti Transfer</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="radio-row">
                                <input type="radio" id="dana" value="2" name="metodePembayaran">
                            </td>
                            <td class="logo-row"><label for="dana"><img src="../asset-img/dana.png"
                                        class="logo-bank"></label></td>
                            <td class="bank-row"><label for="dana"><b>DANA</b><br>Perlu Bukti Transfer</label></td>
                        </tr>
                        <tr>
                            <td class="radio-row">
                                <input id="mandiri" type="radio" value="3" name="metodePembayaran">
                            </td>
                            <td class="logo-row"><label for="mandiri"><img src="../asset-img/mandiri.png"
                                        class="logo-bank"></label></td>
                            <td class="bank-row"><label for="mandiri"><b>MANDIRI-MOBILE</b><br>Perlu Bukti
                                    ransfer</label></td>
                        </tr>
                        <tr>
                            <td class="radio-row">
                                <input type="radio" id="bca" value="4" name="metodePembayaran">
                            </td>
                            <td class="logo-row"><label for="bca"><img src="../asset-img/bca.png"
                                        class="logo-bank"></label></td>
                            <td class="bank-row"><label for="bca"><b>BCA-MOBILE</b><br>Perlu Bukti Transfer</label>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="tagihan">
                    <strong>
                        <p>Total Pembayaran :
                            <?php echo rupiah(25 * $product->hargaProduk); ?>
                        </p>
                    </strong>
                </div>
                <div>
                </div>
            </div>
            <form action="{{ route('product') }}" id="back" method="GET"></form>
            <div class="tester">
                <button type="submit" form="back" name="back">Pilih Produk Lain</button>

                <button type="submit" form="pesan" onclick="archiveFunction()" name="pesanan">Konfirmasi
                    Pembayaran</button>
            </div>
            <div class="radio-group">
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script type="text/javascript">
    function archiveFunction() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        swal({
                title: "Lanjut Pemesanan?",
                text: "Anda akan memproses pemesanan product {{ $product->namaProduk }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "seagreen",
                confirmButtonText: "Pesan Sekarang!",
                cancelButtonText: "Batalkan Proses!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    form.submit(); // submitting the form when user press yes
                } else {
                    swal("Pemesanan dibatalkan", "Anda membatalkan pemesanan", "warning");
                }
            });
    }
</script>

<?php
function rupiah($angka)
{
    $hasil = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil;
}
?>

</html>
