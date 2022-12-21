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

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST["id"];
    $rating = $_POST["rating"];
 
    $sql = "UPDATE documents SET rating = $rating WHERE id = $id";
    if (mysqli_query($conn, $sql))
    {
        echo "New Rate addedddd successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

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
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./home2.php">Home</a>
                                </li>                                
                            </ul>
                            <form class="d-flex px-3" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-dark" type="submit">Search</button>
                            </form>
                            </div>
                            <a class="navbar-brand px-3" href="./akun.php"><?=htmlspecialchars($fetch_data['username'])?></a>
                        </div>
                    </nav>
                </div>
                <div>
                    <form action="add_rate.php" method="post">
                        <div class=" col- 4 rateyo" id= "rating"
                            data-rateyo-rating="4"
                            data-rateyo-num-stars="5"
                            data-rateyo-score="3">
                        </div>
                            <span class='result text-white'>0</span>
                            <input type="hidden" name="rating">
                        </div>
                        <div><input type="submit" name="add"> </div>
                    </form>
                </div>       
            </div>
        </div>
        </div>
    </body>
</html>

<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text(rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
</script>