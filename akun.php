<?php

include 'config.php';

$login_user = $_COOKIE['login_user'];


// if (!isset($_SESSION['login_user']))
if (!isset($login_user))
    header('location: logIn.php');


$fetch_data = "SELECT id, username, email FROM `users` WHERE id = ?";
$fetch_data = $con->prepare($fetch_data);
$fetch_data->execute([ $login_user ]);


// if ($fetch_data->rowCount() == 0)
//     header('location: logout.php');


$fetch_data = $fetch_data->fetch();

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
                            <a href="./upload.php" class="btn btn-light btn-outline-dark">Upload</a>
                            </div>
                            <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
                        </div>
                    </nav>
                </div>
                <div class="clear-head"></div>

                <div class="col-4 content text-white">
                    <img src="https://assets.website-files.com/5e51c674258ffe10d286d30a/5e53534d67293a6fe95a9616_peep-22.svg" class="card-img-top" style="max-width: 200px;">
                    <h4>Account information</h4>
                    <h6>Username</h6>
                        <p><?=htmlspecialchars($fetch_data['username'])?></p>
                    <h6>Email</h6>
                        <p><?=htmlspecialchars($fetch_data['email'])?></p>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>


