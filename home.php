<?php

include 'config.php';

?>

<!DOCTYPE html>
<html>
  <!--PAGE SEBELUM LOG IN-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your interest here</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Preloader -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
<body>
    <!-- Preloader -->
    <div class="preloader"></div>
    <!-- Navbar -->
    <div class="container-fluid">
      <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
      <a class="navbar-brand"><img class="logo" src="asset/img/logo.png"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mt-3 mx-auto mb-2 mb-lg-0">
              <li class="nav-item mx-5">
                <a class="nav-link text-black active" aria-current="page" href="home.php">Home</a>
              </li>
              <li class="nav-item mx-5">
                <a class="nav-link text-black active" href="aboutUs.php">About Us</a>
              </li>
              <li class="nav-item mx-5">
                <a class="nav-link text-black active" href="logIn.php">Log In</a>
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
            </ul>
          </div>
        <a class="navbar-brand px-3 mx-5" href="#">GUEST</a>
      </nav>
    </div>

    <!-- Body -->
    <div class="container-fluid p-5">
      <!-- Login -->
      <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h2 class="landing-text text-center text-black animate__animated animate__zoomIn">DO YOU ALREADY HAVE AN ACCOUNT?</h2>
          <br>
          <a href="logIn.php"><button id="landingBtn">LOG IN <i class="fa-solid fa-arrow-right"></i></button></a>
        </div>  
      </div>
    
    <!-- Tabel -->
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

        <iframe class="fixed-bottom" width="75px" height="75px" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1190917987&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>

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