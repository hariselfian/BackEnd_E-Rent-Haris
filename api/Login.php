<?php
header('Content-Type: application/json');
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $response = [];

    $cari_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tb_user` WHERE `username` = '$username' AND `password` = '$password'"));


    if (!empty($cari_user)) {
        $idU = $cari_user['id_user'];
        $stor = mysqli_query($con, "SELECT * FROM `tb_store` WHERE `id_user`='$idU'");
        $cari_store= mysqli_fetch_assoc($stor);

        if(!empty($cari_store)){
            unset($cari_user['password']);
            $response["status"] = 1;
            $response['store'] = $cari_store['id_store'];
            $response["message"] = "Data tersedia";
            $response["data"] = $cari_user;   
        }else{
            unset($cari_user['password']);
            $response["status"] = 2;
            $response["message"] = "Data tersedia";
            $response["data"] = $cari_user;   
        }
    } else {
        $response["status"] = 0;
        $response["message"] = "Data tidak tersedia = ".$username;
    }
} else {
    $response = [];
    $response["status"] =  0;
    $response["message"] = "Not Found!!! = ".$username;
}
mysqli_close($con);
echo json_encode($response);
?>