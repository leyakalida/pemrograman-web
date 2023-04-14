<?php
require_once "core/init.php";

$error = '';

if(!$_SESSION['user']){
    header('Location: login.php');
}



$error = '';
$id    = $_GET["id_barang"];

if(isset($_GET["id_barang"])){
    $bio = tampilkan_per_id($id);
    while($row = mysqli_fetch_assoc($bio)){
        $kategori_awal = $row["id_kategori"];
        $nama_awal     = $row["nama"];
        $img_awal      = $row["gambar"];
        $harga_awal    = $row["harga"];
        $jumlah_awal   = $row["jumlah"];
        $target_awal   = "gambar/".basename($img_awal);
    }
}

if(isset($_POST["submit"])){
    $kategori = $_POST["id_kategori"];
    $nama     = $_POST["nama"];
    $img      = $_FILES["gambar"]["name"];
    $target   = "gambar/".basename($img);
    $harga    = $_POST["harga"];
    $jumlah   = $_POST["jumlah"];

    if(!empty(trim($kategori)) && !empty(trim($nama)) && !empty(trim($img)) && !empty(trim($harga)) && !empty(trim($jumlah)) ){

        if(edit_data($kategori, $nama, $img, $harga, $jumlah, $id)){
            header('Location: index.php');
        }else{              
            $error = 'ada masalah saat update data';
        }
    }else{
        $error = 'data harus di isi';
    }
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $message[] = "image uploded succes";
    }else{
        $message[] = "there was a problem uploding image";
    }
}

// $id = $_GET["id_barang"];
// if(isset($_POST["submit"])) {
//     // $id = $_GET["id"];
//     $name = $_POST["nama"];
//     $harga = $_POST["harga"];
//     $kategori = $_POST["id_kategori"];
//     $gambar = $_FILES["gambar"]["name"];
//     $gambar_tmp = $_FILES["gambar"]["tmp_name"];
//     $gambar_baru = date('dmYHis').$gambar;
//     $lokasi = "../img/".$gambar_baru;
//     move_uploaded_file($gambar_baru, $lokasi);

//     if(move_uploaded_file($gambar_tmp, $lokasi)) {
//         $query = mysqli_query($link, "SELECT * FROM tb_barang WHERE id_barang = $id");
//         $data = mysqli_fetch_array($query);
//         if(is_file("../img/".$data['gambar']))
//             unlink("../img/".$data['gambar']);
//     }
        
    
//     $hasil = mysqli_query($link, "UPDATE `tb_barang` SET `id_kategori` = '$kategori', `nama_barang`= '$name',`harga`= '$harga', `gambar`= '$gambar_baru' WHERE id_barang = '$id'");
//     header("Location: index.php");
// }

require_once "view/header.php";
?>

<?php

    // $hasil = mysqli_query($link, "SELECT * FROM tb_barang WHERE id_barang = $id");
    // while($data_brg = mysqli_fetch_array($hasil)) {
    //     // echo '<pre>';
    //     // var_dump($data_brg);
    //     // echo '</pre>';
    //     $kategori = $data_brg["id_kategori"];
    //     $name = $data_brg["nama"];
    //     $harga = $data_brg["harga"];
    // }
?>

<br>
<div class="edit">
<h1>Edit Barang</h1>

<form action="" method="post" enctype="multipart/form-data">
<label for="">Kategori</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select id="kategori" name="id_kategori"><br><br>
<?php
    $hasil = mysqli_query($link, "SELECT * FROM tb_kategori");
    while($data = mysqli_fetch_assoc($hasil)){
        ?>
        <option value="<?= $data['id'] ?>"><?= $data['nama_kt'] ?></option>
        <?php
    }
    ?>
    <br>
    <label for="nama">Nama</label><br>
    <input type="text" name="nama" value="<?= $nama_awal;?>"><br><br>

    <label for="gambar">Gambar</label><br>
    <input type="file" name="gambar" value="<?= $target_awal;?>"><br><br>

    <label for="harga">Harga</label><br>
    <input type="text" name="harga" value="<?= $harga_awal;?>"><br><br>

    <label for="hobi">Jumlah</label><br>
    <input type="text" name="jumlah" value="<?= $jumlah_awal;?>"><br><br>

    <div id="error"><?= $error ?></div><br>

    <input type="submit" name="submit" value="Submit">
</form>
</div>