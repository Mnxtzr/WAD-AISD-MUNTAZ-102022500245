<?php

    $koneksi = mysqli_connect("localhost", "root", "", "db_gudang");

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>
