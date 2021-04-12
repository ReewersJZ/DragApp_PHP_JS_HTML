<?php

function SprawdzCzyPoprawneHaslo($writtenLogin, $writtenPassword)

{
    include "dbconnect.php";
    $con = mysqli_connect($servername,$username,$password); 
    mysqli_select_db($con, $dbname); 

    $zapytanie = "SELECT * FROM `users` WHERE `user`='$writtenLogin'";
    $wynik = mysqli_query($con, $zapytanie);

    if (!$wynik)
    {
        return false;
        echo 'błąd połączczenia z serwerem';
    }
    else
    {       
        $liczba_wierszy = mysqli_num_rows($wynik);
        if ($liczba_wierszy == 1)
        {
            while($wiersz = mysqli_fetch_array($wynik))
            {
                $passwordFromBase = $wiersz['password'];
            }

            if ($writtenPassword == $passwordFromBase)
            {
                return true;
            }
            else
            {
                $result = password_verify($writtenPassword, $passwordFromBase);
                if (!$result)
                {   
                    return false;
                }
                else{
                    return true;
                }
            }           
        }
        else
        {   
            return false;
            echo "<script language='javascript' type='text/javascript'>alert('Błędny login');</script>";
        }
        
    }
}

function jakie_uprawnienia($writtenLogin)

{
    include "dbconnect.php";
    $con = mysqli_connect($servername,$username,$password); 
    mysqli_select_db($con, $dbname); 


    $zapytanie = "SELECT * FROM `users` WHERE `user`='$writtenLogin'";
    $wynik = mysqli_query($con, $zapytanie);

    if (!$wynik)
    {
        return false;
        echo 'błąd połączczenia z serwerem';
    }
    else
    {       
        $liczba_wierszy = mysqli_num_rows($wynik);
        if ($liczba_wierszy == 1)
        {
            while($wiersz = mysqli_fetch_array($wynik))
            {
                $upraw = $wiersz['uprawnienia'];
                $both = array($upraw);
                return $both;
            }
        }
        else
        {   
            return false;
            echo "<script language='javascript' type='text/javascript'>alert('Błąd danych na serwerze');</script>";
        }
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
    $writtenLogin = htmlspecialchars($_POST['login']);
    $writtenPassword = htmlspecialchars($_POST['password']);
    $czy_poprawne_haslo = SprawdzCzyPoprawneHaslo($writtenLogin, $writtenPassword);
    
    if ($czy_poprawne_haslo) 
    {
    mysqli_close($con);
    $_SESSION['user'] = htmlspecialchars($_POST['login']);

    
    $uprawnienia = jakie_uprawnienia($_SESSION['user']);
    $_SESSION['uprawnienia'] = $uprawnienia[0];

        if ($_SESSION['uprawnienia'] == "superuser"){
            header('Location:' .$location. 'main_panel.php'); //wcześniej przy linkach było dragapp/main_panel.php
        }
        else if ($_SESSION['uprawnienia'] == "user"){
            header('Location:' .$location. 'raport.php'); 
        }
        else{
            header('Location:' .$location. 'index.html'); 
        }
    } 
    else 
    {
    echo "<script language='javascript' type='text/javascript'>alert('Błędny login lub hasło');</script>";
    header('Location:' .$location. 'index.html');
 	} 
} 
else 
{
    echo "<script language='javascript' type='text/javascript'>alert('Zaloguj się');</script>";
    header('Location:' .$location. 'index.html'); 
}
?>