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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <a class="navbar-brand"><img class="logo" src="asset/img/logo.png"></a>
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
                </ul>
            </div>
            <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
        </nav>
    </div>

    <!-- Body -->
    <div class="container-fluid p-5">
        <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
            <div class="account py-3">
                <div class="col-3">
                    <img src="https://assets.website-files.com/5e51c674258ffe10d286d30a/5e53534d67293a6fe95a9616_peep-22.svg" class="card-img-top" style="max-width: 200px;">
                </div>
                <div class="col-md-5 py-3 text-black">
                    <h4>Account Information</h4>
                    <h6>Username :</h6>
                        <p><?=htmlspecialchars($fetch_data['username'])?></p>
                    <h6>Email :</h6>
                        <p><?=htmlspecialchars($fetch_data['email'])?></p>
                    <a href="logOut.php"><button class="btn">Log Out</button></a>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>

<script>
    setTimeout(function(){
            $('.preloader').slideUp();
    }, 3000);
</script>


