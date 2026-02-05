<?php

require "../config/config.php";


if (isset($_POST['daftarMember'])) {
    $namaMember = mysqli_real_escape_string($conn, $_POST['namaMember']);
    $jkMember = mysqli_real_escape_string($conn, $_POST['jkMember']);
    $tglLahirMember = mysqli_real_escape_string($conn, $_POST['tglLahirMember']);
    $noHpMember = mysqli_real_escape_string($conn, $_POST['noHpMember']);
    $idMember = generateMemberID();

    $queryInsertMember = "INSERT INTO member (idMember, namaMember, jkMember, tglLahirMember, noHpMember) values ('$idMember', '$namaMember', '$jkMember', '$tglLahirMember', '$noHpMember')";
    $insertMember = mysqli_query($conn, $queryInsertMember);
    if ($insertMember && mysqli_affected_rows($conn) > 0) {
        $queryMsg = "Insert member berhasil!";
    } else {
        $queryMsg = "Insert member gagal!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Member | POS KASIR</title>
</head>

<body>
    <h1>Tambah Member Baru</h1>
    <form action="" method="post">
        <label for="nama">Nama Member : </label>
        <input type="text" id="nama" name="namaMember" placeholder="Nama Member" required>
        <label for="jk">Jenis Kelamin : </label>
        <select name="jkMember" id="jk" required>
            <option value="" selected disabled>-- Pilih Jenis Kelamin</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
            <option value="DLL">Lainnya</option>
        </select>
        <label for="tglLahir">Tanggal Lahir : </label>
        <input type="date" required id="tglLahir" name="tglLahirMember">
        <label for="noHp">No Telepon : </label>
        <input type="number" id="noHp" required name="noHpMember" placeholder="Nomor Telepon">
        <button type="submit" name="daftarMember">Daftar Member</button>
    </form>

    <?php if (isset($queryMsg)) {
        echo $queryMsg;
    } ?>
</body>

</html>