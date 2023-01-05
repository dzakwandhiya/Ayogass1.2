<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Contact</title>
  <link rel="stylesheet" href="contact-css/style.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="banner">
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <img src="../asset-img/logo-4.png" class="logo">
      <ul>
        <li><a href="{{ url('/home')}}"> Home </a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('product')}}">Produk</a></li>
        <li><a href="{{ url('/getAllTransaction')}}">Pesanan</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('akun') }}"><i class="fa fa-fw fa-user"></i> {{strtok(strtoupper($user->fullname), " ")}}</a></li>
      </ul>
    </nav>
    <div class="content">
      <!-- <div class="wa">
        <img src="whatsapp.png">

        <p>Hubungi Kami Melalui WhatsApp :</p>
        <a href="https://wa.me/6289526474709"><button type="button">WhatsApp Kami</button></a>
      </div> -->
      <table>
        <tr>
          <th class="whatsapp">
            <div class="in-wa">
              <img src="../asset-img/whatsapp.png">
              <!-- <h1>Whatsapp</h1> -->
              <p>Hubungi Kami Melalui WhatsApp :</p>
              <a href="https://wa.me/6289526474709"><button type="button">WhatsApp Kami</button></a>
            </div>
          </th>
          <th class="email">
            <div class="in-email">
              <img src="../asset-img/email.png">
              <!-- <h1>Email</h1> -->
              <p>Hubungi Kami Melalui Email :</p>
              <a href="mailto:dzakwandhiya7g@gmail.com"><button type="button">Email Kami</button></a>
            </div>

          </th>
        </tr>
      </table>
    </div>

  </div>
  </div>
  </div>
</body>

</html>
