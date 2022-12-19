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
    <link rel="stylesheet" href="/projek/asset/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
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
                        <a class="nav-link active" aria-current="page" href="home2.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="aboutUs.php">About Us</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="logIn.php">Log In</a>
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
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    <form class="d-flex px-3" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                  </div>
                  <a class="navbar-brand">GUEST</a>
                </div>
              </nav>
              <div class="masuk text-white py-3" style="text-align: center;">
                <h1>Log In</h1><br/>
                <form method="POST">
                  Userame / Email: <input name="usermail" type="text" placeholder="Username / Email"><br/><br/>
                  Password : <input name="password" type="password" placeholder="Password"><br/><br/>
                  <button class="btn btn-light" name="login">Log In</button><br/><br/>
                  <?=isset($msg) ? $msg.'<br/>' : '' ?><br/>
                  <h6>New to ....?</h6>
                  <!-- <button class="btn btn-light" name="signup">Sign Up</button> -->
                  <a href="signUp.php" class="btn btn-light">Sign Up</button></a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>