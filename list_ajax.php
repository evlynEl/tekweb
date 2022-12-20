<?php

include 'config.php';

if (isset($_POST['get_ajax']))
{
    $id_kategori = $_POST['kategori'];

    // tampilin data berdasarkan kategori
    $check_data = "SELECT penulis, judul, rating FROM `documents` WHERE kategori_id = ? ORDER BY judul ASC";
    $check_data = $con->prepare($check_data);
    $check_data->execute([ $id_kategori ]);

    if ($check_data->rowCount() == 0)
        echo -1;
    else
    {
        while($document = $check_data->fetch())
        {
            echo '<tr>';
            echo '<td>'.$document['penulis'].'</td>';
            echo '<td>'.$document['judul'].'</td>';
            echo '<td>'.$document['rating'].'</td>';
            echo '</tr>';
        }
    }
}

if (isset($_POST['tambah_doc']))
{
    $penulis = $_POST['penulis'];
    $judul = $_POST['judul'];
    $kategori_id = $_POST['kategori'];

    $insert_data = "INSERT INTO `documents` SET penulis = ?, judul = ?, kategori_id = ?";
    $insert_data = $con->prepare($insert_data);
    $insert_data->execute([
        $penulis,
        $judul,
        $kategori_id
    ]);


    if (!$insert_data)
        echo -1;
    else
        echo 'sukses';
}
?>