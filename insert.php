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
  <?php if (empty($_SESSION['user'])) : ?>
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
                <div class="collapse navbar-collapse" id="mainmenu" data-target=".navbar-collapse" data-toggle="collapse">
                    <ul class="navbar-nav">
                        <li class="nav-itm printSpaceNav mt-2 mb-2">
                            <a class="nav-link" href="raporty/newfile.csv"><img class="icons_nav_print mr-3" src="img/download.png">Pobierz plik</a>
                        </li>
                        <li class="nav-itm printSpaceNav mt-2 mb-2">
                            <a class="nav-link" ><img class="icons_nav_print mr-3" src="img/print.png"><input class="buttonZaswiadczenieDrukuj" 
                            type="button" onclick="window.print()" value="Drukuj"/></a>
                        </li>
                    </ul>
                </div>
    </nav>
</header>


<main role="main">
    
<div class="container"><style type="text/css" media="print">@page { size: landscape; }</style>
    <div class="row">
            <div class="col-sm-8 pt-5 mt-5 typeOfCourse">
                <h1 class="typeOfCourseText">Raport</h1>
                <h3 class="typeOfCourseText2"><?php echo $_POST['data3']?> - <?php echo $_POST['data4']?></h3>
            </div>
            <div class="col-sm-4 pt-5 mainPictureDiv">
                <img class="mt-5" src="img/logo.png" alt="" width="70%">
            </div>
        </div>
    </div>
    
    <div class="container">
      <div class="row">
      <div class="col-sm-12 pt-5" class="divWithTable">
        <?php
          include "dbconnect.php";
          include "location.php";

          $myfile = fopen("raporty/newfile.csv", "w") or die("Unable to open file!");

          $conn = mysqli_connect($servername, $username, $password, $dbname);
          mysqli_query($conn,"SET CHARSET utf8");
          mysqli_query($conn,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM `wykonane_lokalizacja` WHERE `data` >= '$_POST[data3]' and `data` <= '$_POST[data4]' and `status`='zatwierdzony'";
                

          $result = mysqli_query($conn, $sql);

              echo "<table class=\"myTableRap\" border=\"1\"><tr>";
              echo "<td class=\"classOfRapTable\">Data<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Il. godzin<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Il. minut<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Miasto<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Ulica<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Numer<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Stawka<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Podatek<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Dodatkowe koszty netto<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Kwota netto<strong></strong></td>";
              echo "<td class=\"classOfRapTable\">Kwota brutto<strong></strong></td>";

              echo "</tr>";

          if (mysqli_num_rows($result) > 0) {
            $suma = 0;
            $kwota_brutto_8 = 0;
            $podatek_8_suma = 0;
            $kwota_brutto_23 = 0;
            $podatek_23_suma = 0;
            
              while ( $row = mysqli_fetch_row($result) ) {
                $wyliczona_kwota = $row[3] * $row[8] + ($row[4] * $row[8] / 60) + $row[13];
                $wyliczona_kwota = round($wyliczona_kwota, 2);
                $kwota = $row[3] * $row[8] + ($row[4] * $row[8] / 60) + $row[13];

                if ($row[9] == "8"){
                  $podatek_8 = ($kwota * 8 / 100);
                  $kwotaZpodatkiem = $kwota + $podatek_8;
                  $kwotaZpodatkiem = round($kwotaZpodatkiem, 2);
                  $kwota_brutto_8 = $kwota_brutto_8 + $kwota + $podatek_8;
                  $kwota_brutto_8 = round($kwota_brutto_8, 2);
                  $podatek_8_suma = $podatek_8_suma + $podatek_8;
                  $podatek_8_suma = round($podatek_8_suma, 2);

                }
                if ($row[9] == "23"){
                  $podatek_23 = $kwota * 23 / 100;
                  $kwotaZpodatkiem = $kwota + $podatek_23;
                  $kwotaZpodatkiem = round($kwotaZpodatkiem, 2);
                  $kwota_brutto_23 = $kwota_brutto_23 + $kwota + $podatek_23;
                  $kwota_brutto_23 = round($kwota_brutto_23, 2);
                  $podatek_23_suma = $podatek_23_suma + $podatek_23;
                  $podatek_23_suma = round($podatek_23_suma, 2);
                }
                


                echo "</tr>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 12%;\">" . $row[2] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[3] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[4] . "</td>";
                echo "<td class=\"classOfRapTableElements\">" . $row[5] . "</td>";
                echo "<td class=\"classOfRapTableElements\">" . $row[6] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[7] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[8] . " zł". "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[9] . " %". "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 7%;\">" . $row[13] . " zł". "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 7%;\">" . $kwota . " zł". "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 7%;\">" . $kwotaZpodatkiem . " zł". "</td>";
                echo "</tr>";

                $txt = $row[2]. ";" . $row[3]. ";" . $row[4]. ";" . $row[5]. ";" . $row[6]. ";" . $row[7]. ";" . $row[8]. ";" . $row[9]. ";" . $row[13] . ";"."\n";
                fwrite($myfile, $txt);

                $suma += $wyliczona_kwota;


              }            
              echo "</table>";
            }
          else {
            echo "brak danych";
          }

          $suma_brutto = $suma + $podatek_8_suma + $podatek_23_suma;

          fclose($myfile);
          mysqli_close($conn);
        ?>
      </div>
    </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-sm-12 pt-5 pb-5">
            <h1 class="typeOfCourseText2 placeToSumAmount">Raport finansowy:</h1>
            
            <table class="myTableRap" style="border: 1;">
              <tr>
                <td class="classOfRapTable">Razem netto: <strong></strong></td>
                <td class="classOfRapTable">Razem brutto: <strong></strong></td>
              </tr>
              </tr>
                <td class="classOfRapTableElements"><?php echo $suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $suma_brutto?> zł</td>

              </tr>
            </table>
            <br>

            <table class="myTableRap" style="border: 1;">
              <tr>
                <td class="classOfRapTable">Razem netto VAT 8: <strong></strong></td>
                <td class="classOfRapTable">Razem brutto VAT 8: <strong></strong></td>
                <td class="classOfRapTable">VAT 8: <strong></strong></td>
              </tr>
              </tr>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_8 - $podatek_8_suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_8?> zł</td>
                <td class="classOfRapTableElements"><?php echo $podatek_8_suma?> zł</td>
              </tr>
            </table>
            <br>

            <table class="myTableRap" style="border: 1;">
              <tr>
                <td class="classOfRapTable">Razem netto VAT 23: <strong></strong></td>
                <td class="classOfRapTable">Razem brutto VAT 23: <strong></strong></td>
                <td class="classOfRapTable">VAT 23: <strong></strong></td>
              </tr>
              </tr>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_23 - $podatek_23_suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_23?> zł</td>
                <td class="classOfRapTableElements"><?php echo $podatek_23_suma?> zł</td>
              </tr>
            </table>
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
