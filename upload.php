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
    $penulis = $_POST['penulis'];
    $judul = $_POST['judul'];
    // $kategori_id = $_POST['kategori_id'];
    $file_name = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'],$direktori.$file_name);
    mysqli_query($koneksi, "insert into documents(penulis, judul, file) 
        values('$penulis', '$judul', '$file_name')");
    // mysqli_query($koneksi, "insert into documents set file='$file_name'");

    // pengecekan ketika error terjadi dan menampilkan persan errornya
    if ($_FILES["NamaFile"]["error"] !== UPLOAD_ERR_OK) {

        switch ($_FILES["NamaFile"]["error"]) {
            case UPLOAD_ERR_PARTIAL:
                exit('File only partially uploaded');
                break;
            case UPLOAD_ERR_NO_FILE:
                exit('No file was uploaded');
                break;
            case UPLOAD_ERR_EXTENSION:
                exit('File upload stopped by a PHP extension');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                exit('File exceeds MAX_FILE_SIZE in the HTML form');
                break;
            case UPLOAD_ERR_INI_SIZE:
                exit('File exceeds upload_max_filesize in php.ini');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                exit('Temporary folder not found');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                exit('Failed to write file');
                break;
            default:
                exit('Unknown upload error');
                break;
        }
    }
    // Pesan yang muncul ketika upload berhasil
    $msg = "<b>File berhasil diupload</b>";

}
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
    <script src="https://browser.sentry-cdn.com/7.27.0/bundle.min.js"></script>
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
            <a class="navbar-brand">LOGO</a>
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
            <h3 class="text-center">Publish to the world</h3>
            <p class="text-center">Research paper, article, document, etc</p>

            <?=isset($msg) ? '<div class="alert alert-success">'.$msg.'</div>' : ''?>

            <div class="col-md-4" style="margin: auto;text-align:center">
                <form method="post" id="form-tambah" enctype="multipart/form-data">
                    <p>Penulis</p>
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis"><br />
                    <p>Judul</p>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul"><br />
                    <p>Kategori</p>
                        <select id="kategori" class="form-select">
                            <option value="">-- Pilih kategori: --</option>
                                
                            <?php 
                            
                            $list_kategori = "SELECT * FROM `kategori` ORDER BY category_name ASC";
                            $list_kategori = $con->prepare($list_kategori);
                            $list_kategori->execute();
                            
                            while($kategori = $list_kategori->fetch()): ?>

                            <option value="<?=$kategori['category_id']?>"><?=$kategori['category_name']?></option>

                            <?php endwhile ?>
                        </select> 
                    <!--upload file-->
                    <input type="file" id="upload-btn" name="NamaFile" hidden/>
                    <label for="upload-btn">Select Documents</label>
                    <br>
                    <span id="file-chosen">No file chosen</span>
                    <br>                               
                </form>
            </div>
            <br>
                        <!-- Form terbaru -> desain pakai CSS dan langsung tampil nama file yg akan diupload -->
                        <!-- <form action="" method="POST" enctype="multipart/form-data">                            
                            <input type="file" id="upload-btn" name="NamaFile" hidden/>
                            <label for="upload-btn">Select Documents</label>
                            <br>
                            <span id="file-chosen">No file chosen</span>
                            <br>
                        
                        </form> -->
                    
            <br>
            <div class="d-grid gap-2 col-3 mx-auto">
                <!-- <button class="btn btn-outline-light" type="submit">Upload</button> -->
                <input type="submit" name="proses" value="Upload" class="btn btn-light">
                <a href="home2.php"><button class="btn">Back</button></a>
            </div>
        </div>
    </body>
</html>

<script>
    const actualBtn = document.getElementById('upload-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    });


    const actualBtn = document.getElementById('upload-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
        fileChosen.textContent = this.files[0].name
    });


    $(function() {
        $('#kategori').change(function(e) 
        {
            const id = $(this).val()
            showDataCategory(id)
        })


        $("#form-tambah").submit(function(e) 
        {
            e.preventDefault();

            const formData = $(this).serialize();
            const id = $('#kategori').val()

            $.ajax({
                url: 'list_ajax.php',
                type: 'POST',
                data: formData + '&kategori=' + id + '&tambah_doc=true',
                success: function(output) 
                {
                    if (output == -1)
                        alert('Gagal diinput')

                    else 
                    {
                        alert("Data berhasil diinput")
                        showDataCategory(id)

                        $("#form-tambah").trigger('reset')
                    }
                },
                error: function(e) 
                {
                    alert('Terjadi kesalahan saat load data');
                }
            })
        })
    });

    setTimeout(function(){
        $('.preloader').slideUp();
    }, 3000);
</script>

