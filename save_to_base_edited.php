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
    $user_wprowadz = $_SESSION['user'];
    $status = $_POST['status'];
    $dodatkowe_koszty= $_POST['dodatkoweKoszty'];

    if(strpos($dodatkowe_koszty, ',')!==false){
      $dodatkowe_koszty = str_replace(",",".",$dodatkowe_koszty);
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

    $idPrac = $_POST['selected_idPrac'];


    $zapis_do_bazy = "UPDATE wykonane_lokalizacja SET  `data`='$data' , `il_godzin`='$ilGodzin', `il_minut`='$ilMinut', `miasto`='$miasto', `ulica`='$ulica', `numer`='$numer', 
                    `stawka`='$stawka', `podatek`='$podatek', `wprowadz`='$user_wprowadz', `status`='$status', `dodatkowe_koszty`='$dodatkowe_koszty'  WHERE `id_prac`='$idPrac'";

    $wynik3 = mysqli_query($con, $zapis_do_bazy);

    $zapis_do_bazy_uziomy = "UPDATE wykonane_uziomy SET `u1`='$u1', `u2`='$u2', `u3`='$u3', `u4`='$u4', `u5`='$u5', `u6`='$u6', `u7`='$u7', `u8`='$u8', `u9`='$u9', `u10`='$u10', 
                            `u11`='$u11', `u12`='$u12', `u13`='$u13', `u14`='$u14', `u15`='$u15', `u16`='$u16', `u17`='$u17', `u18`='$u18', `u19`='$u19', `u20`='$u20', `u21`='$u21', 
                            `u22`='$u22', `u23`='$u23', `u24`='$u24' WHERE `id_prac`='$idPrac'";
 
    $wynik4 = mysqli_query($con, $zapis_do_bazy_uziomy);

    $zapis_do_bazy_materialy = "UPDATE wykonane_materialy SET `uziomy`='$material1', `zlaczki_2_srubowe`='$material2', `zlaczki_4_srubowe`='$material3', 
                                `zlaczki_4_srubowe_bednarka`='$material4', `zlacze_kontrolne`='$material5', `puszki_podtynkowe`='$material6', `puszki_gruntowe`='$material7',
                                 `T_ki`='$material8', `L_ki`='$material9', `kotwy_18`='$material10', `kotwy_20`='$material11', `betoniki`='$material12', `klej`='$material13', 
                                 `drut_aluminium`='$material14', `drut_stal`='$material15', `polwinit_bialy`='$material16', `polwinit_czarny`='$material17', `bednarka_30x4`='$material18',
                                  `bednarka_25x4`='$material19', `sztyca_4m`='$material20', `inne`='$inne' WHERE `id_prac`='$idPrac'";
                                  
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
            echo "<script language='javascript' type='text/javascript'>location.href = '" .$location. "main_panel.php';</script>";
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





















