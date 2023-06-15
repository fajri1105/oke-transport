<?php 
    session_start();
    require 'function.php';
    if(!isset($_SESSION["login"])){
        header("Location: masuk.php", true, 301);
        exit();
    }
    if($_SESSION["status"] == 'pengguna'){
        header("Location: pengguna.php", true, 301);
        exit();
    }
    $email = $_SESSION["email"];
    $data = bacaWhere("SELECT * FROM user WHERE email = '$email'");


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data["nama"]?></title>
</head>
<body>
    <header>
        <div class="kiri">
            <p>Halo <span><?=$data["nama"]?></span></p>
            <p>Ayo kelola mobil anda!</p>
        </div>
        <div class="kanan">
            <img src="img/logo putih.png" alt="">
        </div>
    </header>
    <section class="data">
        <div class="kiri">
            <table>
                <tr>
                    <th>Informasi mobil</th>
                </tr>
                <tr>
                    <td>Nama Sopir</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </section>
</body>
</html>