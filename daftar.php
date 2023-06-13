<?php 
    require 'function.php';
    if(isset($_POST["daftar"])){
        if(daftar($_POST) == 'error1'){
            $error = 'Email sudah terdaftar';
        }
        else if(daftar($_POST) == 'error2'){
            $error = 'Konfirmasi passsword salah';
        }
        else{
            echo 'berhasil passsword';
            header("Location: masuk.php", true, 301);
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="masuk.css">
    <title>Daftar</title>
</head>
<body>
    <div class="container">
        <h1>Daftar</h1>
        <?php if(isset($error)):?>
            <p class="error"><i><?=$error?></i></p>
        <?php endif?>
        <form action="" method="post" >
            <label for="nama">Nama :</label>
            <input type="nama" id="nama" name="nama" placeholder="nama lengkap" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="email" required>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="password" required>
            <label for="password2">Konfirmasi Password :</label>
            <input type="password" id="password2" name="password2" placeholder="konfirmasi password" required>
            <div class="tombol">
                <button name="daftar" type="submit">Daftar</button>
            </div>
        </form>
    </div>
</body>
</html>