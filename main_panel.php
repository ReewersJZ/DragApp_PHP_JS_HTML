<?php
session_start();
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
    <div class="container mainContainer">   
      <form class="" action="save_to_base.php" method="POST" ENCTYPE="multipart/form-data" novalidate="">   
        <div class="row">

              <div class="col-md-4 mb-3">
                  <label for="day">DATA:<span class="text-muted"></span></label>
                  <input type="date" class="form-control" id="day" name="day" placeholder="DD">
                    <div class="invalid-feedback">
                      wpisz poprawnie format daty.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="time">Ilość godzin pracy:<span class="text-muted"></span></label>
                  <input type="number" min="0" class="form-control" id="timeHours" name="timeHours">
                    <div class="invalid-feedback">
                      wpisz poprawnie ilość godzin.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="time">Ilość minut pracy:<span class="text-muted"></span></label>
                  <input type="number" min="0" step="15" max="45" class="form-control" id="timeMinutes" name="timeMinutes">
                    <div class="invalid-feedback">
                      wpisz poprawnie format godziny.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="city">Miasto:</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                        wpisz poprawnie dane.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="street">Ulica:</label>
                  <input type="text" class="form-control" id="street" name="street" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="numberOflocal">Numer:</label>
                  <input type="text" class="form-control" min="0" id="numberOflocal" name="numberOflocal" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                  <label for="country">Stawka</label>
                    <select class="custom-select d-block w-100" id="money" name="money" required="">
                      <option value="">wybierz...</option>
                      <option>180</option>
                      <option>90</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid country.
                    </div>
              </div>
              <div class="col-md-4 mb-3">
                    <label for="country">VAT</label>
                      <select class="custom-select d-block w-100" id="podatek" name="podatek" required="">
                        <option value="">wybierz...</option>
                        <option>8</option>
                        <option>23</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid country.
                      </div>
              </div>
              <div class="col-md-4 mb-3">
                    <label for="addAmount">Dodatkowe koszty w zł</label>
                    <input type="text" class="form-control" id="dodatkoweKoszty" name="dodatkoweKoszty" placeholder="np. 1000.25" value="" required="">
              </div>
            <div class="col-sm-12 mb-3">
                <label for="pomiary">Uziom 1:</label>
                <input type="text" class="form-control" id="pomiary1" name="pomiary1" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary2">
                <label for="pomiary">Uziom 2:</label>
                <input type="text" class="form-control" id="pomiary2" name="pomiary2" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary3">
                <label for="pomiary">Uziom 3:</label>
                <input type="text" class="form-control" id="pomiary3" name="pomiary3" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary4">
                <label for="pomiary">Uziom 4:</label>
                <input type="text" class="form-control" id="pomiary4" name="pomiary4" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary5">
                <label for="pomiary">Uziom 5:</label>
                <input type="text" class="form-control" id="pomiary5" name="pomiary5" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary6">
                <label for="pomiary">Uziom 6:</label>
                <input type="text" class="form-control" id="pomiary6" name="pomiary6" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary7">
                <label for="pomiary">Uziom 7:</label>
                <input type="text" class="form-control" id="pomiary7" name="pomiary7" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary8">
                <label for="pomiary">Uziom 8:</label>
                <input type="text" class="form-control" id="pomiary8" name="pomiary8" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary9">
                <label for="pomiary">Uziom 9:</label>
                <input type="text" class="form-control" id="pomiary9" name="pomiary9" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary10">
                <label for="pomiary">Uziom 10:</label>
                <input type="text" class="form-control" id="pomiary10" name="pomiary10" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary11">
                <label for="pomiary">Uziom 11:</label>
                <input type="text" class="form-control" id="pomiary11" name="pomiary11" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary12">
                <label for="pomiary">Uziom 12:</label>
                <input type="text" class="form-control" id="pomiary12" name="pomiary12" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary13">
                <label for="pomiary">Uziom 13:</label>
                <input type="text" class="form-control" id="pomiary13" name="pomiary13" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary14">
                <label for="pomiary">Uziom 14:</label>
                <input type="text" class="form-control" id="pomiary14" name="pomiary14" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary15">
                <label for="pomiary">Uziom 15:</label>
                <input type="text" class="form-control" id="pomiary15" name="pomiary15" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary16">
                <label for="pomiary">Uziom 16:</label>
                <input type="text" class="form-control" id="pomiary16" name="pomiary16" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary17">
                <label for="pomiary">Uziom 17:</label>
                <input type="text" class="form-control" id="pomiary17" name="pomiary17" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary18">
                <label for="pomiary">Uziom 18:</label>
                <input type="text" class="form-control" id="pomiary18" name="pomiary18" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary19">
                <label for="pomiary">Uziom 19:</label>
                <input type="text" class="form-control" id="pomiary19" name="pomiary19" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary20">
                <label for="pomiary">Uziom 20:</label>
                <input type="text" class="form-control" id="pomiary20" name="pomiary20" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary21">
                <label for="pomiary">Uziom 21:</label>
                <input type="text" class="form-control" id="pomiary21" name="pomiary21" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary22">
                <label for="pomiary">Uziom 22:</label>
                <input type="text" class="form-control" id="pomiary22" name="pomiary22" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary23">
                <label for="pomiary">Uziom 23:</label>
                <input type="text" class="form-control" id="pomiary23" name="pomiary23" placeholder="" value="" required="">
            </div>
            <div class="col-sm-12 mb-3 notVisible" id="divPomiary24">
                <label for="pomiary">Uziom 24:</label>
                <input type="text" class="form-control" id="pomiary24" name="pomiary24" placeholder="" value="" required="">
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
                    <input type="text" class="form-control" id="material1" name="material1" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial2" value="Złączki 2 śrubowe">Złączki 2 śrubowe</span>
                </div>
                    <input type="text" class="form-control" id="material2" name="material2" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial3" value="Złączki 4 śrubowe">Złączki 4 śrubowe</span>
                </div>
                    <input type="text" class="form-control" id="material3" name="material3" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial4" value="Złączki 4 śrubowe - bednarka">Złączki 4 śrubowe - bednarka</span>
                </div>
                    <input type="text" class="form-control" id="material4" name="material4" placeholder="podaj ilość" value="" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial5" value="Złącze kontrolne">Złącze kontrolne</span>
                </div>
                    <input type="text" class="form-control" id="material5" name="material5" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial6" value="Puszki podtynkowe">Puszki podtynkowe</span>
                </div>
                    <input type="text" class="form-control" id="material6" name="material6" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial7" value="Puszki gruntowe">Puszki gruntowe</span>
                </div>
                    <input type="text" class="form-control" id="material7" name="material7" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial8" value="T-ki">T-ki</span>
                </div>
                    <input type="text" class="form-control" id="material8" name="material8" placeholder="podaj ilość" value="" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial9" value="L-ki">L-ki</span>
                </div>
                    <input type="text" class="form-control" id="material9" name="material9" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial10" value="Kotwy 18">Kotwy 18</span>
                </div>
                    <input type="text" class="form-control" id="material10" name="material10" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial11" value="Kotwy 20">Kotwy 20</span>
                </div>
                    <input type="text" class="form-control" id="material11" name="material11" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial12" value="Betoniki">Betoniki</span>
                </div>
                    <input type="text" class="form-control" id="material12" name="material12" placeholder="podaj ilość" value="" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial13" value="Klej">Klej</span>
                </div>
                    <input type="text" class="form-control" id="material13" name="material13" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial14" value="Drut aluminium">Drut aluminium</span>
                </div>
                    <input type="text" class="form-control" id="material14" name="material14" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial15" value="Drut stal">Drut stal</span>
                </div>
                    <input type="text" class="form-control" id="material15" name="material15" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial16" value="Polwinit biały">Polwinit biały</span>
                </div>
                    <input type="text" class="form-control" id="material16" name="material16" placeholder="podaj ilość" value="" required="">
            </div>

            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial17" value="Polwinit czarny">Polwinit czarny</span>
                </div>
                    <input type="text" class="form-control" id="material17" name="material17" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial18" value="Bednarka 30x4">Bednarka 30x4</span>
                </div>
                    <input type="text" class="form-control" id="material18" name="material18" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial19" value="Bednarka 25x4">Bednarka 25x4</span>
                </div>
                    <input type="text" class="form-control" id="material19" name="material19" placeholder="podaj ilość" value="" required="">
            </div>
            <div class="col-sm-12 input-group mb-3 showMaterialsDivs">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="opisMaterial20" value="Sztyca 4m">Sztyca 4m</span>
                </div>
                    <input type="text" class="form-control" id="material20" name="material20" placeholder="podaj ilość" value="" required="">
            </div>

            <div class="col-sm-12 mb-1 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Inne</span>
                </div>
                <textarea class="form-control" name="inne"></textarea>
            </div>

            </div>
            </div>

            <div class="col-sm-12 mb-1">
                <input type="hidden" name="MAX_FILE_SIZE" value="" />
                <input type="file" name="obrazek" />
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
<?php endif; ?>

</body>
</html>