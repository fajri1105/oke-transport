<?php 
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: masuk.php", true, 301);
        exit();
    }
    if($_SESSION["status"] == 'pengguna'){
        header("Location: pengguna.php", true, 301);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>