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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="sass/style.css?v=<?php echo time(); ?>">
    <title>Profil</title>


</head>

<body>
    @include('sweetalert::alert')
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-success" id="sidebar-wrapper">
            <div class="sidebar-heading py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><img
                    src="../asset-img/logo-4.png" class="float-left" style="max-width:180px"></div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('test3') }}"
                    class="list-group-item list-group-item-action text-white fw-bold hovr"><i
                        class="fas fa-shopping-cart me-2"></i>PEMESANAN</a>
                <a href="{{route('test4')}}" class="list-group-item list-group-item-action text-white econd-text fw-bold hovr"><i
                        class="fas fa-gift me-2"></i>PRODUK</a>
                <a href="{{route('akunSupplier')}}" class="list-group-item list-group-item-action bg-white active">
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
                    <h2 style="font-weight: bold">PENGATURAN</h2>
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
                                <li><a class="dropdown-item" href="{{route('akunSupplier')}}">Pengaturan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div style="width:auto; max-width:95%; max-height:520px"
                class="bg-white shadow rounded-lg d-block d-sm-flex rounded mx-auto">
                <div class="profile-tab-nav border-right" style="border-right: 1px solid rgb(214, 213, 213)">
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
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
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
                        <h3 class="mb-4"><i class="fa fa-gear"></i> Pengaturan</h3>

                        <div class="row">
                            <form class="row g-3" action="{{ route('updateAkunSupplier') }}" method="post"
                                id="update">
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
                                        <input type="password" class="form-control" name="password" id="password">

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

                    <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                        <h3 class="mb-4">Keluar</h3>

                        <div>

                            <p>keluar dari website Ayo Gass ?</p>
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf
                                <input name="_method" type="hidden" value="Keluar">
                                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip"
                                    title='Delete'>Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid px-4">

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
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
