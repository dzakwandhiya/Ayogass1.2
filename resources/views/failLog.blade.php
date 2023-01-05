<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Login and Registration Ayo Gass</title>
   
   <link rel="stylesheet" href="log-css/style.css?v=<?php echo time(); ?>">
   <link rel="icon" type="image/x-icon" href="asset-img/logo.png">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
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
         @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
         @endif
       
         <div class="form-inner">
            <form action="{{ route('login') }}" method="post" class="login">
               @csrf
               <div class="field">
                  <input type="text" placeholder="Email Address" required id="email" name="email" for="email" :value="__('Email')">
                  @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
               </div>
               <div class="field">
                  <input type="password" placeholder="Password" required id="password" name="password" for="password" :value="__('Password')">
                  @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
               </div>
               <div class="pass-link">
                  <!--<a href="#">Lupa password?</a>-->
               </div>
               <div class="field btn">
                  <div class="btn-layer"></div>
                  <input type="submit" value="masuk" name="masuk">
               </div>

               <!-- <div class="pass-link" style="text-align: center;">
                  <br>
                  Masuk sebagai <a href="crud-admin/admin.php">Administrator</a>
               </div> -->
            </form>
            <form action="{{ route('register') }}" method="post" class="signup">
               @csrf
               <div class="field-signup">
                  <input type="text" placeholder="Email Address" required id="email" name="email" >
                  @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
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
               <div class="field-signup">
                  <input type="password" placeholder="Konfirmasi password" required id="password_confirmation" name="password_confirmation">
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