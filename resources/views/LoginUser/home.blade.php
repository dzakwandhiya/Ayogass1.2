
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="../asset-img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Home</title>
  <link rel="stylesheet" href="home-css/style.css?v=<?php echo time(); ?>">
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
      <table>
        <tr>
          <th class="produk">
            <b>
              <p>PRODUK TERLARIS</p>
            </b>
            <h1>GAS ELPIJI 3KG</h1>
            <p>
              <img class="gambarResponsive" src="../asset-img/gas3kg.jpg"><br>
              Gas Elpiji 3Kg produk terlaris saat ini.<br>
              Harga Rp. 400.000,00 / 20 Unit

              <br>
              <a href="../Produk2/produk.php"><button type="button">LIHAT PRODUK</button></a>
            </p>
          </th>
          <th class="gambarRow">
            <img src="../asset-img/gas3kg.jpg">
          </th>
        </tr>
        <tr>
          <th></th>
          <th></th>
        </tr>
      </table>

      <div>
      </div>
    </div>
  </div>
</body>

</html>
