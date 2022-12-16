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

<html>
    <head>
        <title>Sign Up</title>
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

                <div class="masuk text-white" style="text-align: center;">
                    <h1>Sign Up</h1><br/><br/>
                    <form method="POST">
                        Userame : <input name="username" type="text" placeholder="Username"><br/><br/>
                        Email : <input name="email" type="email" placeholder="Email"><br/><br/>
                        Password : <input name="password" type="password" placeholder="Password"><br/><br/>
                        Re-Type Password : <input name="confirm" type="password" placeholder="Re-Type Password"><br/><br/>
                        <button class="btn btn-light" name="register">Submit</button><br/><br/>

                        <?php

                        if (isset($_GET['msg']) && $_GET['msg'] == 1)
                            echo 'Berhasil melakukan pendaftaran.<br/><br/>';
                        
                        ?>

                        <?=isset($msg) ? $msg.'<br/>' : '' ?>
                        <?= "Kembali ke halaman <a href='logIn.php' class='btn btn-light'>Log In</button></a>"?>

                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>