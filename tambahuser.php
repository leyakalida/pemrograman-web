<?php

require_once "core/init.php";

$error = '';

// redirect kalau user sudah register
// if(isset($_SESSION['user'])) header('Location: index.php');

//validasi register
if(isset($_POST['submit'])){
    $nama = $_POST['username'];
    $pass = $_POST['password'];
    $nm_lengkap = $_POST['nm_lengkap'];

    if(!empty(trim($nama)) && !empty(trim($pass)) && !empty(trim($nm_lengkap))){
        if(cek_nama($nama) == 0){
            //masukkan ke database
            if(register_user($nama, $pass, $nm_lengkap)) ;
            else $error =  'gagal';
        }else $error =  'nama sudah ada, tidak bisa daftar';

    }else $error =  'Tidak Boleh Kosong';       
}

require_once "view/header.php";

?>