<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update-Pemesanan</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {

            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: url('../asset-img/background-3.png');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .mx-auto {
            margin-top: 70px;
            width: 95%;
            font-size: 15px;


        }

        .mx-auto h1 {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        select {
            width: 30%;
            height: 30px;
            font-size: 16px;
        }

        .button {
            margin-left: auto;
            margin-right: auto;
        }

        table .left {
            width: 25%;
            font-weight: bold;
        }

        .table .ctt {
            max-width: 150px;
        }

        .btn {
            width: 15%;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 5px;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
        }

        textarea {
            resize: none;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
            padding-left: 4px;
            padding-right: 4px;
        }

        body {
            background-color: aliceblue;
        }

        .navb {
            background-color: seagreen;
            position: fixed;
            height: 60px;
            width: 100%;
            z-index: 2000;
            margin-top: -70px;


        }

        .navb .logo {
            width: 150px;
            cursor: pointer;
            padding-left: 50px;
            padding-top: 14px;

        }


        .navb ul {
            float: right;
            margin-right: 30px;
            padding-top: 17px;
            padding-bottom: 17px;
            z-index: 2000;

        }

        .navb li {
            margin-right: 5px;

        }

        .navb ul li {
            display: inline-block;

            /*margin: 0 5px;*/
        }

        .navb ul li a {
            color: white;
            font-size: 15px;
            border-radius: 25px;
            padding-top: 2px;
            padding-bottom: 2px;
            padding-right: 12px;
            padding-left: 12px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .navb li a:hover {
            background-color: aliceblue;
            color: seagreen;


            transition: 0.3s;
        }

        .checkbtn {
            font-size: 30px;
            color: white;
            float: right;
            line-height: 62px;
            margin-right: 40px;

            cursor: pointer;
            display: none;
        }

        #check {
            display: none;
        }

        .table .act {
            width: 5%;
        }

        .table .ctt {
            max-width: 150px;
        }

        .option {
            width: 300px;
        }

        .card-header {
            text-align: center;
        }

        @media (max-width: 952px) {
            .mx-auto {
                width: 95%;
            }

            .navb .logo {
                width: 100px;
                padding-left: 50px;
                padding-top: 16px;
            }

            .navb ul li a {
                font-size: 16px;
            }

            .navb .logo {
                width: 150px;
            }

            .btn {
                width: 150px;
            }

            .option {
                width: 200px;
            }

        }

        @media (max-width: 858px) {
            .checkbtn {
                display: block;
            }

            ul {
                position: fixed;
                width: 100%;
                height: 100vh;
                background-color: rgb(28, 41, 33);
                top: 60px;
                left: -100%;
                text-align: center;
                transition: all .5s;
            }

            .navb {
                position: fixed;
            }

            .navb ul li {
                display: block;
                margin: 50px 0;
                line-height: 30px;
            }

            .navb ul li a {
                font-size: 20px;
            }

            #check:checked~ul {
                left: 0;
            }

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
            <li><a href="crud-pesanan.php">pemesanan</a></li>
            <li><a href="crud-agen.php">agen</a></li>
            <li><a href="crud-produk.php">produk</a></li>

            <li><a href="../logout/logout.php"><i class="fa fa-fw fa-user"></i> logout</a></li>

        </ul>
    </div>
    <div class="mx-auto w-50 center">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <h1 class="card-header text-white bg-success"><b>EDIT INFORMASI {{ $get->namaProduk }}</b></h1>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('updateProduct', $get->id) }}" method="post" style="padding-top:30px"
                        id="productUpdate">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Produk</label>
                                <input name="namaProduk" for="namaProduk" form="productUpdate" type="text"
                                    style="font-size:14px;"class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ old('namaProduk', $get->namaProduk) }}"
                                    placeholder="{{ $get->namaProduk }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tambah Produk</label>
                                <input name="stokProduk" for="stokProduk" form="productUpdate" type="number"
                                    style="font-size:14px;"class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ old('stokProduk', $get->stokProduk) }}"
                                    placeholder="{{ $get->stokProduk }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Harga Produk</label>
                                <input name="hargaProduk" for="hargaProduk" form="productUpdate" type="number"
                                    style="font-size:14px;"class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ old('hargaProduk', $get->hargaProduk) }}"
                                    placeholder="{{ $get->hargaProduk }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Produk </label>


                                <select name="jenisProduk" for="jenisProduk" form="productUpdate"
                                    style="font-size: 14px; padding-left:5px;" class='w-100'
                                    for="exampleFormControlSelect1" form="update" name="gender" id="gender">
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
            <div class=" text-center" style="padding-bottom:40px">
                <button type='submit' class='btn btn-success' form="productUpdate">Update</button>
                <button type='reset' class='btn btn-secondary' form="productUpdate">Reset</button><br>
            </div>
        </div>
    </div>
</body>

</html>
