<?php
include "../config/config.php";

$queryGetKategori = "SELECT * FROM kategori";
$getDataKategori = mysqli_query($conn, $queryGetKategori);

if (isset($_POST['tambahBarang'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['namaBarang']);
    $kode = mysqli_real_escape_string($conn, $_POST['kodeBarang']);
    $harga = mysqli_real_escape_string($conn, $_POST['hargaBarang']);
    $stok = mysqli_real_escape_string($conn, $_POST['stokBarang']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategoriBarang']);
    $idBarang = generateBarangID($kategori);

    $queryInsertBarang = "INSERT INTO barang (idBarang, namaBarang, kodeBarang, hargaBarang, stokBarang, kategoriBarangID) VALUES ('$idBarang', '$nama', '$kode', '$harga', '$stok', '$kategori')";
    $insertBarang = mysqli_query($conn, $queryInsertBarang);

    if ($insertBarang && mysqli_affected_rows($conn) > 0) {
        $queryMsg = "Insert barang berhasil!";
    } else {
        $queryMsg = "Insert gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang | POS KASIR</title>
</head>

<body>
    <h1>Tambah Barang</h1>
    <form action="" method="POST">
        <label for="nama">Nama Barang :</label>
        <input type="text" name="namaBarang" id="nama" placeholder="Nama Barang" required>
        <label for="kode">Kode Barang :</label>
        <input type="text" name="kodeBarang" id="kode" placeholder="Kode Barang" required>
        <label for="harga">Harga Barang :</label>
        <input type="number" name="hargaBarang" id="harga" placeholder="Harga Barang" required>
        <label for="stok">Stok Barang :</label>
        <input type="number" name="stokBarang" id="stok" placeholder="Stok Barang" required>
        <label for="kategori">Kategori :</label>
        <select name="kategoriBarang" id="kategori">
            <option value="" disabled selected>-- Pilih Kategori</option>
            <?php
            while ($resultKategori = mysqli_fetch_assoc($getDataKategori)) {
            ?>
                <option value="<?= $resultKategori['idKategori'] ?>"><?= $resultKategori['namaKategori'] ?></option>
            <?php
            }
            ?>
        </select>

        <button type="submit" name="tambahBarang">Tambah</button>
    </form>

    <?php if (isset($queryMsg)) : ?>
        <p><?= $queryMsg ?></p>
    <?php endif; ?>
</body>

</html>