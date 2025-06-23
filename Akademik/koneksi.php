<?php
$host = "localhost";
$user = "root"; 
$password = "";
$db = "db_akademik_tk1b";

$koneksi = new mysqli($host, $user, $password, $db);

if ($koneksi->connect_error) {
    echo "Koneksi gagal!". $koneksi->connect_error;
    exit;
}