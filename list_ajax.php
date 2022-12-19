<?php
include 'config.php';

if (isset($_POST['get_ajax']))
{
    $id_kategori = $_POST['kategori'];

    // tampilin data
    $check_data = "SELECT penulis, judul, kategori, rating FROM `documents` WHERE kategori_id = ? ORDER BY judul ASC";
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
            echo '<td>'.$document['kategori'].'</td>';
            echo '<td>'.$document['rating'].'</td>';
            echo '</tr>';
        }
    }
}
?>