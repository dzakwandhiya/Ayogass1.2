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

//-------------------------------------------------------------------------------------------//
//----------------------------------------Update Password------------------------------------//
$currentPassword = "";
$currentPassword2 = "";
$newPassword = "";
$newPassword2 = "";
$error = "";
if (isset($_POST['update2'])) {
    echo "<script>alert('Bisa')</script>";
    $currentPassword = $row[5];
    echo $currentPassword;
    $newPassword = $_POST['password'];
    echo $newPassword;
    //$currentPassword2 = $_POST['current'];
    //echo $currentPassword2;
    /*$currentPassword2 = $_POST['oldPassword'];
    $newPassword = $_POST['password'];
    $newPassword2 = $_POST['password2'];
    if ($currentPassword2 != $currentPassword) {
        echo "<script>alert('Password Lama tidak sesuai!')</script>";
        //header("Refresh: 0; url = akun.php");
        //return false;
    } else {
        if ($newPassword != $newPassword2) {
            echo "<script>alert('Konfirmasi Password baru tidak sesuai!')</script>";
            header("Refresh: 0; url = akun.php");
            return false;
        } else {
            $updatePassword = mysqli_query($koneksi, "UPDATE akun SET password='$newPassword' WHERE email='$getEmail'");
        }
    }*/
}

?>