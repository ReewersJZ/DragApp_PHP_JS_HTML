<?php
session_start();
?>

<?php

include "location.php";

function sprawdz_typ()
{
	if ($_FILES['obrazek']['type'] != 'image/jpeg')
		return false;
	return true;
}


function zapisz_plik($idPrac_plik)
{
  $idPrac = $idPrac_plik;

  $lokalizacja = "./zalaczniki/$idPrac.jpg";

  if(is_uploaded_file($_FILES['obrazek']['tmp_name']))
  {
    if(!move_uploaded_file($_FILES['obrazek']['tmp_name'], $lokalizacja))
    {
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
        return false;  
    }
  }
  else
  {
    echo 'problem: Możliwy atak podczas przesyłania pliku.';
	  echo 'Plik nie został zapisany.';
    return false;
  }
  return true;
}

include "dbconnect.php";
include "location.php";
$con = mysqli_connect($servername,$username,$password); 
mysqli_select_db($con, $dbname); 
mysqli_query($con,"SET CHARSET utf8");
mysqli_query($con,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 

if (!$con)
  {
  die('Nie mozna polaczyc: ');
  }


    // pobieranie danych do bazy wykonane_lokalizacja
    $data = $_POST['day'];
    $ilGodzin = $_POST['timeHours'];
    $ilMinut = $_POST['timeMinutes'];
    $miasto = $_POST['city'];
    $ulica = $_POST['street'];
    $numer = $_POST['numberOflocal'];
    $stawka = $_POST['money'];
    $podatek = $_POST['podatek'];
    $dodatkoweKoszty = $_POST['dodatkoweKoszty'];
    $user_wprowadz = $_SESSION['user'];
    $status = $_POST['status'];

    if(strpos($dodatkoweKoszty, ',')!==false){
      $dodatkoweKoszty = str_replace(",",".",$dodatkoweKoszty);
    }


    // pobieranie danych do bazy wykonane_uziomy
    $u1 = $_POST['pomiary1'];
    $u2 = $_POST['pomiary2'];
    $u3 = $_POST['pomiary3'];
    $u4 = $_POST['pomiary4'];
    $u5 = $_POST['pomiary5'];
    $u6 = $_POST['pomiary6'];
    $u7 = $_POST['pomiary7'];
    $u8 = $_POST['pomiary8'];
    $u9 = $_POST['pomiary9'];
    $u10 = $_POST['pomiary10'];
    $u11 = $_POST['pomiary11'];
    $u12 = $_POST['pomiary12'];
    $u13 = $_POST['pomiary13'];
    $u14 = $_POST['pomiary14'];
    $u15 = $_POST['pomiary15'];
    $u16 = $_POST['pomiary16'];
    $u17 = $_POST['pomiary17'];
    $u18 = $_POST['pomiary18'];
    $u19 = $_POST['pomiary19'];
    $u20 = $_POST['pomiary20'];
    $u21 = $_POST['pomiary21'];
    $u22 = $_POST['pomiary22'];
    $u23 = $_POST['pomiary23'];
    $u24 = $_POST['pomiary24'];

     // pobieranie danych do bazy wykonane_materialy
     $material1 = $_POST['material1'];
     $material2 = $_POST['material2'];
     $material3 = $_POST['material3'];
     $material4 = $_POST['material4'];
     $material5 = $_POST['material5'];
     $material6 = $_POST['material6'];
     $material7 = $_POST['material7'];
     $material8 = $_POST['material8'];
     $material9 = $_POST['material9'];
     $material10 = $_POST['material10'];
     $material11 = $_POST['material11'];
     $material12 = $_POST['material12'];
     $material13 = $_POST['material13'];
     $material14 = $_POST['material14'];
     $material15 = $_POST['material15'];
     $material16 = $_POST['material16'];
     $material17 = $_POST['material17'];
     $material18 = $_POST['material18'];
     $material19 = $_POST['material19'];
     $material20 = $_POST['material20'];
     $inne = $_POST['inne'];

    //uniwersalne zmienne do wszystkich baz
    $dataDzis=date("Y-m-d");
    $czas=date("H:i:s");
    $idPrac =  $dataDzis . "_" . $czas;





    $zapis_do_bazy = "INSERT INTO `wykonane_lokalizacja`(`id_prac`, `data`, `il_godzin`, 
                                                    `il_minut`, `miasto`, `ulica`, `numer`, `stawka`, `podatek`, `wprowadz`, `status`, `dodatkowe_koszty`) 
                                                    VALUES ('$idPrac', '$data', '$ilGodzin', '$ilMinut', '$miasto', '$ulica', 
                                                    '$numer', '$stawka', '$podatek', '$user_wprowadz', '$status', '$dodatkoweKoszty')";
    $wynik3 = mysqli_query($con, $zapis_do_bazy);

    $zapis_do_bazy_uziomy = "INSERT INTO `wykonane_uziomy`(`id_prac`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `u12`, `u13`, `u14`, `u15`, `u16`, `u17`, `u18`,
                                                            `u19`, `u20`, `u21`, `u22`, `u23`, `u24`) 
                      VALUES ('$idPrac', '$u1', '$u2', '$u3', '$u4', '$u5', '$u6', '$u7', '$u8', '$u9', '$u10', '$u11', '$u12', '$u13','$u14', '$u15', '$u16', '$u17', '$u18', '$u19', 
                                '$u20', '$u21', '$u22', '$u23', '$u24')";
    $wynik4 = mysqli_query($con, $zapis_do_bazy_uziomy);

    $zapis_do_bazy_materialy = "INSERT INTO `wykonane_materialy`(`id_prac`, `uziomy`, `zlaczki_2_srubowe`, `zlaczki_4_srubowe`, `zlaczki_4_srubowe_bednarka`, `zlacze_kontrolne`, `puszki_podtynkowe`, 
                                  `puszki_gruntowe`, `T_ki`, `L_ki`, `kotwy_18`, `kotwy_20`, `betoniki`, `klej`, `drut_aluminium`, `drut_stal`, `polwinit_bialy`, `polwinit_czarny`, `bednarka_30x4`,
                                  `bednarka_25x4`, `sztyca_4m`, `inne`)
                                  VALUES ('$idPrac', '$material1', '$material2', '$material3', '$material4', '$material5', '$material6', '$material7', '$material8', '$material9', '$material10',
                                  '$material11', '$material12', '$material13', '$material14', '$material15', '$material16','$material17', '$material18', '$material19', '$material20', '$inne')";
                                  
                                  
    $wynik5 = mysqli_query($con, $zapis_do_bazy_materialy);

    
    if (!$wynik3 || !$wynik4 || !$wynik5)
    {
        return false;
         echo 'błąd połączczenia z serwerem';
    }
    else
    {   


        $infile=$_FILES['obrazek']['tmp_name'];
        
        if ($infile == "")
          {			
            echo "<script language='javascript' type='text/javascript'>alert('Dane wprowadzone poprawnie');</script>";
            echo "<script language='javascript' type='text/javascript'>location.href = '".$location. "main_panel.php';</script>";
            return true;
        }
        else{
          $sprawdzTyp = sprawdz_typ();
          $zapiszPlik = zapisz_plik($idPrac);
  
          if (!$sprawdzTyp || !$zapiszPlik)
          {
            return false;
            echo 'Plik nie został przesłany';
          }
          else{
            $zapis_do_bazy_plik = "UPDATE `wykonane_lokalizacja` SET `plik`='plik' WHERE `id_prac`='$idPrac'";
            $wynik4 = mysqli_query($con, $zapis_do_bazy_plik);
            echo "<script language='javascript' type='text/javascript'>alert('Dane wprowadzone poprawnie');</script>";
            echo "<script language='javascript' type='text/javascript'>location.href = '" .$location. "main_panel.php';</script>"; 
            return true;
          }
        }


    }

?>





















