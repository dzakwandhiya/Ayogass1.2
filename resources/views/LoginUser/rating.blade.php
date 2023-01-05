<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../rating-css/style.css?v=<?php echo time(); ?>" />

    <title>rating</title>


</head>
<?php $ulasan = ""?>
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
                <li><a href=""> Home </a></li>
                <li><a href="">About</a></li>
                <li><a href="">Produk</a></li>
                <li><a href="">Pesanan</a></li>
                <li><a href="">Contact</a></li>
                <li><a href=""><i class="fa fa-fw fa-user"></i> Akun</a></li>
            </ul>
        </nav>
        <div class="content">
            <div class="space">


                <h1>YUK BERI ULASAN</h1>
                <p>Terimakasih <b>{{ strtok(strtoupper($user->fullname), ' ') }}</b> telah memesan produk
                    {{ $product->namaProduk }} dari {{ strtok(strtoupper($supplier->fullname), ' ') }}. ayo beri ulasan
                    tentang produk dan layanan kami</p>
                <p>Rating dari pemesanan ini :</p>
                <form method="POST" action="{{ route('storeRating', $transaction->id) }}" id="ulasan">
                    @csrf
                    <div class="stars">

                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                        <label class="star star-1" for="star-1"></label>
                    </div>
                    <br>
                    <p>Berikan Komentar dari pemesanan ini :</p>
                    <textarea style="padding-left:5px; padding-top:5px;" rows="3" cols="50" form="ulasan" for="ulasan" name="ulasan" id="ulasan"></textarea>
                    <p>Anda hanya dapat memberikan sekali ulasan untuk satu transaksi</p>
                </form>
                <br>
                <form id=reset></form>

                <button type='submit' form="ulasan" onclick="archiveFunction()">KIRIM ULASAN</button>


            </div>
        </div>
        </section>


    </div>

    </div>
    </div>
    </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <script type="text/javascript">
        function archiveFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "Beri Ulasan?",
                    text: "Berikan ulasan terbaik anda tentang produk ini",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "seagreen",
                    confirmButtonText: "Kirim ulasan!",
                    cancelButtonText: "Batalkan!",
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

</body>



</html>
