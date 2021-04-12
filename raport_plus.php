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

<main role="main">


 <div class="container pt-5 pb-5 pt-5 mt-5">
      <div class="row">
        <div class="col-sm-2 cardSize "> 
        </div>

        <div class="col-sm-4 mt-5 cardSize "> 
            <a href="raport_plus_finanse.php" style="text-decoration: none;">
            <div class="card mb-4 shadow-sm">
                <p class="iconsBox"><img class="icons" src="img/finance.png"></p>
                <div class="card-body">
                  <p class="card-text">Finansowe</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4 mt-5 cardSize">
            <a href="raport_plus_materialy.php" style="text-decoration: none;">
            <div class="card mb-4 shadow-sm">
                <p class="iconsBox"><img class="icons" src="img/materials.png"></p>
                <div class="card-body">
                    <p class="card-text">Materiałowe</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-2 cardSize "> 
        </div>
      </div>
    </div>

</main>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
    crossorigin="anonymous"></script>
    <script src='js/bootstrap.min.js'></script>

    <?php endif; ?>
</body>
</html>