<?php

$host      = "localhost";
$user      = "root";
$pass      = "";
$db        = "uji";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    echo "gk nyambung weh :". mysqli_connect_errno();
}

?>