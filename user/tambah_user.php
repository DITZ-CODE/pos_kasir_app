<?php
require("backend/config.php");

if (isset($_POST["daftar"])) {
    $nama = mysqli_real_escape_string($conn, $_POST["namaUser"]);
    $password = mysqli_real_escape_string($conn, $_POST["passwordUser"]);
    $level = mysqli_real_escape_string($conn, $_POST["levelUser"]);
    $userID = generateUserID($level);

    if (isset($nama, $password, $level) && empty($nama)) {
    }

    $hashPassword = password_hash($password, PASSWORD_BCRYPT);

    $queryInsert = "INSERT INTO user (idUser, namaUser, passwordUser, levelUser) values ('$userID' , '$nama', '$hashPassword', '$level')";

    $insertUser = mysqli_query($conn, $queryInsert);
    if ($insertUser && mysqli_affected_rows($conn) > 0) {
        $queryMsg = "Insert berhasil!";
    } else {
        $queryMsg = "Insert data gagal!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User | POS KASIR</title>
</head>

<body>
    <h1>Tambah User</h1>
    <form action="" method="POST">
        <label for="nama">Nama : </label>
        <input type="text" id="nama" name="namaUser" placeholder="Nama User">
        <label for="password">Password : </label>
        <input type="password" id="password" name="passwordUser" placeholder="Password User">
        <label for="level">Sebagai : </label>
        <select name="levelUser" id="level">
            <option value="" selected disabled>-- Pilih level</option>
            <option value="Admin">Admin</option>
            <option value="Kasir">Kasir</option>
        </select>
        <button type="submit" name="daftar">Daftar</button>
    </form>
    <?php echo (isset($queryMsg)) ? $queryMsg : "" ?>
</body>

</html>