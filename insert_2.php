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
          
          $txt = "Data" . ";" . "Il. godzin" . ";" . "Il. minut" . ";" . "Miasto". ";" . "Ulica". ";" . "Numer". ";" . "uziomy". ";" . "złączki 2-śrubowe". ";" . "złączki 4-śrubowe". ";" . "złączki 4-śrubowe - bednarka". ";" . "złącze kontrolne". ";" . "puszki podtynkowe". ";" . "puszki gruntowe". ";" . "T-ki". ";" . "L-ki". ";" . "kotwy 18". ";" . "kotwy 20". ";" . "betoniki". ";" . "klej". ";" . "drut aluminium". ";" . "drut stal". ";" . "polwinit biały". ";" . "polwinit czarny". ";" . "bednarka 30x4". ";" . "bednarka 25x4". ";" . "sztyca 4m". ";" . "inne". "\n";
          fwrite($myfile, $txt);

          $conn = mysqli_connect($servername, $username, $password, $dbname);
          mysqli_query($conn,"SET CHARSET utf8");
          mysqli_query($conn,"SET NAMES 'utf8' COLLATE 'utf8_polish_ci'"); 
          // Check connection
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }


          $sql = "SELECT * FROM `wykonane_lokalizacja` WHERE `data` >= '$_POST[data3]' and `data` <= '$_POST[data4]' and `status`='zatwierdzony'";
                

          $result = mysqli_query($conn, $sql);
              

          if (mysqli_num_rows($result) > 0) {

              while ( $row = mysqli_fetch_row($result) ) {
                            
                echo "<table class=\"myTableRap\" border=\"1\"><tr>";
                echo "<td class=\"classOfRapTable\">Data<strong></strong></td>";
                echo "<td class=\"classOfRapTable\">Il. godzin<strong></strong></td>";
                echo "<td class=\"classOfRapTable\">Il. minut<strong></strong></td>";
                echo "<td class=\"classOfRapTable\">Miasto<strong></strong></td>";
                echo "<td class=\"classOfRapTable\">Ulica<strong></strong></td>";
                echo "<td class=\"classOfRapTable\">Numer<strong></strong></td>";
                echo "</tr>";

                echo "</tr>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 15%;\">" . $row[2] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[3] . "</td>";
                echo "<td class=\"classOfRapTableElements\" style=\"width: 5%;\">" . $row[4] . "</td>";
                echo "<td class=\"classOfRapTableElements\">" . $row[5] . "</td>";
                echo "<td class=\"classOfRapTableElements\">" . $row[6] . "</td>";
                echo "<td class=\"classOfRapTableElements\">" . $row[7] . "</td>";
                echo "</tr>";
                
                /*pomiary uziomów*/

                $sql_pomiary = "SELECT * FROM `wykonane_uziomy` WHERE `id_prac`= '$row[1]'";

                $result_pomiary = mysqli_query($conn, $sql_pomiary);

                if (mysqli_num_rows($result_pomiary) > 0) {

                  while ( $row_pomiary = mysqli_fetch_row($result_pomiary) ) {
          
                    echo "<table class=\"myTableRap\" border=\"1\"><tr>";
                    

                    if ($row_pomiary[2] == "" && $row_pomiary[3] == "" && $row_pomiary[4] == "" && $row_pomiary[5] == "" && $row_pomiary[6] == "" && $row_pomiary[7] == "" && $row_pomiary[8] == "" && $row_pomiary[9] == "" && $row_pomiary[10] == "" && $row_pomiary[11] == "" && $row_pomiary[12] == "" && $row_pomiary[13] == "" && $row_pomiary[14] == "" && $row_pomiary[15] == "" && $row_pomiary[16] == "" && $row_pomiary[17] == "" && $row_pomiary[18] == "" && $row_pomiary[19] == "" && $row_pomiary[20] == "" && $row_pomiary[21] == "" && $row_pomiary[22] == "" && $row_pomiary[23] == "" && $row_pomiary[24] == "" && $row_pomiary[25] == ""){                     
                    }
                    else{
                      echo "<h5 class=\"naglowek_raportu\">Pomiary:</h5>";
                      
                      if ($row_pomiary[2] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u1<strong></strong></td>";
                        }
                      if ($row_pomiary[3] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u2<strong></strong></td>";
                        }
                      if ($row_pomiary[4] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u3<strong></strong></td>";
                        }
                      if ($row_pomiary[5] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u4<strong></strong></td>";
                        }
                      if ($row_pomiary[6] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u5<strong></strong></td>";
                        }
                      if ($row_pomiary[7] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u6<strong></strong></td>";
                        }
                      if ($row_pomiary[8] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u7<strong></strong></td>";
                        }
                      if ($row_pomiary[9] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u8<strong></strong></td>";
                        }
                      if ($row_pomiary[10] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u9<strong></strong></td>";
                        }
                      if ($row_pomiary[11] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u10<strong></strong></td>";
                        }
                      if ($row_pomiary[12] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u11<strong></strong></td>";
                        }
                      if ($row_pomiary[13] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u12<strong></strong></td>";
                        }
                      if ($row_pomiary[14] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u13<strong></strong></td>";
                        }
                      if ($row_pomiary[15] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u14<strong></strong></td>";
                        }
                      if ($row_pomiary[16] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u15<strong></strong></td>";
                        }
                      if ($row_pomiary[17] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u16<strong></strong></td>";
                        }
                      if ($row_pomiary[18] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u17<strong></strong></td>";
                        }
                      if ($row_pomiary[19] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u18<strong></strong></td>";
                        }
                      if ($row_pomiary[20] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u19<strong></strong></td>";
                        }
                      if ($row_pomiary[21] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u20<strong></strong></td>";
                        }
                      if ($row_pomiary[22] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u21<strong></strong></td>";
                        }
                      if ($row_pomiary[23] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u22<strong></strong></td>";
                        }
                      if ($row_pomiary[24] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u23<strong></strong></td>";
                        }
                      if ($row_pomiary[25] != ""){
                        echo "<td class=\"classOfRapTableGrey\">u24<strong></strong></td>";
                        }            
                      
                        echo "</tr>";
      
                      if ($row_pomiary[2] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[2] . "</td>";
                        }
                      if ($row_pomiary[3] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[3] . "</td>";
                        }
                      if ($row_pomiary[4] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[4] . "</td>";
                        }  
                      if ($row_pomiary[5] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[5] . "</td>";
                        }
                      if ($row_pomiary[6] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[6] . "</td>";
                        }
                      if ($row_pomiary[7] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[7] . "</td>";
                        }
                      if ($row_pomiary[8] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[8] . "</td>";
                        }
                      if ($row_pomiary[9] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[9] . "</td>";
                        }  
                      if ($row_pomiary[10] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[10] . "</td>";
                        }
                      if ($row_pomiary[11] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[11] . "</td>";
                        }
                      if ($row_pomiary[12] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[12] . "</td>";
                        }
                      if ($row_pomiary[13] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[13] . "</td>";
                        }
                      if ($row_pomiary[14] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[14] . "</td>";
                        }  
                      if ($row_pomiary[15] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[15] . "</td>";
                        }
                      if ($row_pomiary[16] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[16] . "</td>";
                        }
                      if ($row_pomiary[17] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[17] . "</td>";
                        }
                      if ($row_pomiary[18] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[18] . "</td>";
                        }
                      if ($row_pomiary[19] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[19] . "</td>";
                        }  
                      if ($row_pomiary[20] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[20] . "</td>";
                        }
                      if ($row_pomiary[21] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[21] . "</td>";
                        }
                      if ($row_pomiary[22] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[22] . "</td>";
                        }
                      if ($row_pomiary[23] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[23] . "</td>";
                        }  
                      if ($row_pomiary[24] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[24] . "</td>";
                        }
                      if ($row_pomiary[25] != ""){
                        echo "<td class=\"classOfRapTableElements\">" . $row_pomiary[25] . "</td>";
                        }
                      echo "</tr>";
                      echo "</table>";
                    }
                  }
                }


              /*użyte materiały*/

              $sql_materialy = "SELECT * FROM `wykonane_materialy` WHERE `id_prac`= '$row[1]'";

              $result_materialy = mysqli_query($conn, $sql_materialy);

              if (mysqli_num_rows($result_materialy) > 0) {

                while ( $row_materialy = mysqli_fetch_row($result_materialy) ) {
        
                  echo "<table class=\"myTableRap\" border=\"1\"><tr>";
                  
                  if ($row_materialy[2] == "" && $row_materialy[3] == "" && $row_materialy[4] == "" && $row_materialy[5] == "" && $row_materialy[6] == "" && $row_materialy[7] == "" && $row_materialy[8] == "" && $row_materialy[9] == "" && $row_materialy[10] == "" && $row_materialy[11] == "" && $row_materialy[12] == "" && $row_materialy[13] == "" && $row_materialy[14] == "" && $row_materialy[15] == "" && $row_materialy[16] == "" && $row_materialy[17] == "" && $row_materialy[18] == "" && $row_materialy[19] == "" && $row_materialy[20] == "" && $row_materialy[21] == "" && $row_materialy[22] == ""){

                  }
                  else{
                    echo "<h5 class=\"naglowek_raportu\">Użyte materiały:</h5>";
                    
                    if ($row_materialy[2] != ""){
                      echo "<td class=\"classOfRapTableGreen\">uziomy<strong></strong></td>";
                      }
                    if ($row_materialy[3] != ""){
                      echo "<td class=\"classOfRapTableGreen\">złączki 2-śrubowe<strong></strong></td>";
                      }
                    if ($row_materialy[4] != ""){
                      echo "<td class=\"classOfRapTableGreen\">złączki 4-śrubowe<strong></strong></td>";
                      }
                    if ($row_materialy[5] != ""){
                      echo "<td class=\"classOfRapTableGreen\">złączki 4-śrubowe - bednarka<strong></strong></td>";
                      }
                    if ($row_materialy[6] != ""){
                      echo "<td class=\"classOfRapTableGreen\">złącze kontrolne<strong></strong></td>";
                      }
                    if ($row_materialy[7] != ""){
                      echo "<td class=\"classOfRapTableGreen\">puszki podtynkowe<strong></strong></td>";
                      }
                    if ($row_materialy[8] != ""){
                      echo "<td class=\"classOfRapTableGreen\">puszki gruntowe<strong></strong></td>";
                      }
                    if ($row_materialy[9] != ""){
                      echo "<td class=\"classOfRapTableGreen\">T-ki<strong></strong></td>";
                      }
                    if ($row_materialy[10] != ""){
                      echo "<td class=\"classOfRapTableGreen\">L-ki<strong></strong></td>";
                      }
                    if ($row_materialy[11] != ""){
                      echo "<td class=\"classOfRapTableGreen\">kotwy 18<strong></strong></td>";
                      }
                    if ($row_materialy[12] != ""){
                      echo "<td class=\"classOfRapTableGreen\">kotwy 20<strong></strong></td>";
                      }
                    if ($row_materialy[13] != ""){
                      echo "<td class=\"classOfRapTableGreen\">betoniki<strong></strong></td>";
                      }
                    if ($row_materialy[14] != ""){
                      echo "<td class=\"classOfRapTableGreen\">klej<strong></strong></td>";
                      }
                    if ($row_materialy[15] != ""){
                      echo "<td class=\"classOfRapTableGreen\">drut aluminium<strong></strong></td>";
                      }
                    if ($row_materialy[16] != ""){
                      echo "<td class=\"classOfRapTableGreen\">drut stal<strong></strong></td>";
                      }
                    if ($row_materialy[17] != ""){
                      echo "<td class=\"classOfRapTableGreen\">polwinit biały<strong></strong></td>";
                      }
                    if ($row_materialy[18] != ""){
                      echo "<td class=\"classOfRapTableGreen\">polwinit czarny<strong></strong></td>";
                      }
                    if ($row_materialy[19] != ""){
                      echo "<td class=\"classOfRapTableGreen\">bednarka 30x4<strong></strong></td>";
                      }
                    if ($row_materialy[20] != ""){
                      echo "<td class=\"classOfRapTableGreen\">bednarka 25x4<strong></strong></td>";
                      }
                    if ($row_materialy[21] != ""){
                      echo "<td class=\"classOfRapTableGreen\">sztyca 4m<strong></strong></td>";
                      }
                    if ($row_materialy[22] != ""){
                      echo "<td class=\"classOfRapTableGreen\">inne<strong></strong></td>";
                      }
                    
                      echo "</tr>";
    
                    if ($row_materialy[2] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[2] . "</td>";
                      }
                    if ($row_materialy[3] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[3] . "</td>";
                      }
                    if ($row_materialy[4] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[4] . "</td>";
                      }  
                    if ($row_materialy[5] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[5] . "</td>";
                      }
                    if ($row_materialy[6] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[6] . "</td>";
                      }
                    if ($row_materialy[7] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[7] . "</td>";
                      }
                    if ($row_materialy[8] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[8] . "</td>";
                      }
                    if ($row_materialy[9] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[9] . "</td>";
                      }  
                    if ($row_materialy[10] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[10] . "</td>";
                      }
                    if ($row_materialy[11] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[11] . "</td>";
                      }
                    if ($row_materialy[12] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[12] . "</td>";
                      }
                    if ($row_materialy[13] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[13] . "</td>";
                      }
                    if ($row_materialy[14] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[14] . "</td>";
                      }  
                    if ($row_materialy[15] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[15] . "</td>";
                      }
                    if ($row_materialy[16] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[16] . "</td>";
                      }
                    if ($row_materialy[17] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[17] . "</td>";
                      }
                    if ($row_materialy[18] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[18] . "</td>";
                      }
                    if ($row_materialy[19] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[19] . "</td>";
                      }  
                    if ($row_materialy[20] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[20] . "</td>";
                      }
                    if ($row_materialy[21] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[21] . "</td>";
                      }
                    if ($row_materialy[22] != ""){
                      echo "<td class=\"classOfRapTableElements\">" . $row_materialy[22] . "</td>";
                      }
                    
                    echo "</tr>";
                    echo "</table>";

                    $txt = $row[2]. ";" . $row[3]. ";" . $row[4]. ";" . $row[5]. ";" . $row[6]. ";" . $row[7] . ";". $row_materialy[2] . ";". $row_materialy[3] . ";". $row_materialy[4] . ";". $row_materialy[5] . ";". $row_materialy[6] . ";". $row_materialy[7] . ";". $row_materialy[8] . ";". $row_materialy[9] . ";". $row_materialy[10] . ";". $row_materialy[11] . ";". $row_materialy[12] . ";". $row_materialy[13] . ";". $row_materialy[14] . ";". $row_materialy[15] . ";". $row_materialy[16] . ";". $row_materialy[17] . ";". $row_materialy[18] . ";". $row_materialy[19] . ";". $row_materialy[20] . ";". $row_materialy[21] . ";". $row_materialy[22] ."\n";
                    fwrite($myfile, $txt); 
                    
                  }
                }
              }

              /*pliki*/

              
              if ($row[12] == 'plik'){
                echo "<h5 class=\"naglowek_raportu\">Załączniki:</h5>";
                echo "<a href=" .$location. "zalaczniki/$row[1].jpg" . " target=\"_blank\">Otwórz załącznik</a>";
              }

              echo "<div class=\"dotsDiv\"><img class=\"dots\" src=\"img/line.png\"/><img class=\"dots\" src=\"img/dots_poziom.png\"/><img class=\"dots\" src=\"img/line.png\"/></div>";
   
              }            
              echo "</table>";
              
            }
          else {
            echo "brak danych";
          }

          fclose($myfile);
          mysqli_close($conn);
        ?>
      </div>
    </div>
  </div>

  <!--<div class="container">
      <div class="row">
          <div class="col-sm-12 pt-5 pb-5">
            <h1 class="typeOfCourseText2 placeToSumAmount">Raport finansowy:</h1>
            
            <table class="myTableRap" style="border: 1;">
              <tr>
                <td class="classOfRapTable">Razem netto: <strong></strong></td>
                <td class="classOfRapTable">Razem brutto: <strong></strong></td>
                <td class="classOfRapTable">VAT 8: <strong></strong></td>
                <td class="classOfRapTable">VAT 23: <strong></strong></td>
                <td class="classOfRapTable">Razem VAT 8: <strong></strong></td>
                <td class="classOfRapTable">Razem VAT 23: <strong></strong></td>
                
              </tr>
              </tr>
                <td class="classOfRapTableElements"><?php echo $suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $suma_brutto?> zł</td>
                <td class="classOfRapTableElements"><?php echo $podatek_8_suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $podatek_23_suma?> zł</td>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_8?> zł</td>
                <td class="classOfRapTableElements"><?php echo $kwota_brutto_23?> zł</td>
              </tr>
            </table>
          </div>
      </div>
</div>-->

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
