<?php
require_once "core/init.php";

require_once "view/header.php";

$query = mysqli_query($link, "SELECT * FROM tb_barang");
$error = '';

if (isset($_POST['simpan'])){
    $id = $_POST['id'];
    $jumlah = $_POST['jumlah'];
    $user = $_SESSION['user'];
    $tgl = $_POST['tgl'];

    $sql = "INSERT INTO tb_transaksi_keluar (id_barang, jumlah, username, tgl) VALUES ('$id', '$jumlah', '$user', '$tgl')";

    if (mysqli_query($link, $sql)) {
        $stok_old = mysqli_query($link, "SELECT jumlah FROM tb_barang WHERE id='$id'");
        $peng = mysqli_fetch_assoc($stok_old);
        $stok_new = (int)$peng['jumlah'] - $jumlah;

        mysqli_query($link, "UPDATE tb_barang SET jumlah='$stok_new' WHERE id='$id'");
        header("location: brgkeluar.php"); 
    }else{
            echo "terjadi kesalahan";
        }
    }
    ?>