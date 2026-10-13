<?php
    include "koneksi.php";

    $hasil = mysqli_query($koneksi, "SELECT * FROM rak ORDER BY kode ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorong dan Rak</title>
    <link rel="stylesheet" href="Info Lorong dan Rak.css">
</head>
<body>
    <h1>Daftar Lorong Rak</h1>
    <p class="inpo">Lorong Utama A, B, dan C</p>

    <a class="klik" href="Tambah Rak.php">+ Tambah Rak</a>

    <table>
    <tr>
      <th>Kode Rak</th>
      <th>Lorong</th>
      <th>Kapasitas</th>
      <th>Status</th>
      <th>Barang</th>
      <th>Aksi</th>
    </tr>

    <?php while ($rak = mysqli_fetch_assoc($hasil)) { ?>
        <?php
            // Tentukan status berdasarkan isi rak
            if ($rak["terisi"] >= $rak["kapasitas"]) {
                $status = "Penuh";
                $kelas = "sayangnyapenuh";
            } else if ($rak["terisi"] >= 0.8 * $rak["kapasitas"]) {
                $status = "Hampir Penuh";
                $kelas = "hampirbanget";
            } else {
                $status = "Tersedia";
                $kelas = "adakok";
            }
        ?>
    <tr>
      <td><?php echo $rak["kode"]; ?></td>
      <td><?php echo $rak["lorong"]; ?></td>
      <td><?php echo $rak["terisi"]; ?> / <?php echo $rak["kapasitas"]; ?> kg</td>
      <td class="<?php echo $kelas; ?>"><?php echo $status; ?></td>
      <td><?php echo $rak["tipe"]; ?></td>
      <td class="aksi">
        <a class="tombol-edit" href="Tambah Rak.php?kode=<?php echo $rak["kode"]; ?>">✏️ Edit</a>
        <a class="tombol-hapus" href="Hapus Rak.php?kode=<?php echo $rak["kode"]; ?>" onclick="return confirm('Yakin mau hapus rak ini?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php } ?>

    </table>
</body>
</html>
