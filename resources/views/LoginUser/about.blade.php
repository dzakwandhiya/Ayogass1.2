
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Home</title>
  <link rel="stylesheet" href="about-css/style.css?v=<?php echo time(); ?>">
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
        <li><a href="{{ url('/home')}}"> Home </a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('product')}}">Produk</a></li>
        <li><a href="{{ url('/getAllTransaction')}}">Pesanan</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('akun') }}"><i class="fa fa-fw fa-user"></i> {{strtok(strtoupper($user->fullname), " ")}}</a></li>
      </ul>
    </nav>
    <div class="content">
      <div class="info-responsive">
        <h1></h1>
        <div class="infoAbout">
          <p>PRODUK GAS</p>
        </div>
        <h1>{{$jumlahPenjual}}</h1>
        <div class="infoAbout">
          <p>PENJUAL GAS</p>
        </div>
        <h1></h1>
        <div class="infoAbout">
          <p>AGEN GAS</p>
        </div>
      </div>
      <div class="about-responsive">
        <h1>About</h1>
            <hr>
            <p>Aplikasi Web Ayo Gas merupakan
              Sistem Layanan Pemesanan Gas Berbasis
              Web untuk mempermudah  Agen dalam
               pemesanan Gas. Menyediakan Berbagai
              Macam  Produk GAS LPG, Bright Gas
              dan Blue Gas.
              </p>
      </div>
      <br>

      <table>
        <tr>
          <th class="info">
              <h1>{{$jumlahProduk}}</h1>
              <div class="infoAbout">
                <p>PRODUK GAS</p>
              </div>
              <h1>{{$jumlahPenjual}}</h1>
              <div class="infoAbout">
                <p>PENJUAL GAS</p>
              </div>
              <h1>{{$jumlahAgen}}</h1>
              <div class="infoAbout">
                <p>AGEN GAS</p>
              </div>
          </th>
          <th class="about">
            <h1>About</h1>
            <hr>
            <p>Aplikasi Web Ayo Gas merupakan<br>
              Sistem Layanan Pemesanan Gas Berbasis<br>
              Web untuk mempermudah  Agen dalam<br>
               pemesanan Gas. Menyediakan Berbagai<br>
              Macam  Produk GAS LPG, Bright Gas<br>
              dan Blue Gas.
              </p>
          </th>
        </tr>
      </table>

      <div>
      </div>
    </div>
  </div>
</body>

</html>
