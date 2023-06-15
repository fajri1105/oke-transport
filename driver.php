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
    if(isset($_POST["keluar"])){
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie("##", $id, time() - 3600);
        setcookie("###", $email, time() - 3600);
        header("Location: index.php", true, 301);
        exit();
    }
    if(isset($_POST["edit"])){
        editDriver($_POST);
    }
    $email = $_SESSION["email"];
    $data = bacaWhere("SELECT * FROM user WHERE email = '$email'");
    $dataDriver = bacaWhere("SELECT * FROM driver WHERE email = '$email'");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="driver.css">
    <title><?=$data["nama"]?></title>
</head>
<body>
    <main>
        <div class="data1">
            <p>Halo <span><?=$data["nama"]?></span></p>
            <p class="bawah">Ayo kelola penumpang anda!</p>
            <div class="card">
                <h3>Pendapatan bulan ini</h3>
                <p>Rp.<?=$dataDriver["saldo"]?></p>
            </div>
        </div>
        <div class="data2">
            <h2>Data Driver</h2>
            <table>
                <tr>
                    <th>Nama sopir</th>
                    <td>:</td>
                    <td><?=$dataDriver["nama"]?></td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td>:</td>
                    <td><?=$dataDriver["id"]?></td>

                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>:</td>
                    <td><?=$dataDriver["jurusan"]?></td>

                </tr>
                <tr>
                    <th>Tarif normal</th>
                    <td>:</td>
                    <td>Rp.<?=$dataDriver["tarif"]?></td>

                </tr>
            </table>
            <form class="edit" action="" method="post">
                <input type="hidden" name="email" value="<?=$email?>">
                <select name="edit1" id="edit">
                    <option value="jurusam">Jurusan</option>
                    <option value="tarif">tarif normal</option>
                </select>
                <input type="text" name="edit2" autocomplete="off" placeholder="nilai" required>
                <button type="submit" name="edit">Ubah data</button>
            </form>
            <p class="editData">Ubah Data</p>
        </div>
        <div class="data3">
            <form action="" method="post">
                <button type="submit" name="keluar">Keluar</button>
            </form>
            <div class="logo">
                <img src="img/logo putih.png" alt="">
            </div>
        </div>
    </main>
    <div class="ruangKelola">
        <h1>Ruang Kelola</h1>
        <table cellspacing = "0">
            <tr>
                <th>Kursi</th>
                <th>Nama</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Biaya</th>
                <th>Kelola</th>
            </tr>
        </table>
    </div>
    <script>
        const edit = document.querySelector('main .data2 .editData');
        let i = 0;
        edit.addEventListener('click', function(){
            const formEdit = document.querySelector('main .data2 .edit');
            formEdit.classList.toggle('muncul');
            i += 1;
            if(i == 2) i = 0;
            if( i== 1) edit.innerHTML = 'Selesai';
            if(i == 0) edit.innerHTML = 'Ubah data';
        })
        
        
        
    </script>
</body>
</html>