<?php

include 'config.php';

$login_user = $_COOKIE['login_user'];
$koneksi = mysqli_connect("localhost","root","admin","db");

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

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Animate CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Preloader -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Navbar -->
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
            <a class="navbar-brand">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mt-3 mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-5">
                        <a class="nav-link text-black active" aria-current="page" href="home2.php">Home</a>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link text-black active" href="aboutUs.php">About Us</a>
                    </li>
                    <li class="nav-item mx-5">
                        <select id="kategori" class="form-select" style="border: 0;">
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
                    <li class="nav-item mx-5">
                        <form class="d-flex px-3" role="search">
                            <input class="input form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn" type="submit" id="searchBtn">Search</button>
                        </form>
                    </li>
                    <li class="nav-item mx-5">
                        <a href="upload.php"><button class="btn" id="uploadBtn">Upload</button></a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
        </nav>
    </div>

    <!-- Body -->
    <div class="container-fluid p-5">
        <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
            <h3 class="doc fixed-top">Daftar Dokumen</h3>
            <table class="table fixed-top mt-5">
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Penulis</th>
                        <th>Judul</th>
                        <th>File</th>
                        <th>Kategori ID</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                    
                    
                </thead>
                <tbody id="output-ajax">


                </tbody>
            </table>
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

    setTimeout(function(){
        $('.preloader').slideUp();
    }, 3000);
</script>


