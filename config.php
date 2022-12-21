<?php

session_start();

try 
{
    $con = new PDO('mysql:host=localhost;dbname=db', 'root');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>