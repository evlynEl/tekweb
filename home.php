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
                        <a class="nav-link active" href="aboutUs.php">About Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="logIn.php">Log In</a>
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
                  </div>
                  <a class="navbar-brand px-3" href="#">GUEST</a>
                 </div>
                </nav>
              </div>
              <div class="clear-head"></div>


              <div class="opening">
                <div class="col-6 p-0 text-white" style="text-align: center;">
                  <h1>Welcome!</h1>
                  <h2>"book is a window to the world"</h2>
                  <h2>Find your window to the world</h2>
                </div>
                <div class="col-6 p-0">
                  <div class="center-image" style="text-align: center;">
                    <img src="./asset/pic/112-book-morph-flat.gif" class="document" style="max-width: 200px;">
                    <img src="./asset/pic/56-document-lineal.gif" class="document" style="max-width: 200px;">
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <table class="table table-bordered table-striped table-secondary">
                  <thead class="bg-dark">
                              <tr>
                                  <th>No</th>
                                  <th>ID Buku</th>
                                  <th>Penulis</th>
                                  <th>Judul</th>
                                  <th>File</th>
                                  <th>Kategori ID</th>
                                  <th>Rating</th>
                                  <th>Action</th>
                              </tr>
                              
                              <?php
                                  $data = mysqli_query($koneksi, "SELECT * FROM `documents` ORDER BY id ASC");
                                  $no = 1;
                                  while($b = mysqli_fetch_array($data)) {
                              ?>

                              <tr>
                                  <td><?php echo $no++ ?></td>
                                  <td><?php echo $b['id'] ?></td>
                                  <td><?php echo $b['penulis'] ?></td>
                                  <td><?php echo $b['judul'] ?></td>
                                  <td><?php echo $b['file'] ?></td>
                                  <td><?php echo $b['kategori_id'] ?></td>
                                  <td><?php echo $b['rating'] ?></td>

                                  <td>
                                      
                                  </td>
                              </tr>
                      <?php
                          }
                      ?>
                      </thead>
                    </table>
              </div>
                <!-- <div class="col-6 p-0 text-white" style="text-align: center;">
                  <h1>Welcome!</h1>
                  <h2>"book is a window to the world"</h2>
                  <h2>Find your window to the world</h2>
                </div>
                <div class="col-6 p-0">
                  <div class="center-image" style="text-align: center;">
                    <img src="./asset/pic/112-book-morph-flat.gif" class="document" style="max-width: 200px;">
                    <img src="./asset/pic/56-document-lineal.gif" class="document" style="max-width: 200px;">
                  </div> -->
              
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
