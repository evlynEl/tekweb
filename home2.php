<?php

include 'config.php';

$login_user = $_COOKIE['login_user'];


// if (!isset($_SESSION['login_user']))
if (!isset($login_user))
    header('location: logIn.php');


$fetch_data = "SELECT id, username, email FROM `users` WHERE id = ?";
$fetch_data = $con->prepare($fetch_data);
$fetch_data->execute([ $login_user ]);


if ($fetch_data->rowCount() == 0)
    header('location: logout.php');


$fetch_data = $fetch_data->fetch();


// $update_email = "evelyn123@gmail.com";
// $update_data = "UPDATE `users` SET email = ? WHERE id = ?";
// $update_data = $con->prepare($update_data);
// $update_data->execute([ $update_email, $fetch_data['id']]);

// setcookie('login_user', $update_email, time() + 3600, '/');

// if ($update_data)
//     echo 'Data berhasil diperbarui';
// else
//     echo 'Data gagal diperbarui';


// $delete_data = "DELETE FROM `users` WHERE id = ?";
// $delete_data = $con->prepare($delete_data);
// $delete_data->execute([ 4 ]);

// if ($delete_data)
//     echo 'Data berhasil dihapus';
// else
//     echo 'Data gagal dihapus';

?>

<!DOCTYPE html>
<html>
  <!--PAGE SETELAH LOG IN-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Find what you're looking here</title>

        <link rel="stylesheet" href="/projek/asset/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        
        <!--gambar-->
        <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
    </head>
    <body>
        <div class="full-site bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-3">
                        <nav class="navbar navbar-expand-lg bg-light">
                            <div class="container-fluid">
                                <a class="navbar-brand">LOGO</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="home2.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <select id="kategori" class="form-select bg-light" style="border: 0;">
                                                <option value="">Kategori</option>
                                                
                                                <?php 
                                            
                                                $list_kategori = "SELECT * FROM `kategori` ORDER BY category_name ASC";
                                                $list_kategori = $con->prepare($list_kategori);
                                                $list_kategori->execute();
                                                
                                                while($kategori = $list_kategori->fetch()): ?>

                                                <option value="<?=$kategori['category_id']?>"><?=$kategori['category_name']?></option>

                                                <?php endwhile ?>
                                            </select>
                                        </li>
                                    </ul>
                                    <form class="d-flex px-3" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-dark" type="submit">Search</button>
                                    </form>
                                    <a href="upload.php" class="btn btn-light btn-outline-dark">Upload</a>
                                </div>
                                <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
                            </div>
                        </nav>
                    </div>
                    <div class="clear-head"></div>

                    <div class="col-md-12 py-3">
                        <h3 class="text-white">Daftar Dokumen</h3>
                        <table class="table table-bordered table-striped table-secondary">
                            <thead class="bg-dark ">
                                <tr>
                                    <td>Penulis</td>
                                    <td>Judul</td>
                                    <td>Rating</td>
                                </tr>
                            </thead>
                            <tbody id="output-ajax">

                            </tbody>
                        </table>
                    </div>
                            
                </div> 
            </div> 
        </div>
    </body>
</html>

<script>
        $(function() 
        {
            const showDataCategory = (id) => 
            {
                $.ajax({
                    url: 'list_ajax.php',
                    type: 'POST',
                    data: 'kategori=' + id + '&get_ajax=true',
                    success: function(output) 
                    {
                        if (output == -1)
                            alert('Tidak ada data yang ditampilkan')
                        // <?php
                        //     // tampilin semua  data 
                        //     $check_data = "SELECT penulis, judul, rating FROM `documents` ORDER BY judul ASC";
                        //     $check_data = $con->prepare($check_data);
                        //     $check_data->execute();

                        //     if ($check_data->rowCount() == 0)
                        //         echo -1;
                        //     else
                        //     {
                        //         while($document = $check_data->fetch())
                        //         {
                        //             echo '<tr>';
                        //             echo '<td>'.$document['penulis'].'</td>';
                        //             echo '<td>'.$document['judul'].'</td>';
                        //             echo '<td>'.$document['rating'].'</td>';
                        //             echo '</tr>';
                        //         }
                        //     }
                        // ?>
                    

                        else
                            $('#output-ajax').html(output)
                    },
                    error: function(e) {
                        alert('Terjadi kesalahan saat load data');
                    }
                })
            }


            $('#kategori').change(function(e) 
            {
                const id = $(this).val()
                showDataCategory(id)
            })
        })
</script>


