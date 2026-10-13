<?php
    session_start();

    if (!isset($_SESSION["rak"])) {
        $_SESSION["rak"] = [
            ["kode" => "A101", "lorong" => "Lorong A", "terisi" => 820,  "kapasitas" => 1000, "tipe" => "Shelving"],
            ["kode" => "A102", "lorong" => "Lorong A", "terisi" => 350,  "kapasitas" => 1000, "tipe" => "Shelving"],
            ["kode" => "A103", "lorong" => "Lorong A", "terisi" => 1000, "kapasitas" => 1000, "tipe" => "Pallet Rack"],
            ["kode" => "B101", "lorong" => "Lorong B", "terisi" => 600,  "kapasitas" => 1000, "tipe" => "Cold Storage"],
            ["kode" => "B102", "lorong" => "Lorong B", "terisi" => 200,  "kapasitas" => 1000, "tipe" => "Pallet Rack"],
            ["kode" => "C101", "lorong" => "Lorong C", "terisi" => 1000, "kapasitas" => 1000, "tipe" => "Cold Storage"],
        ];
    }
?>
