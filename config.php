<?php
$mysqli = new mysqli("localhost", "root", "", "perpustakaan");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>