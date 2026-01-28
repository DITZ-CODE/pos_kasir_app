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
    return $newID;
}

function generateBarangID($kategori)
{
    global $conn;
}
