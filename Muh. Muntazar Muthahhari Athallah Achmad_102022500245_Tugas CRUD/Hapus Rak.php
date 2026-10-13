<?php
    include "koneksi.php";

    if (isset($_GET["kode"])) {
        $kode = mysqli_real_escape_string($koneksi, $_GET["kode"]);

        mysqli_query($koneksi, "DELETE FROM rak WHERE kode = '$kode'");
    }

    header("Location: Info Lorong dan Rak.php");
    exit;
?>
