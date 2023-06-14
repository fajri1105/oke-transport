<?php 
    session_start();
    require 'function.php';

    if(!isset($_SESSION["login"])){
        header("Location: masuk.php", true, 301);
        exit();
    }
    if(isset($_POST["keluar"])){
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie("##", $id, time() - 3600);
        setcookie("###", $email, time() - 3600);
        header("Location: index.php", true, 301);
        exit();
    }
    if($_SESSION["status"] == 'driver'){
        header("Location: driver.php", true, 301);
        exit();
    }
    $email = $_SESSION["email"];
    $data = bacaWhere("SELECT * FROM user WHERE email = '$email'");

    $dataPerjalanan = mysqli_query($db, "SELECT * FROM perjalanan WHERE email = '$email'");
    if(mysqli_num_rows($dataPerjalanan) > 0){
        $dataRiwayat = [];
        while($dataRiwayat1 = mysqli_fetch_array($dataPerjalanan)){
            $dataRiwayat[] = $dataRiwayat1;
        }
        $riwayat = true;
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pengguna.css">
    <title><?=$data["nama"]?></title>
</head>
<body>
    <header>
        <img class="logo" src="img/logo putih.png" alt="logo oke transport">
        <form action="" method="post">
            <button name="keluar" type="submit">Keluar</button>
        </form>
    </header>
    <main>
        <section class="kiri">
            <p>Halo <span><?=$data["nama"]?></span></p>
            <p class="bawah">Siap berangkat sekarang?</p>
            <a href="">Cari Driver</a>
        </section>
        <section class="kanan">
            <div class="card">
                <div class="judul">
                    <a href="">+</a>
                    <h3>Saldo</h3>
                </div>
                <div class="saldo">
                    <p>Rp<?=$data["saldo"]?></p>
                </div>
            </div>
        </section>
    </main>
    <div class="riwayat">
            <h3>Riwayat Perjalanan</h3>
            <?php if(isset($riwayat)):?>
                <table cellspacing = "0" cellpadding="10">
                    <tr class="head">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Driver</th>
                        <th>Biaya</th>
                    </tr>
                    <?php $no = 1;?>
                    <?php foreach($dataRiwayat as $datariwayat):?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$datariwayat["tanggal"]?></td>
                            <td><?=$datariwayat["asal"]?></td>
                            <td><?=$datariwayat["tujuan"]?></td>
                            <td><?=$datariwayat["driver"]?></td>
                            <td><?=$datariwayat["biaya"]?></td>
                            <?php $no += 1;?>
                        </tr>
                    <?php endforeach?>
                </table>
            <?php endif?>
        </div>
</body>
</html>