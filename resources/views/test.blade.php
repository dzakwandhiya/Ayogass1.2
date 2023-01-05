<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login and Registration Ayo Gass</title>

    <link rel="stylesheet" href="log-css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="asset-img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="row justify-content-center">
    <div class="col-md-4">
        <form action="{{ route('buatAkun') }}" method="post" class="signup">
            @csrf
            <div class="field-signup">
                <input type="text" placeholder="Email Address" required id="email" name="email">
                @if ($errors->has('fullname'))
                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
            </div>
            <div class="field-signup">
                <input type="text" placeholder="Nama lengkap" required id="fullname" name="fullname">
                @if ($errors->has('fullname'))
                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
            </div>
            <div class="field-signup">
                <select class="option" name="gender" id="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option class="opsi" value="1">Laki-laki</option>
                    <option class="opsi" value="2">Perempuan</option>
                </select>
                @if ($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
            </div>

            <div class="field-signup">
                <input type="number" placeholder="Nomor Telepon" required id="nomorTelepon" name="nomorTelepon">
                @if ($errors->has('nomorTelepon'))
                    <span class="text-danger">{{ $errors->first('nomorTelepon') }}</span>
                @endif
            </div>

            <div class="field-signup">
                <input type="text" placeholder="Alamat" required id="alamat" name="alamat">
                @if ($errors->has('alamat'))
                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                @endif
            </div>
            <div class="field-signup">
                <input type="password" placeholder="Password" required id="password" name="password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <!-- backup -->
            <div class="field-signup">
                <input type="password" placeholder="Konfirmasi password" required id="password_confirmation"
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
