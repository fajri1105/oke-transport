<?php 
require 'function.php';
    if(isset($_POST["masuk"])){
        if(masuk($_POST) == 'error1'){
            $error = 'email tidak ditemukan';
        }
        else if(masuk($_POST) == 'berhasil'){
            header("Location: index.php", true, 301);
            exit();
        }
        else{
            $error = 'password salah';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="masuk.css">
    <title>Masuk</title>
</head>
<body>
    <div class="container">
        <h1>Masuk</h1>
        <?php if(isset($error)):?>
            <p class="error"><i><?=$error?></i></p>
        <?php endif?>
        <form action="" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="email" required>
            <label for="password">password :</label>
            <input type="password" id="password" name="password" placeholder="password" required>
            <input type="checkbox" name="ingat" id="ingat">
            <label for="ingat" class="ingat">Ingat info masuk saya</label>
            <div class="tombol">
                <button name="masuk" type="submit">Masuk</button>
                <a href="daftar.php">Daftar</a>
            </div>
        </form>
    </div>
</body>
</html>