<?php

include 'config.php';

if (isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    $check_email = "SELECT id FROM `users` WHERE email = ?";
    $check_email = $con->prepare($check_email);
    $check_email->execute([ $email ]);


    if (mb_strlen($username) < 4 || mb_strlen($username) > 80)
        $msg = 'Username minimal 4 dan maksimal 80 karakter.';

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $msg = 'Karakter email salah';

    else if ($check_email->rowCount() > 0)
        $msg = 'Email sudah digunakan';

    else if (mb_strlen($password) < 8 || mb_strlen($password) > 16)
        $msg = 'Sandi minimal 8 dan maksimal 16 karakter.';

    else if ($confirm != $password)
        $msg = 'Konfirmasi sandi tidak sama.';

    else
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $insert_data = "INSERT INTO `users` SET username = ?, email = ?, password = ?";
        $insert_data = $con->prepare($insert_data);
        $insert_data->execute([ $username, $email, $password_hash ]);

        if ($insert_data)
            header('location: signUp.php?msg=1');
        else
            $msg = 'Gagal daftar. Data tidak bisa diinput';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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

    <!-- Body -->
    <div class="container-fluid p-5">
        <div class="row frosted m-5 align-items-center" id="landing" style="font-family:alexandria">
            <div class="masuk text-black" style="text-align: center;">
                <h1>Sign Up</h1><br/><br/>
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1)
                        echo 'Berhasil melakukan pendaftaran.<br/><br/>';
                    ?>

                    <?=isset($msg) ? $msg.'<br/>' : '' ?>

                <form method="POST">
                    Userame : <input name="username" type="text" placeholder="Username"><br/><br/>
                    Email : <input name="email" type="email" placeholder="Email"><br/><br/>
                    Password : <input name="password" type="password" placeholder="Password"><br/><br/>
                    Re-Type Password : <input name="confirm" type="password" placeholder="Re-Type Password"><br/><br/>
                    <button class="btn btn-light" name="register">Sign Up <i class="fa-solid fa-arrow-right"></i></button><br/><br/>
                </form>
                <a href="home.php"><button class="btn">Back</button></a>
            </div>
        </div>
    </div>

    <iframe class="fixed-bottom" width="75px" height="75px" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1190917987&color=%23ff5500&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>

</body>
</html>

<script>
    setTimeout(function(){
        $('.preloader').slideUp();
    }, 3000);
</script>