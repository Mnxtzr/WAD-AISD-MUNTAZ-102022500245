<?php
    include "koneksi.php";

    $kode = $lorong = $kapasitas = $terisi = $tipe = "";
    $kodeErr = $lorongErr = $kapasitasErr = $terisiErr = $tipeErr = "";

    $mode = "tambah";

    if (isset($_GET["kode"])) {
        $mode = "edit";

        $kodeEdit = mysqli_real_escape_string($koneksi, $_GET["kode"]);
        $hasil = mysqli_query($koneksi, "SELECT * FROM rak WHERE kode = '$kodeEdit'");
        $data = mysqli_fetch_assoc($hasil);

        if ($data) {
            $kode = $data["kode"];
            $lorong = $data["lorong"];
            $kapasitas = $data["kapasitas"];
            $terisi = $data["terisi"];
            $tipe = $data["tipe"];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $mode = $_POST["mode"];

        if (empty($_POST["kode"])) {
            $kodeErr = "Kode rak wajib diisi";
        } else {
            $kode = $_POST["kode"];

            if ($mode == "tambah") {
                $kodeCek = mysqli_real_escape_string($koneksi, $kode);
                $hasil = mysqli_query($koneksi, "SELECT * FROM rak WHERE kode = '$kodeCek'");
                if (mysqli_num_rows($hasil) > 0) {
                    $kodeErr = "Kode rak sudah ada";
                }
            }
        }

        if ($_POST["lorong"] == "") {
            $lorongErr = "Lorong wajib dipilih";
        } else {
            $lorong = $_POST["lorong"];
        }

        if (empty($_POST["kapasitas"])) {
            $kapasitasErr = "Kapasitas wajib diisi";
        } else {
            $kapasitas = $_POST["kapasitas"];
        }

        if ($_POST["terisi"] == "") {
            $terisiErr = "Isi rak wajib diisi (boleh 0)";
        } else {
            $terisi = $_POST["terisi"];

            if ($kapasitas != "" && $terisi > $kapasitas) {
                $terisiErr = "Isi rak tidak boleh lebih dari kapasitas";
            }
        }

        if ($_POST["tipe"] == "") {
            $tipeErr = "Tipe rak wajib dipilih";
        } else {
            $tipe = $_POST["tipe"];
        }

        if ($kodeErr == "" && $lorongErr == "" && $kapasitasErr == "" && $terisiErr == "" && $tipeErr == "") {

            $kodeDb = mysqli_real_escape_string($koneksi, $kode);
            $lorongDb = mysqli_real_escape_string($koneksi, $lorong);
            $tipeDb = mysqli_real_escape_string($koneksi, $tipe);
            $kapasitasDb = (int)$kapasitas;
            $terisiDb = (int)$terisi;

            if ($mode == "edit") {

                mysqli_query($koneksi, "UPDATE rak SET lorong = '$lorongDb', kapasitas = $kapasitasDb, terisi = $terisiDb, tipe = '$tipeDb' WHERE kode = '$kodeDb'");
            } else {

                mysqli_query($koneksi, "INSERT INTO rak (kode, lorong, kapasitas, terisi, tipe) VALUES ('$kodeDb', '$lorongDb', $kapasitasDb, $terisiDb, '$tipeDb')");
            }

            header("Location: Info Lorong dan Rak.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lorong dan Rak</title>
    <link rel="stylesheet" href="Tambah Rak.css">
</head>
<body>
    <a class="balik" href="Info Lorong dan Rak.php">Kembali ke Daftar</a>

    <?php if ($mode == "edit") { ?>
        <h1>Edit Rak</h1>
        <p>Ubah Data Rak <?php echo $kode; ?></p>
    <?php } else { ?>
        <h1>Tambah Rak Baru</h1>
        <p>Isi Lokasi Lorong dan Kapasitas Rak</p>
    <?php } ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">

        <label for="kode">Kode Rak</label>
        <input type="text" id="kode" name="kode" placeholder="cth: A104" value="<?php echo $kode; ?>" <?php if ($mode == "edit") { echo "readonly"; } ?>>
        <span style="color: red;"><?php echo $kodeErr; ?></span>

        <label for="lorong">Lorong</label>
        <select id="lorong" name="lorong">
            <option value="">-- Pilih --</option>
            <option value="Lorong A" <?php if ($lorong == "Lorong A") { echo "selected"; } ?>>Lorong A</option>
            <option value="Lorong B" <?php if ($lorong == "Lorong B") { echo "selected"; } ?>>Lorong B</option>
            <option value="Lorong C" <?php if ($lorong == "Lorong C") { echo "selected"; } ?>>Lorong C</option>
        </select>
        <span style="color: red;"><?php echo $lorongErr; ?></span>

        <label for="kapasitas">Kapasitas (Kg)</label>
        <input type="number" id="kapasitas" name="kapasitas" placeholder="1000" min="0" value="<?php echo $kapasitas; ?>">
        <span style="color: red;"><?php echo $kapasitasErr; ?></span>

        <label for="terisi">Terisi Saat Ini (Kg)</label>
        <input type="number" id="terisi" name="terisi" placeholder="0" min="0" value="<?php echo $terisi; ?>">
        <span style="color: red;"><?php echo $terisiErr; ?></span>

        <label for="tipe">Tipe Rak</label>
        <select id="tipe" name="tipe">
            <option value="">-- Pilih --</option>
            <option value="Pallet Rack" <?php if ($tipe == "Pallet Rack") { echo "selected"; } ?>>Pallet Rack</option>
            <option value="Shelving" <?php if ($tipe == "Shelving") { echo "selected"; } ?>>Shelving</option>
            <option value="Cold Storage" <?php if ($tipe == "Cold Storage") { echo "selected"; } ?>>Cold Storage</option>
        </select>
        <span style="color: red;"><?php echo $tipeErr; ?></span>

        <button type="button" class="batal" onclick="window.location.href='Info Lorong dan Rak.php'">Batal</button>
        <button type="submit" class="simpan">Simpan</button>
    </form>
</body>
</html>
