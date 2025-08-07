<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tugas-6";

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
#echo "Koneksi berhasil ke database!";

// Uncomment the line below to see the connection message