<?php
include "config.php";
$koneksi = mysqli_connect("localhost","db","root");

$id = $_GET['id'];

$pilih = mysqli_query($koneksi, "SELECT * FROM documents WHERE id = '$id'");
$data = mysqli_fetch_array($pilih);
$dokumen = $data['file'];
unlink("./berkas/". $dokumen);
mysqli_query($koneksi, "DELETE FROM documents WHERE id='$id'");


?>

 <div class="d-grid gap-2 col-3 mx-auto">
    <a href="home2.php"><button class="btn">Back</button></a>
</div>