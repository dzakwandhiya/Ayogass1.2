<?php


$host = "localhost";
$user = "root";
$pass = "";
$db = "pt-1";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa  terkoneksi ke database ");
} /*else {
    echo "Koneksi berhasil";
    
}*/
$getEmail = $_SESSION['email'];
$sql = "SELECT email, nama, kelamin, noTelepon, alamat, password FROM akun WHERE email='$getEmail'";
$result = $koneksi->query($sql);
if (!$result) {
    echo "Data tidak dapat diakses";
}
$row = mysqli_fetch_row($result);
$emailView = $row[0];
$namaView = $row[1];
$kelaminView = $row[2];
$noTeleponView = $row[3];
$alamatView = $row[4];


//---------------------Update Akun----------------------//
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$newNama = "";
$newEmail = "";
$newKelamin = "";
$newNoTelepon = "";
$newAlamat = "";
if (isset($_POST['update'])) {
    $newEmail = $_POST['email'];
    $newNama = $_POST['nama'];
    $newKelamin = $_POST['kelamin'];
    $newNoTelepon = $_POST['noTelepon'];
    $newAlamat = $_POST['alamat'];

    $newEmail = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email tidak sesuai')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    }

    $newNama = test_input($_POST["nama"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $newNama)) {
        echo "<script>alert('Gagal Update! Nama harus menggunakan huruf dan spasi')</script>";
        header("Refresh: 0; url = ../akun/akun.php");
        return false;
    } else {
        $updateNama = mysqli_query($koneksi, "UPDATE akun SET nama='$newNama' WHERE email='$getEmail'");
    }

    $updateKelamin = mysqli_query($koneksi, "UPDATE akun SET kelamin='$newKelamin' WHERE email='$getEmail'");
    $updateAlamat = mysqli_query($koneksi, "UPDATE akun SET alamat='$newAlamat' WHERE email='$getEmail'");
    $updateNoTelepon = mysqli_query($koneksi, "UPDATE akun SET noTelepon='$newNoTelepon' WHERE email='$getEmail'");
    if ($newEmail == $getEmail) {
        header("Refresh: 0; url = akun.php");
    } else {
        $duplikasi = mysqli_query($koneksi, "SELECT email FROM akun WHERE email = '$newEmail'");
        if (mysqli_fetch_assoc($duplikasi)) {
            echo "<script>alert('Email Sudah Terdaftar!!!')</script>";
            header("Refresh: 0; url = akun.php");
            return false;
        } else {
            $updateEmail = mysqli_query($koneksi, "UPDATE akun SET email='$newEmail' WHERE email='$getEmail'");
            echo "<script>alert('Update Email Berhasil. Silahkan Login Ulang')</script>";
            header("Refresh: 0; url = logout.php");
            exit;
        }
    }
}
?>