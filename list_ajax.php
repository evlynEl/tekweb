<?php

include 'config.php';

if (isset($_POST['get_ajax']))
{
    $id_kategori = $_POST['kategori'];

    if($id_kategori != null){
        // tampilin data
        $check_data = "SELECT id, penulis, judul, file, kategori_id, rating FROM `documents` WHERE kategori_id = ? ORDER BY id ASC";
        $check_data = $con->prepare($check_data);
        $check_data->execute([ $id_kategori ]);

        if ($check_data->rowCount() == 0)
            echo -1;
        else
        {
            while($document = $check_data->fetch())
            {
                echo '<tr>';
                echo '<td>'.$document['id'].'</td>';
                echo '<td>'.$document['penulis'].'</td>';
                echo '<td>'.$document['judul'].'</td>';
                echo '<td>'.$document['file'].'</td>';
                echo '<td>'.$document['kategori_id'].'</td>';
                echo '<td>'.$document['rating'].'</td>';
                echo '<td><a href="dokumen-det.php?id='.$b['id'].'" class="btn btn-warning" title="Lihat Dokumen" style="box-shadow: 4px 2px 2px #888888;">Open</a></td>';
                        //logo mata
                        //.<img src="../asset/pic/mata.jpeg">;
                echo '</tr>';
            }
        }
    }
    else{
        $check_data = "SELECT * FROM `documents` ORDER BY id ASC";
        $check_data = $con->prepare($check_data);
        $check_data->execute();
    
        if ($check_data->rowCount() == 0)
            echo -1;
        else
        {
            while($document = $check_data->fetch())
            {
                echo '<tr>';
                echo '<td>'.$document['id'].'</td>';
                echo '<td>'.$document['penulis'].'</td>';
                echo '<td>'.$document['judul'].'</td>';
                echo '<td>'.$document['file'].'</td>';
                echo '<td>'.$document['kategori_id'].'</td>';
                echo '<td>'.$document['rating'].'</td>';
                echo '</tr>';
            }
        }
    }
}


if (isset($_POST['tambah_doc']))
{
    $penulis = $_POST['penulis'];
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori'];
    $file = $_POST['proses'];

    $insert_data = "INSERT INTO `documents` SET penulis = ?, judul = ?, kategori_id = ?, file = ?";
    $insert_data = $con->prepare($insert_data);
    $insert_data->execute([
        $penulis,
        $judul,
        $kategori_id,
        $file
    ]);


    if (!$insert_data)
        echo -1;
    else
        echo 'sukses';
}
?>