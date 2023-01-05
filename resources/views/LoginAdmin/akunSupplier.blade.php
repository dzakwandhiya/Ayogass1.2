<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">

    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweetalert.css">
    <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sass/style.css?v=<?php echo time(); ?>">
</head>

<body>
    @include('sweetalert::alert')
    <div class="banner">
        <div class="navb">
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <img src="../asset-img/logo-4.png" class="logoicon">
            <ul>

                <li><a href="{{ route('supplier')}}">Produk</a></li>
                <li><a href="">Pemesanan</a></li>
                <li><a href="{{ route('akunSupplier') }}"><i class="fa fa-fw fa-user"></i>
                        {{ strtok(strtoupper($user->fullname), ' ') }}</a></li>

            </ul>
        </div>

        <section class="py-5 my-5">

            <div class="container">
                <!-- <h1 class="mb-4" style="text-align: center; color:aliceblue">&ensp;<b> Pengaturan <i
                            class="fa fa-gear"></i></b></h1> -->
                <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <div class="text-center">
                                <img class="img-profil"
                                    src="
                                @if ($user->gender == 1) ../asset-img/man.png
                                @elseif ($user->gender == 2)
                                ../asset-img/woman.png @endif
                                "
                                    alt="Image" class="shadow">
                            </div>
                            <h4 class="text-center">
                                <div style="text-transform: uppercase;"><b>
                                        {{ strtok(strtoupper($user->fullname), ' ') }}</b></div>
                            </h4>
                        </div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab"
                                aria-controls="account" aria-selected="true">
                                <i class="fa fa-fw fa-user"></i>
                                Akun
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                                aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>
                            </a>
                            <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification"
                                role="tab" aria-controls="notification" aria-selected="false">
                                <i class="fa fa-power-off" style="font-size:15px;"></i>
                                Keluar
                            </a>
                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel"
                            aria-labelledby="account-tab">
                            <h3 class="mb-4"><i class="fa fa-gear"></i> Pengaturan Akun </h3>

                            <div class="row">
                                <form class="row g-3" action="{{ route('updateAkunSupplier') }}" method="post" id="update">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Nama Lengkap </label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" id="fullname"
                                                name="fullname" value="{{ $user->fullname }}">{{ $user->fullname }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Email</label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" id="email"
                                                name="email">{{ $user->email }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Jenis Kelamin </label>
                                            <!--<textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update" name="kelamin"
                                                value="<?//php echo $newKelamin ?>"><?//php echo $kelaminView ?></textarea>-->
                                            <div class="form-group">
                                                <select class='option col-md-12' form="update" name="gender"
                                                    id="gender">
                                                    <option class='opsi kelamin-current' value="{{ $user->gender }}">
                                                        @if ($user->gender == 1)
                                                            Laki-laki
                                                        @elseif ($user->gender == 2)
                                                            Perempuan
                                                        @endif
                                                    </option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">No Telepon </label>
                                            <textarea style="resize:none;" class="form-control" rows="1" placeholder="" form="update"
                                                name="nomorTelepon" id="nomorTelepon" value="{{ $user->nomorTelepon }}">{{ $user->nomorTelepon }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Alamat </label>
                                            <textarea style="resize:none;" class="form-control" rows="2" placeholder="" form="update" name="alamat"
                                                id="alamat" value="{{ $user->alamat }}">{{ $user->alamat }}</textarea>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <form action="" method="post" id="cancel"></form>
                            <div>
                                <button class="btn btn-success" type="submit" form="update"
                                    name="update">Update</button>
                                <button class="btn btn-light" type="reset" form="update"
                                    name="cancel">Reset</button>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="mb-4"><i class="fa fa-key text-center mr-1"></i> Ganti Password</h3>

                            <form class="col-lg-12" action="{{ route('updatePasswordSupplier') }}" method="post"
                                id="updatePass">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Password Lama</label>
                                            <input type="password" class="form-control" name="current_password"
                                                id="current_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Password Baru</label>
                                            <input type="password" class="form-control" name="password"
                                                id="password">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <button class="btn btn-success" type="submit" form="updatePass"
                                    name="update2">Update</button>
                                <button class="btn btn-light" type="reset" form="updatePass"
                                    name="update2">Reset</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="notification" role="tabpanel"
                            aria-labelledby="notification-tab">
                            <h3 class="mb-4">Keluar</h3>

                            <div>

                                <p>keluar dari website Ayo Gass ?</p>
                                <form method="GET" action="{{ route('logout') }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="Keluar">
                                    <button type="submit" class="btn btn-success show_confirm" data-toggle="tooltip"
                                        title='Delete'>Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
</body>

</html>
