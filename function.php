<?php 
    $db = mysqli_connect("Localhost", "root", "", "Oketransport");

    function daftar($data){
        global $db;
        $email = htmlspecialchars($data["email"]);
        $password = mysqli_real_escape_string($db, $data["password"]);
        $password2 = mysqli_real_escape_string($db, $data["password2"]);
        $nama = htmlspecialchars($data["nama"]);
        $status = $data["status"];
        $saldo = $data["saldo"];

        $cek = mysqli_query($db, "SELECT email FROM user WHERE email = '$email'");
        if(mysqli_num_rows($cek) > 0){
            return 'error1';
        }
        if($password != $password2){
            return 'error2';
        }


        $password = password_hash($password, PASSWORD_DEFAULT);
        $perintah = "INSERT INTO `user` (`id`, `nama`, `email`, `password`, `status`, `saldo`) VALUES ('', '$nama', '$email', '$password', '$status', '$saldo')";
        $perintah2 = "INSERT INTO `driver` (`id`, `email`, `nama`, `jurusan`, `tarif`, `saldo`) VALUES ('', '$email', '$nama', '-', 0, 0)";
        mysqli_query($db, $perintah);
        mysqli_query($db, $perintah2);
        return 'berhasil';
    }

    function masuk($data){
        global $db;

        $email = $data["email"];
        $password = $data["password"];

        $cek = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'");
        if(mysqli_num_rows($cek) < 1){
            return 'error1';
        }
        $datas = mysqli_fetch_assoc($cek);
        if(password_verify($password, $datas['password'])){
            return 'berhasil';
        }
        else return 'error2';
    }

    function baca($query){
        global $db;
        $result = mysqli_query($db, $query);
        $datas = [];
        while ($row = mysqli_fetch_assoc($result)){
            $datas[] = $row;
        }
        return $datas;
    }

    function bacaWhere($data){
        global $db;
        $result = mysqli_query($db, $data);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //edit data driver
    function editDriver($data){
        global $db;
        $email = $data['email'];
        $data1 = $data["edit1"];
        $data2 = $data["edit2"];

        mysqli_query($db, "SELECT * FROM driver WHERE email = '$email'");
        if($data1 == "tarif"){
            mysqli_query($db, "UPDATE driver SET tarif = $data2");
        }
        else{
            mysqli_query($db, "UPDATE driver SET jurusan = '$data2'");
        }
    }
?>