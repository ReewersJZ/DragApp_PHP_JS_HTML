<?php
session_start();

$wiersz = $_POST['cos'];

include "dbconnect.php";
include "location.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM `wykonane_lokalizacja` WHERE  `id_prac`= '$wiersz'";
$sql2 = "SELECT * FROM `wykonane_uziomy` WHERE  `id_prac`= '$wiersz'";
$sql3 = "SELECT * FROM `wykonane_materialy` WHERE  `id_prac`= '$wiersz'";


$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_row($result);

    $data = $row[2];
    $ilGodzin = $row[3];
    $ilMinut = $row[4];
    $miasto = $row[5];
    $ulica = $row[6];
    $numer = $row[7];
    $stawka = $row[8];
    $podatek = $row[9];
    $user_wprowadz = $_SESSION['user'];
    $status = $row[11];
    $plik = $row[12];
    $dodatkowe_koszty = $row[13];

    if ($stawka == 0){
        $stawka = 'wybierz...';
    }
    if ($podatek == 0){
        $podatek = 'wybierz...';
    }

    $row2 = mysqli_fetch_row($result2);

    $uzi1 = $row2[2]; $uzi2 = $row2[3]; $uzi3 = $row2[4]; $uzi4 = $row2[5];
    $uzi5 = $row2[6]; $uzi6 = $row2[7]; $uzi7 = $row2[8]; $uzi8 = $row2[9];
    $uzi9 = $row2[10]; $uzi10 = $row2[11]; $uzi11 = $row2[12]; $uzi12 = $row2[13];
    $uzi13 = $row2[14]; $uzi14 = $row2[15]; $uzi15 = $row2[16]; $uzi16 = $row2[17];
    $uzi17 = $row2[18]; $uzi18 = $row2[19]; $uzi19 = $row2[20]; $uzi20 = $row2[21];
    $uzi21 = $row2[22]; $uzi22 = $row2[23]; $uzi23 = $row2[24]; $uzi24 = $row2[25];

    $row3 = mysqli_fetch_row($result3);

    $mat1 = $row3[2]; $mat2 = $row3[3]; $mat3 = $row3[4]; $mat4 = $row3[5];
    $mat5 = $row3[6]; $mat6 = $row3[7]; $mat7 = $row3[8]; $mat8 = $row3[9];
    $mat9 = $row3[10]; $mat10 = $row3[11]; $mat11 = $row3[12]; $mat12 = $row3[13];
    $mat13 = $row3[14]; $mat14 = $row3[15]; $mat15 = $row3[16]; $mat16 = $row3[17];
    $mat17 = $row3[18]; $mat18 = $row3[19]; $mat19 = $row3[20]; $mat20 = $row3[21];
    $inn = $row3[22];
}
else {
    echo "brak danych";
  }


  mysqli_close($conn);


?>

<html>
    <html lang="pl"></html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <title>DragApp</title>
  <meta name="description" content="instalacje odgromowe">
  <meta name="keywords" content="instalacje odgromowe">
  <meta name="author" content="REEWERS Justyna Zahraj">
  <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="mainDrag.css">
</head>

<body>

<?php if (empty($_SESSION['user']) || empty($_SESSION['uprawnienia']) || $_SESSION['uprawnienia'] === 'user') : ?>
  <form class="form-signin pt-5">
      <div class="text-center mb-4">
      <a href="index.html"><img class="mb-4" src="img/logo.png" alt="" width="20%"></a>
      </div>
      <p class="footerStyle1">© 2020<a href="">
                <img id="logo_ree" src="img/logo_black.png"></a></p>
  </form>
