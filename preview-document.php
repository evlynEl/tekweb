<h3>Your Document(s)</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Kode Dokumen</th>
        <th>Nama Dokumen</th>
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
                </tr>";
            $no++;
        }
    ?>
</table>