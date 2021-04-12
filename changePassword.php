<?php

function zmienHaslo($writtenLogin, $newwrittenPassword)

{
    include "dbconnect.php";
    $con = mysqli_connect($servername,$username,$password); 
    mysqli_select_db($con, $dbname); 

    mysqli_query($con,"SET CHARSET utf8");
    mysqli_query($con,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 

    $zmiana_hasla_w_bazie = "UPDATE `users` SET `password`='$newwrittenPassword' WHERE `user` = '$writtenLogin'";
    $wynik2 = mysqli_query($con, $zmiana_hasla_w_bazie);
    
    if (!$wynik2)
    {
        return false;
        echo 'błąd połączczenia z serwerem';
    }
    else
    {
            return true;
    }
}


session_start();
ob_start();

include "dbconnect.php";
include "location.php";
$con = mysqli_connect($servername,$username,$password); 
mysqli_select_db($con, $dbname); 

if (!$con)
  {
  die('Nie mozna polaczyc: ');
  }

if ( isset($_POST["login"]) )
{
    $writtenLogin = $_SESSION['user'];
    $newwrittenPasswordnotSafe = $_POST['newpassword'];
    $newwrittenPassword = password_hash($newwrittenPasswordnotSafe, PASSWORD_DEFAULT);
    $zmien_haslo = zmienHaslo($writtenLogin, $newwrittenPassword);
    
    if ($zmien_haslo) 
    {
    mysqli_close($con);

    } 
    else 
    {
        echo 'nieznany błąd 1'; 
 	} 
} 
else 
{
    echo 'nieznany błąd'; 
}
echo "<script language='javascript' type='text/javascript'>alert('Zaloguj się ponownie');</script>";
session_destroy();
header('Location:' .$location. 'index.html');



















