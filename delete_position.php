<?php
session_start();

include "dbconnect.php";
include "location.php";
$con = mysqli_connect($servername,$username,$password); 
mysqli_select_db($con, $dbname); 
mysqli_query($con,"SET CHARSET utf8");
mysqli_query($con,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 
$delete = $_POST['id_to_delete'];

if (!$con)
  {
  die('Nie mozna polaczyc: ');
  }
else
    {
    $zmiana_w_bazie = "UPDATE wykonane_lokalizacja SET `status`='usuniety' WHERE `id_prac`='$delete'";

    $wynik_del = mysqli_query($con, $zmiana_w_bazie);
        if (!$wynik_del)
        {
        return false;
            echo 'błąd połączczenia z serwerem';
        }
        else
        {   
            echo "<script language='javascript' type='text/javascript'>alert('Usunięto z bazy');</script>";
            header('Location:' .$location. 'raport_robocze.php'); 
        }
    }

mysqli_close($con);

?>