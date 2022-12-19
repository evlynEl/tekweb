<h3>Your Document(s)</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Kode Dokumen</th>
        <th>Nama Dokumen</th>
        <th colspan="12">Aksi</th>
    </tr>

    <?php
        include "config.php";

        $no=1;
        $ambildata = mysqli_query($koneksi, "SELECT * FROM dokumen");
        while ($tampil = mysqli_fetch_array($ambildata)){
            echo "
                <tr>
                    <td>$no</td>
                    <td>$tampil[id]</td>
                    <td>$tampil[file]</td>
                    <td><a href='?kode=$tampil[id]'> Hapus </a></td>
                    <td>Ubah</td>
                </tr>";
            $no++;
        }
    ?>
</table>


<?php
if(isset($_GET['kode'])){

    mysqli_query($koneksi,"DELETE FROM dokumen WHERE id='$_GET[kode]'");

    echo "Data telah terhapus";
    echo "<meta http-equev=refresh content=2;URL='delete-document.php'>";
}
?>