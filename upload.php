<?php

include 'config.php';

$login_user = $_COOKIE['login_user'];


// if (!isset($_SESSION['login_user']))
if (!isset($login_user))
    header('location: logIn.php');


$fetch_data = "SELECT username FROM `users` WHERE id = ?";
$fetch_data = $con->prepare($fetch_data);
$fetch_data->execute([ $login_user ]);


// if ($fetch_data->rowCount() == 0)
//     header('location: logout.php');


$fetch_data = $fetch_data->fetch();

$koneksi = mysqli_connect("localhost","root","","db");

if(isset($_POST['proses'])){
    $direktori = "berkas/";
    $file_name = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'],$direktori.$file_name);
    mysqli_query($koneksi, "insert into dokumen set file='$file_name'");
    
    echo "<b>File berhasil diupload";
}
?>

<!DOCTYPE html>
<html>
  <!--PAGE SETELAH LOG IN-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload a document</title>
        <link rel="stylesheet" href="/projek/asset/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://browser.sentry-cdn.com/7.27.0/bundle.min.js"></script>

        <!--gambar-->
        <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
        <!-- CSS untuk upload file buttonnya -->
        <style>
            label{
                display: inline-block;
                background-color: indigo;
                color: white;
                padding: 0.5rem;
                font-family: sans-serif;
                border-radius: 0.3rem;
                cursor: pointer;
                margin-top: 1rem;
            }

            #file-chosen{
                margin-left: 0.3rem;
                font-family: sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="full-site bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 py-3">
                    <nav class="navbar navbar-expand-lg bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand">LOGO</a>
                            <button class="navbar-toggler" type="button">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./home2.php">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                                </li>
                            </ul>
                            <form class="d-flex px-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-dark" type="submit">Search</button>
                            </form>
                            <button class="btn btn-outline-dark" type="submit">Upload</button>
                            </div>
                            <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
                        </div>
                    </nav>
                </div>
                <div class="clear-head"></div>

                <div class="my-5 text-white bg-dark" style="margin: auto;text-align:center;height:auto;">
                    <h3>Publish to the world</h3>
                    <p>Research paper, article, document, etc</p>
                    <div class="box bg-dark" style="border: solid 1px white; border-style:dashed; width:500px; height:150px; margin: auto;text-align:center">
                        <!-- <a href="./upload.php" class="btn btn-light btn-outline-dark" style="position: absolute; top:50%;left:50%; transform: translate(-50%, -300%);">Select Documents</a> -->

                        <!-- Form terbaru -> desain pakai CSS dan langsung tampil nama file yg akan diupload -->
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" id="upload-btn" name="NamaFile" hidden/>
                        <label for="upload-btn">Select Documents</label>
                        <br>
                        <span id="file-chosen">No file chosen</span>
                        <br>
                        <input type="submit" name="proses" value="Upload">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>

<script>
    const actualBtn = document.getElementById('upload-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    })
</script>