<?php else : ?>



    <header>
      <nav class="navbar navbar-light bg-navigation navbar-expand-md fixed-top" role="navigation">
                  <a class="navbar-brand" href=""><img id="logoMenu" src="img/logo.png" 
                      width="100" class="d-inline-block" alt="logo"> </a>
                      
                  <button class="navbar-toggler " type="button" data-toggle="collapse" 
                  data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" 
                  aria-label="Przełącznik nawigacji">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="mainmenu" data-target=".navbar-collapse" data-toggle="collapse">
                      <ul class="navbar-nav">
                        </li>
                        <li class="nav-itm">
                            <a class="nav-link" href="main_panel.php"><img class="icons_nav" src="img/home.png">Strona główna</a>
                        </li>
                        <li class="nav-itm">
                            <a class="nav-link" href="raport_plus.php"><img class="icons_nav" src="img/raport.png">Raporty</a>
                        </li>
                        <li class="nav-itm">
                            <a class="nav-link" href="raport_robocze.php"><img class="icons_nav" src="img/todo.png">Robocze</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data data-toggle="dropdown"
                            role="button" aria-expanded="false" id="submenu2" aria-haspopup="true"> 
                            <img class="icons_nav" src="img/settings.png">Ustawienia</a>
                            <div class="dropdown-menu" aria-labelledby="submenu2">
                                <a class="dropdown-item" href="passchange.php">Zmiana hasła</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data data-toggle="dropdown"
                            role="button" aria-expanded="false" id="submenu2" aria-haspopup="true"> 
                            <img class="icons_nav" src="img/user.png"><?php echo $_SESSION['user'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="submenu2">
                                <a class="nav-link" href="logout.php"><img class="icons_nav" src="img/logOut.png">Wyloguj</a>
                            </div>
                        </li>
                      </ul>
                  </div>
              </nav>
      </header>
    
<main>


  <img class="mainPicture" src="img/dach1.png" id="start"></img>
  <div class="container"> 
    <div class="row">
        <div class="col-sm-8 mb-1 mt-2">
            <h3><img class="" src="img/todo.png" width="5%"> Robocze</h3>
        </div>
        <div class="col-sm-4 mb-1 mt-2">
                <form class="" action="delete_position.php" method="POST" ENCTYPE="multipart/form-data" novalidate="" name="delete_position_form">
                    <input type="hidden" name="id_to_delete" value="<?php echo $wiersz?>"> 
                </form>
            <button class="btn btn-primary btn-lg btn-block redButton" id="deleteButton" type="button" onclick="deleteFromBase('delete_position_form')">Usuń z bazy</button>
        </div>
    </div>
   </div>


    <div class="container mainContainer editForm">   
      <form class="" action="save_to_base_edited.php" method="POST" ENCTYPE="multipart/form-data" novalidate="">   
        <div class="row">

            <div class="col-md-4 mb-3 notToShowIDDiv" style="display: none;">
                  <label for="selected_idPrac">selected_idPrac:<span class="text-muted"></span></label>
                  <input type="text" class="form-control" id="selected_idPrac" name="selected_idPrac" value="<?php echo $wiersz?>">
            </div>

              <div class="col-md-4 mb-3">
                  <label for="day">DATA:<span class="text-muted"></span></label>
                  <input type="date" class="form-control" id="day" name="day" value="<?php echo $data?>">
                    <div class="invalid-feedback">
                      wpisz poprawnie format daty.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="time">Ilość godzin pracy:<span class="text-muted"></span></label>
                  <input type="number" min="0" class="form-control" id="timeHours" name="timeHours" value="<?php echo $ilGodzin?>">
                    <div class="invalid-feedback">
                      wpisz poprawnie ilość godzin.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="time">Ilość minut pracy:<span class="text-muted"></span></label>
                  <input type="number" min="0" step="15" max="45" class="form-control" id="timeMinutes" name="timeMinutes" value="<?php echo $ilMinut?>">
                    <div class="invalid-feedback">
                      wpisz poprawnie format godziny.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="city">Miasto:</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="" value="<?php echo $miasto?>" required="">
                    <div class="invalid-feedback">
                        wpisz poprawnie dane.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="street">Ulica:</label>
                  <input type="text" class="form-control" id="street" name="street" placeholder="" value="<?php echo $ulica?>" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="numberOflocal">Numer:</label>
                  <input type="text" class="form-control" min="0" id="numberOflocal" name="numberOflocal" placeholder="" value="<?php echo $numer?>" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="country">Stawka</label>
                    <select class="custom-select d-block w-100" id="money" name="money" required="" value="<?php echo $stawka?>">
                      <option value="<?php echo $stawka?>"><?php echo $stawka?></option>
                      <option>180</option>
                      <option>90</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid country.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                    <label for="country">VAT</label>
                      <select class="custom-select d-block w-100" id="podatek" name="podatek" required="" value="<?php echo $podatek?>">
                        <option value="<?php echo $podatek?>"><?php echo $podatek?></option>
                        <option>8</option>
                        <option>23</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid country.
                      </div>
              </div>
              <div class="col-md-4 mb-3">
                    <label for="addAmount">Dodatkowe koszty w zł</label>
                    <input type="text" class="form-control" id="dodatkoweKoszty" name="dodatkoweKoszty" placeholder="" value="<?php echo $dodatkowe_koszty?>" required="">
              </div>

            <div class="col-sm-12 mb-3">
                <label for="pomiary">Uziom 1:</label>
                <input type="text" class="form-control" id="pomiary1" name="pomiary1" placeholder="" value="<?php echo $uzi1?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary2">
                <label for="pomiary">Uziom 2:</label>
                <input type="text" class="form-control" id="pomiary2" name="pomiary2" placeholder="" value="<?php echo $uzi2?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary3">
                <label for="pomiary">Uziom 3:</label>
                <input type="text" class="form-control" id="pomiary3" name="pomiary3" placeholder="" value="<?php echo $uzi3?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary4">
                <label for="pomiary">Uziom 4:</label>
                <input type="text" class="form-control" id="pomiary4" name="pomiary4" placeholder="" value="<?php echo $uzi4?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary5">
                <label for="pomiary">Uziom 5:</label>
                <input type="text" class="form-control" id="pomiary5" name="pomiary5" placeholder="" value="<?php echo $uzi5?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary6">
                <label for="pomiary">Uziom 6:</label>
                <input type="text" class="form-control" id="pomiary6" name="pomiary6" placeholder="" value="<?php echo $uzi6?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary7">
                <label for="pomiary">Uziom 7:</label>
                <input type="text" class="form-control" id="pomiary7" name="pomiary7" placeholder="" value="<?php echo $uzi7?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary8">
                <label for="pomiary">Uziom 8:</label>
                <input type="text" class="form-control" id="pomiary8" name="pomiary8" placeholder="" value="<?php echo $uzi8?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary9">
                <label for="pomiary">Uziom 9:</label>
                <input type="text" class="form-control" id="pomiary9" name="pomiary9" placeholder="" value="<?php echo $uzi9?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary10">
                <label for="pomiary">Uziom 10:</label>
                <input type="text" class="form-control" id="pomiary10" name="pomiary10" placeholder="" value="<?php echo $uzi10?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary11">
                <label for="pomiary">Uziom 11:</label>
                <input type="text" class="form-control" id="pomiary11" name="pomiary11" placeholder="" value="<?php echo $uzi11?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary12">
                <label for="pomiary">Uziom 12:</label>
                <input type="text" class="form-control" id="pomiary12" name="pomiary12" placeholder="" value="<?php echo $uzi12?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary13">
                <label for="pomiary">Uziom 13:</label>
                <input type="text" class="form-control" id="pomiary13" name="pomiary13" placeholder="" value="<?php echo $uzi13?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary14">
                <label for="pomiary">Uziom 14:</label>
                <input type="text" class="form-control" id="pomiary14" name="pomiary14" placeholder="" value="<?php echo $uzi14?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary15">
                <label for="pomiary">Uziom 15:</label>
                <input type="text" class="form-control" id="pomiary15" name="pomiary15" placeholder="" value="<?php echo $uzi15?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary16">
                <label for="pomiary">Uziom 16:</label>
                <input type="text" class="form-control" id="pomiary16" name="pomiary16" placeholder="" value="<?php echo $uzi16?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary17">
                <label for="pomiary">Uziom 17:</label>
                <input type="text" class="form-control" id="pomiary17" name="pomiary17" placeholder="" value="<?php echo $uzi17?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary18">
                <label for="pomiary">Uziom 18:</label>
                <input type="text" class="form-control" id="pomiary18" name="pomiary18" placeholder="" value="<?php echo $uzi18?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary19">
                <label for="pomiary">Uziom 19:</label>
                <input type="text" class="form-control" id="pomiary19" name="pomiary19" placeholder="" value="<?php echo $uzi19?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary20">
                <label for="pomiary">Uziom 20:</label>
                <input type="text" class="form-control" id="pomiary20" name="pomiary20" placeholder="" value="<?php echo $uzi20?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary21">
                <label for="pomiary">Uziom 21:</label>
                <input type="text" class="form-control" id="pomiary21" name="pomiary21" placeholder="" value="<?php echo $uzi21?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary22">
                <label for="pomiary">Uziom 22:</label>
                <input type="text" class="form-control" id="pomiary22" name="pomiary22" placeholder="" value="<?php echo $uzi22?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary23">
                <label for="pomiary">Uziom 23:</label>
                <input type="text" class="form-control" id="pomiary23" name="pomiary23" placeholder="" value="<?php echo $uzi23?>" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary24">
                <label for="pomiary">Uziom 24:</label>
                <input type="text" class="form-control" id="pomiary24" name="pomiary24" placeholder="" value="<?php echo $uzi23?>" required="">
            </div>
            <div class="col-sm-6 pb-1 pt-1 divLicznik">
            <input type="number" class="" id="licznik" placeholder="" value="1" required="">
            </div>
            <div class="col-sm-6 pb-1 pt-1">
            </div>
            <div class="col-sm-6 pb-1 pt-1 buttonAdd">
                <button class="btn btn-primary btn-lg btn-block buttonAdd" type="button" onclick="AddNext('licznik')">Dodaj<img class="icons_nav paddingLeft" src="img/plus.png"></button>
            </div>

                  
            <div class="container">      
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block greyButton" type="button" onclick="showMaterials('showMaterialsDivs')">Materiały budowlane <img class="icons_nav paddingLeft" src="img/plus.png"></button>
                    </div>
                </div>
            </div>


            <div class="container" id="showMaterialsDivs">      
                <div class="row">

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial1" value="Uziomy">Uziomy</span>
                </div>
                    <input type="text" class="form-control" id="material1" name="material1" placeholder="podaj ilość" value="<?php echo $mat1?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial2" value="Złączki 2 śrubowe">Złączki 2 śrubowe</span>
                </div>
                    <input type="text" class="form-control" id="material2" name="material2" placeholder="podaj ilość" value="<?php echo $mat2?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial3" value="Złączki 4 śrubowe">Złączki 4 śrubowe</span>
                </div>
                    <input type="text" class="form-control" id="material3" name="material3" placeholder="podaj ilość" value="<?php echo $mat3?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial4" value="Złączki 4 śrubowe - bednarka">Złączki 4 śrubowe - bednarka</span>
                </div>
                    <input type="text" class="form-control" id="material4" name="material4" placeholder="podaj ilość" value="<?php echo $mat4?>" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial5" value="Złącze kontrolne">Złącze kontrolne</span>
                </div>
                    <input type="text" class="form-control" id="material5" name="material5" placeholder="podaj ilość" value="<?php echo $mat5?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial6" value="Puszki podtynkowe">Puszki podtynkowe</span>
                </div>
                    <input type="text" class="form-control" id="material6" name="material6" placeholder="podaj ilość" value="<?php echo $mat6?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial7" value="Puszki gruntowe">Puszki gruntowe</span>
                </div>
                    <input type="text" class="form-control" id="material7" name="material7" placeholder="podaj ilość" value="<?php echo $mat7?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial8" value="T-ki">T-ki</span>
                </div>
                    <input type="text" class="form-control" id="material8" name="material8" placeholder="podaj ilość" value="<?php echo $mat8?>" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial9" value="L-ki">L-ki</span>
                </div>
                    <input type="text" class="form-control" id="material9" name="material9" placeholder="podaj ilość" value="<?php echo $mat9?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial10" value="Kotwy 18">Kotwy 18</span>
                </div>
                    <input type="text" class="form-control" id="material10" name="material10" placeholder="podaj ilość" value="<?php echo $mat10?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial11" value="Kotwy 20">Kotwy 20</span>
                </div>
                    <input type="text" class="form-control" id="material11" name="material11" placeholder="podaj ilość" value="<?php echo $mat11?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial12" value="Betoniki">Betoniki</span>
                </div>
                    <input type="text" class="form-control" id="material12" name="material12" placeholder="podaj ilość" value="<?php echo $mat12?>" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial13" value="Klej">Klej</span>
                </div>
                    <input type="text" class="form-control" id="material13" name="material13" placeholder="podaj ilość" value="<?php echo $mat13?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial14" value="Drut aluminium">Drut aluminium</span>
                </div>
                    <input type="text" class="form-control" id="material14" name="material14" placeholder="podaj ilość" value="<?php echo $mat14?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial15" value="Drut stal">Drut stal</span>
                </div>
                    <input type="text" class="form-control" id="material15" name="material15" placeholder="podaj ilość" value="<?php echo $mat15?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial16" value="Polwinit biały">Polwinit biały</span>
                </div>
                    <input type="text" class="form-control" id="material16" name="material16" placeholder="podaj ilość" value="<?php echo $mat16?>" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial17" value="Polwinit czarny">Polwinit czarny</span>
                </div>
                    <input type="text" class="form-control" id="material17" name="material17" placeholder="podaj ilość" value="<?php echo $mat17?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial18" value="Bednarka 30x4">Bednarka 30x4</span>
                </div>
                    <input type="text" class="form-control" id="material18" name="material18" placeholder="podaj ilość" value="<?php echo $mat18?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial19" value="Bednarka 25x4">Bednarka 25x4</span>
                </div>
                    <input type="text" class="form-control" id="material19" name="material19" placeholder="podaj ilość" value="<?php echo $mat19?>" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial20" value="Sztyca 4m">Sztyca 4m</span>
                </div>
                    <input type="text" class="form-control" id="material20" name="material20" placeholder="podaj ilość" value="<?php echo $mat20?>" required="">
            </div>

            <div class="col-sm-12 mb-1 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Inne</span>
                </div>
                <textarea class="form-control" name="inne"><?php echo $inn?></textarea>
            </div>

            </div>
            </div>
            
            
            <div class="col-sm-12 mb-1">
                <input type="hidden" name="MAX_FILE_SIZE" value="" />
                <input type="file" name="obrazek" /><a href="<?php echo $location?>zalaczniki/<?php echo $wiersz?>.jpg" target="_blank\"><?php echo $row[12]?></a>
            </div>

            <div class="col-sm-12 input-group mt-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="status">
                    <option selected>roboczy</option>
                    <option>zatwierdzony</option>
                </select>
            </div>

            <div class="container">      
            <div class="row">
                <div class="col-md-12 mb-3">
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block redButton" type="submit">Zapisz</button>
                </div>
            </div>
        </div>
            
        </div>
      </form>
    </div>


    
    </main>

    
  
    <footer>
        <div class="col-sm-12 pt-0 pb-0">
            <p class="footerStyle1"><img id="logo_ree" src="img/logo_black.png"></a></p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
    crossorigin="anonymous"></script>
    <script src='js/bootstrap.min.js'></script>
    <script src='js/script.js'></script>
    <script src='js/deleteFromBase.js'></script>
    <?php endif; ?>


</body>
</html>






