<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "mts_psi";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
