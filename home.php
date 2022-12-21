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
</head>
<body>
    <div class="container-fluid">
      <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
          <a class="navbar-brand px-3">LOGO</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mt-3 mx-auto mb-2 mb-lg-0">
              <li class="nav-item mx-5">
                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
              </li>
              <li class="nav-item mx-5">
                <a class="nav-link active" href="aboutUs.php">About Us</a>
              </li>
              <li class="nav-item mx-5">
                <a class="nav-link active" href="logIn.php">Log In</a>
              </li>
          </div>
        <a class="navbar-brand px-3 mx-5" href="#">GUEST</a>
      </nav>
    </div>

    <div class="container-fluid p-5">
        <!-- Landing -->
        <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
            <div class="col-lg-6 col-12 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center animate__animated animate__zoomIn">Teknologi Web</h2>
                <br>
                <a href="logIn.php"><button id="landingBtn">LOG IN <i class="fa-solid fa-arrow-right"></i></button></a>
            </div>  
        </div

      <div class="col-md-12">
        <table class="table table-bordered table-striped table-secondary">
          <thead class="bg-dark">
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
</script>