<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "darahdonor"; 

$db = mysqli_connect($host, $user, $pass, $db_name);

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}  
?>