<?php

session_start();

$localhost = "localhost";
$name = "root";
$password = "";
$db_name = "db_toko";

$conn = mysqli_connect($localhost, $name, $password, $db_name);

if (!$conn) {
    echo "Koneksi gagal!";
}

function generateRandomChars($length)
{
    $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ23456789";
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, strlen($chars) - 1);
        $result .= $chars[$index];
    }

    return $result;
}


function generateUserID($level)
{
    global $conn;

    $kodeLevel = ($level == "Admin") ? "adm" : "ksr";

    $getLastNumber = "SELECT idUser FROM user WHERE levelUser = '$level' ORDER BY idUser DESC LIMIT 1";
    $query = mysqli_query($conn, $getLastNumber);
    $resultID = mysqli_fetch_assoc($query);

    if ($resultID) {
        $lastNumber = (int) substr($resultID["idUser"], -3);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $newID = "usr-" . $kodeLevel . "-" . str_pad($newNumber, 3, "0", STR_PAD_LEFT);
    return strtoupper($newID);
}

function generateBarangID($kategori)
{
    // brg-smbk-001
    global $conn;

    $queryKodeKategori = "SELECT kodeKategori FROM kategori WHERE idKategori = '$kategori'";
    $getKodeKategori = mysqli_query($conn, $queryKodeKategori);
    $kodeKategori = mysqli_fetch_assoc($getKodeKategori)['kodeKategori'];
    $getLastNumber = "SELECT idBarang FROM barang WHERE kategoriBarangID = '$kategori' ORDER BY idBarang DESC LIMIT 1";
    $query = mysqli_query($conn, $getLastNumber);
    $resultID = mysqli_fetch_assoc($query);

    if ($resultID) {
        $lastNumber = (int) substr($resultID['idBarang'], -3);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $newID = "brg-" . $kodeKategori . "-" . str_pad($newNumber, 3, "0", STR_PAD_LEFT);
    return strtoupper($newID);
}

function generateMemberID()
{
    global $conn;
    // MEM-20260205-ZXGH2
    $currentDate = date("Ymd");
    do {
        $randomChars = generateRandomChars(5);
        $newID = "MEM-" . $currentDate . "-" .  $randomChars;

        $queryCekID = "SELECT 1 FROM member WHERE idMember = '$newID'";
        $cekId = mysqli_query($conn, $queryCekID);
    } while (mysqli_num_rows($cekId) > 0);
    return $newID;
}
