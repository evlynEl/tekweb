<?php

include 'config.php';

if (isset($_POST['login']))
{
    // Login
    $usermail = $email = trim($_POST['usermail']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password))
        $msg = 'Silakan isi form keseluruan';
    else
    {
        // $_SESSION['login_user'] = $username;

        setcookie('login_user', $username, time() + 3600, '/');
        header('location: home2.php');
    }


    $check_username = "SELECT id, password FROM `users` WHERE username = ? OR email = ?";
    $check_username = $con->prepare($check_username);
    $check_username->execute([ $usermail, $email ]);

    $fetch_data     = $check_username->fetch();

    if ($check_username->rowCount() == 0)
        $msg = 'Username tidak tersedia!';

    else if (!password_verify($password, $fetch_data['password']))
        $msg = 'Kata sandi yang diketik salah!';

    else
    {
        setcookie('login_user', $fetch_data['id'], time() + 3600, '/');
        header('location: home2.php');
    }
}


?>

<html>
<head>
    <title>Log In</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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

</head>
    
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top mt-3">
      <a class="navbar-brand">LOGO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item mx-5">
            <a class="nav-link active" aria-current="page" href="home2.php">Home</a>
          </li>
          <li class="nav-item mx-5">
            <a class="nav-link active" href="aboutUs.php">About Us</a>
          </li>
          <li class="nav-item mx-5">
            <a class="nav-link active" href="logIn.php">Log In</a>
          </li>
        </ul>
        <form class="d-flex px-3 mx-5" role="search">
          <input class="input form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn text-white mx-5" type="submit" id="searchBtn">Search</button>
        </form>
      </div>
      <a class="navbar-brand px-3 mx-5" href="#">GUEST</a>
    </nav>
  </div>

  <!-- Body -->
  <div class="container-fluid p-5">
    <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
      <div class="col-lg-6 col-12 d-flex flex-column justify-content-center align-items-center">
        <h2 class="text-center animate__animated animate__zoomIn">WELCOME</h2>
        <br>
        <a href="signUp.php"><button class="btn" name="login" id="landingBtn">SIGN UP <i class="arrow fa-solid fa-arrow-right"></i></button></a>
      </div>
      <div class="masuk col-lg-6 col-12 py-3 mt-5" style="text-align:justify">
        <form method="POST" class="mt-5">
          Username / Email: <input name="usermail" type="text" placeholder="Username / Email"><br/><br/>
          Password : <input name="password" type="password" placeholder="Password"><br/><br/>
          <button class="btn" name="login">LOG IN <i class="arrow fa-solid fa-arrow-right"></i></button><br/><br/>
          <div class="animate__animated animate__zoomIn">
          <?=isset($msg) ? $msg.'<br/>' : '' ?><br/>
          </div>
        </form>
      </div> 
    </div>
  </body>
</html>