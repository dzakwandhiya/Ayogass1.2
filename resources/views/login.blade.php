<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login and Registration Ayo Gass</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="log-css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        <img class="logo" src="/asset-img/logo.png">

        <div class="title-text">

            <div class="title login">
                Login
            </div>
            <div class="title signup">
                Registrasi
            </div>
        </div>

        <div class="form-container">

            <div class="slide-controls">

                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Buat Akun</label>
                <div class="slider-tab"></div>

            </div>
            <div style="text-align: center;">


                <div class="form-inner">
                    <form action="{{ route('doLogin') }}" method="post" class="login">
                        @csrf
                        @if (session()->has('message'))
                            <div class="alert alert-danger">
                                <b>{{ session()->get('message') }}</b>
                            </div>
                        @endif

                        <div class="field">
                            <input type="text" placeholder="Email Address" id="email" name="email"
                                for="email">

                        </div>
                        <div class="field">
                            <input type="password" placeholder="Password" id="password" name="password" for="password">

                        </div>
                        <div class="pass-link">
                            <!--<a href="#">Lupa password?</a>-->
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="masuk" name="masuk">
                        </div>

                    </form>

                    <form action="{{ route('buatAkun') }}" method="post" class="signup">
                        @csrf
                        <div class="field-signup">
                            <input type="text" placeholder="Email Address" id="email" name="email">
                            @if ($errors->has('fullname'))
                                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>
                        <div class="field-signup">
                            <input type="text" placeholder="Nama lengkap" id="fullname" name="fullname">
                            @if ($errors->has('fullname'))
                                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>
                        <div class="field-signup">
                            <select class="option" name="gender" id="gender">
                                <option value="" placeholder="" class="text-secondary">--Pilih Jenis Kelamin--</option>
                                <option class="opsi" value="1">Laki-laki</option>
                                <option class="opsi" value="2">Perempuan</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                        <div class="field-signup">
                            <select class="option" name="status" id="status">
                                <option value="" class="text-secondary">--Daftar sebagai--</option>
                                <option class="opsi" value="1">Supplier Gas</option>
                                <option class="opsi" value="2">Agen Gas</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>

                        <div class="field-signup">
                            <input type="number" placeholder="Nomor Telepon" id="nomorTelepon"
                                name="nomorTelepon">
                            @if ($errors->has('nomorTelepon'))
                                <span class="text-danger">{{ $errors->first('nomorTelepon') }}</span>
                            @endif
                        </div>

                        <div class="field-signup">
                            @error('alamat')
                            <span class="text-danger text-left" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            <input type="text" placeholder="Alamat" id="alamat" name="alamat">
                        </div>
                        <div class="field-signup">
                            @error('password')
                            <span class="text-danger text-left" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            <input type="password" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="field-signup">
                            <input type="password" placeholder="Password" id="password_confirmation"
                                name="password_confirmation">
                        </div>

                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Buat Akun">
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <script>
            const loginText = document.querySelector(".title-text .login");
            const loginForm = document.querySelector("form.login");
            const loginBtn = document.querySelector("label.login");
            const signupBtn = document.querySelector("label.signup");
            const signupLink = document.querySelector("form .signup-link a");
            signupBtn.onclick = (() => {
                loginForm.style.marginLeft = "-50%";
                loginText.style.marginLeft = "-50%";
            });
            loginBtn.onclick = (() => {
                loginForm.style.marginLeft = "0%";
                loginText.style.marginLeft = "0%";
            });
            signupLink.onclick = (() => {
                signupBtn.click();
                return false;
            });
        </script>

</body>

</html>
