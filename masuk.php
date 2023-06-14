<?php 
require 'function.php';
session_start();

if(isset($_COOKIE["###"])){
    $id = $_COOKIE["##"] - 2;
    $data = bacaWhere("SELECT * FROM user WHERE id = '$id'");
    $email = hash('sha256', $data["email"]);
    if($_COOKIE["###"] == $email){
        $_SESSION["login"] = true; 
        $_SESSION["status"] = $data["status"];
        $_SESSION["email"] = $data["email"];
    }
}
if(isset($_SESSION["login"])){
    if($_SESSION["login"] == true){
        header("Location: pengguna.php", true, 301);
        exit();
}

}
    if(isset($_POST["masuk"])){
        if(masuk($_POST) == 'error1'){
            $error = 'email tidak ditemukan';
        }
        else if(masuk($_POST) == 'berhasil'){
            $_SESSION["login"] = true;
            $email = $_POST["email"];
            $data = bacaWhere("SELECT * FROM user WHERE email = '$email'");
            $_SESSION["status"] = $data["status"];
            $_SESSION["email"] = $data["email"];
            if(isset($_POST["ingat"])){
                $id = $data["id"] + 2;
                $email = hash('sha256', $email);
                $status = $data["status"];
                setcookie("##", $id, time() + 3600);
                setcookie("###", $email, time() + 3600);
            }
            header("Location: pengguna.php", true, 301);
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
            <input type="checkbox" class="ingat" id="ingat" value="ingat" name="ingat">
            <label for="ingat" class="ingatT">Ingat info masuk saya</label>
            <div class="tombol">
                <button name="masuk" type="submit">Masuk</button>
                <a href="daftar.php">Daftar</a>
            </div>
        </form>
    </div>
</body>
</html>