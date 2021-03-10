<?php
require_once('koneksi.php');
header('Content-Type: application/json');
class emp
{
}

$id = $_POST['id'];

$query = "DELETE FROM `tb_barang` WHERE `tb_barang`.`id_barang` = '$id'";

$ad = mysqli_query($con, $query);
if ($ad) {
    $res = new emp();
    $res->message = "Sukses Hapus";
    $res->coode = "1";
    die(json_encode($res));
} else {
    $res = new emp();
    $res->message = "Gagal Hapus";
    $res->coode = "0";
    die(json_encode($res));
}

mysqli_close($con);
