<?php

include 'config.php';

setcookie('login_user', null, time() - 3600, '/');
header('location: home.php');

?>