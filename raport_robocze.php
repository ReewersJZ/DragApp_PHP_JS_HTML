<?php
session_start();
?>


<html>
    <html lang="pl"></html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="REEWERS Justyna Zahraj">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    <title>DragApp</title>
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
    
    
    <div class="container">
      <div class="row">
      <div class="col-sm-12 pt-5" class="divWithTable">
        <?php
          include "dbconnect.php";
          include "location.php";

          $conn = mysqli_connect($servername, $username, $password, $dbname);
          mysqli_query($conn,"SET CHARSET utf8");
          mysqli_query($conn,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM `wykonane_lokalizacja` WHERE `status`='roboczy'";
                

          $result = mysqli_query($conn, $sql);

              echo "<div class ='col-sm-12 mt-5'>";
              echo "<table class=\"myTableRap\" border=\"1\"><tr>";
              echo "<td class=\"classOfRapTable\" style=\"display: none;\"><strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Data<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Miasto<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Ulica<strong></strong></td>";
              echo "<td class=\"classOfRapTable\"><strong></strong></td>";
              echo "</tr>";
          
          $il_wierszy = mysqli_num_rows($result);

          if ($il_wierszy > 0){
            
              $row = mysqli_fetch_row($result);

                echo "</tr>";
                echo "<form action='save_to_base_edit.php' method='POST' ENCTYPE='multipart/form-data'>";
                echo "<td class=\"classOfRapTableElements\" style=\"display: none;\"><input type=\"hidden\" name=\"wiersz1\" value=\"$row[1]\">" . $row[1] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 15%;\">" . $row[2] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 35%;\">" . $row[5] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 40%;\">" . $row[6] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 10%;\"><button class='btn btn-primary btn-lg btn-block buttonAdd buttonEdit' type='submit'>Edytuj</button></td>";
                echo "</form>";
                echo "</tr>";

                $il_wierszy = $il_wierszy - 1;

                if ($il_wierszy > 0){

                  $row2 = mysqli_fetch_row($result);
                      echo "</tr>";
                      echo "<form action='save_to_base_edit2.php' method='POST' ENCTYPE='multipart/form-data'>";
                      echo "<td class=\"classOfRapTableElements\" style=\"display: none;\"><input type=\"hidden\" name=\"wiersz2\" value=\"$row2[1]\">" . $row2[1] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 15%;\">" . $row2[2] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 35%;\">" . $row2[5] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 40%;\">" . $row2[6] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 10%;\"><button class='btn btn-primary btn-lg btn-block buttonAdd buttonEdit' type='submit'>Edytuj</button></td>";
                      echo "</form>";
                      echo "</tr>";

                      $il_wierszy = $il_wierszy - 1;
                    }
                else {
                  echo "</table>";
                  echo "</div>";
                }

                if ($il_wierszy > 0){

                  $row3 = mysqli_fetch_row($result);
                      echo "</tr>";
                      echo "<form action='save_to_base_edit3.php' method='POST' ENCTYPE='multipart/form-data'>";
                      echo "<td class=\"classOfRapTableElements\" style=\"display: none;\"><input type=\"hidden\" name=\"wiersz3\" value=\"$row3[1]\">" . $row3[1] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 15%;\">" . $row3[2] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 35%;\">" . $row3[5] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 40%;\">" . $row3[6] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 10%;\"><button class='btn btn-primary btn-lg btn-block buttonAdd buttonEdit' type='submit'>Edytuj</button></td>";
                      echo "</form>";
                      echo "</tr>";

                      $il_wierszy = $il_wierszy - 1;
                    }
                else {
                  echo "</table>";
                  echo "</div>";
                }

                if ($il_wierszy > 0){

                  $row4 = mysqli_fetch_row($result);
                      echo "</tr>";
                      echo "<form action='save_to_base_edit4.php' method='POST' ENCTYPE='multipart/form-data'>";
                      echo "<td class=\"classOfRapTableElements\" style=\"display: none;\"><input type=\"hidden\" name=\"wiersz4\" value=\"$row4[1]\">" . $row4[1] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 15%;\">" . $row4[2] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 35%;\">" . $row4[5] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 40%;\">" . $row4[6] . "</td>";
                      echo "<td class=\"classOfRapTableElements\" style=\"width: 10%;\"><button class='btn btn-primary btn-lg btn-block buttonAdd buttonEdit' type='submit'>Edytuj</button></td>";
                      echo "</form>";
                      echo "</tr>";
                    }
                  else {
                    echo "</table>";
                    echo "</div>";
                  }
                    
              echo "</table>";
              echo "</div>";
          }
           
              
            
          else {
            echo "brak danych";
          }

          mysqli_close($conn);
        ?>
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
