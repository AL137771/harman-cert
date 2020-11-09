<?php

include "DB_CONN.php";
session_start();

if (isset($_SESSION['cert'])) {
  $query = "SELECT * FROM certsq WHERE idCertification = ". $_SESSION['cert'];
  $consulta  = $db-> query($query);
}



if (isset($_POST['Trace_Created_Certification'])) {

    $idCertification = $_POST['idCertification'];
   $query = "SELECT * FROM certsq WHERE idCertification = ". $idCertification;
   $consulta  = $db-> query($query);
} 



?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
</head>

<body>

  <div class="d-flex" id="wrapper">
  
  <?php 
  if ($_SESSION['typeUser'] == 1) {
    include "Trainer_Template.php";
  } else {
    include "Admin_Template.php";
  }
   
  ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">SEGUIMIENTO CERTIFICACION</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            
            </li>
            <li class="nav-item">
          
            </li>
            <li class="nav-item dropdown">
            
            </li>
          </ul>
        </div>
      </nav>
      <form action=<?php if ($_SESSION['typeUser'] == 1) {
        echo '"Trainer_MainPage.php"';
    }
    elseif ($_SESSION['typeUser'] == 2) {
        echo '"Admin_MainPage.php"';
    } ?> method="POST" name='sq1'>
       
                    <?php     

                  date_default_timezone_set('America/Chihuahua');
                  $date = date('Y-m-d');

                      include "Table_Template.php";               
                        while($row = $consulta -> fetch_assoc()){
                            echo '<tr class="table-primary">';
                            echo '<td><input type="hidden" name="date_1" value="'.$row['date_1'].'">'.$row['date_1'].'</td>';
                            echo '<td><input type="hidden" name="av_1" value="'.$row['av_1'].'">'.$row['av_1'].'</td>';
                            echo '<td><input type="hidden" name="it_1" value="'.$row['it_1'].'">'.$row['it_1'].'</td>';
                            echo '<td><input type="hidden" name="idCertification" value="'.$row['idCertification'].'"></td>';
                            echo '<td><input type="hidden" name="teo_1" value="'.$row['teo_1'].'">'.$row['teo_1'].'</td>';
                            echo '<td><input type="hidden" name="pra_1" value="'.$row['pra_1'].'">'.$row['pra_1'].'</td>';
                            echo '</tr>';
                            
                            if ($row['av_2'] > 0) {
                            
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_2" value="'.$row['date_2'].'">'.$row['date_2'].'</td>';
                                echo '<td><input type="hidden" name="av_2" value="'.$row['av_2'].'">'.$row['av_2'].'</td>';
                                echo '<td><input type="hidden" name="it_2" value="'.$row['it_2'].'">'.$row['it_2'].'</td>';
                                echo '<td><//td>';
                                echo '<td><input type="hidden" name="teo_2" value="'.$row['teo_2'].'">'.$row['teo_2'].'</td>';
                                echo '<td><input type="hidden" name="pra_2" value="'.$row['pra_2'].'">'.$row['pra_2'].'</td>';
                                echo '</tr>';                             
                            } else {
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_2" value="'.$date.'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="5" name="av_2" value="'.$row['av_2'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="5" name="it_2" value="'.$row['it_2'].'"></td>';
                                echo '<td></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="6" name="teo_2" value="'.$row['teo_2'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="6" name="pra_2" value="'.$row['pra_2'].'"></td>';
                                echo '</tr>';
                            }

                            if ($row['av_3'] > 0) {
                            
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_3" value="'.$row['date_3'].'">'.$row['date_3'].'</td>';
                                echo '<td><input type="hidden" name="av_3" value="'.$row['av_3'].'">'.$row['av_3'].'</td>';
                                echo '<td><input type="hidden" name="it_3" value="'.$row['it_3'].'">'.$row['it_3'].'</td>';
                                echo '<td><//td>';
                                echo '<td><input type="hidden" name="teo_3" value="'.$row['teo_3'].'">'.$row['teo_3'].'</td>';
                                echo '<td><input type="hidden" name="pra_3" value="'.$row['pra_3'].'">'.$row['pra_3'].'</td>';
                                echo '</tr>';                             
                            } else {
                              echo '<tr class="table-primary">';
                          
                                echo '<td><input type="hidden" name="date_3" value="'.$date.'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="av_3" value="'.$row['av_3'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="it_3" value="'.$row['it_3'].'"></td>';
                                echo '<td></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="8" name="teo_3" value="'.$row['teo_3'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="8" name="pra_3" value="'.$row['pra_3'].'"></td>';
                                echo '</tr>';
                            }


                            if($row['av_4'] == 0 AND $row['it_4'] == 0 AND $row['ap_1'] == 0 AND $row['teo_4'] == 0 AND $row['pra_4'] == 0 ) {
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_4" value="'.$date.'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="av_4" value="'.$row['av_4'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="it_4" value="'.$row['it_4'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="ap_1" value="'.$row['ap_1'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="teo_4" value="'.$row['teo_4'].'"></td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="pra_4" value="'.$row['pra_4'].'"></td>';
                                echo '</tr>';
                            }
                            elseif ($row['av_4'] > 0 AND $row['it_4'] > 0 AND $row['ap_1'] > 0 AND $row['teo_4'] > 0 AND $row['pra_4'] > 0 ) {
                            
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_4" value="'.$row['date_4'].'">'.$row['date_4'].'</td>';
                                echo '<td><input type="hidden" name="av_4" value="'.$row['av_4'].'">'.$row['av_4'].'</td>';
                                echo '<td><input type="hidden" name="it_4" value="'.$row['it_4'].'">'.$row['it_4'].'</td>';
                                echo '<td><input type="hidden" name="ap_1" value="'.$row['ap_1'].'">'.$row['ap_1'].'</td>';
                                echo '<td><input type="hidden" name="teo_4" value="'.$row['teo_4'].'">'.$row['teo_4'].'</td>';
                                echo '<td><input type="hidden" name="pra_4" value="'.$row['pra_4'].'">'.$row['pra_4'].'</td>';
                                echo '</tr>';                             
                            } elseif($row['av_4'] > 0 AND $row['it_4'] > 0 AND $row['ap_1'] == 0 AND $row['teo_4'] > 0 AND $row['pra_4'] > 0 ) {
                              echo '<tr class="table-primary">';
                                echo '<td><input type="hidden" name="date_4" value="'.$row['date_4'].'">'.$row['date_4'].'</td>';
                                echo '<td><input type="hidden" name="av_4" value="'.$row['av_4'].'">'.$row['av_4'].'</td>';
                                echo '<td><input type="hidden" name="it_4" value="'.$row['it_4'].'">'.$row['it_4'].'</td>';
                                echo '<td><input class="form-control" type="number" min="0" max="10" name="ap_1" value="'.$row['ap_1'].'"></td>';
                                echo '<td><input type="hidden" name="teo_4" value="'.$row['teo_4'].'">'.$row['teo_4'].'</td>';
                                echo '<td><input type="hidden" name="pra_4" value="'.$row['pra_4'].'">'.$row['pra_4'].'</td>';
                                echo '</tr>';
                            }
                            


                        
                        
                        }
                
                    ?>
            
                     </div>
            </div>
        </table>     
        
        <?php if ($_SESSION['typeUser'] == 1) {
           echo ' <div class="row">
           <div class="col-sm-4"></div>
           <button class="col-sm-4 btn btn-primary" type="submit" value="Guardar datos" name="Update_Trace_Certification"><i class="fas fa-sign-in-alt"></i></button>
            </div> ';
            echo '<br><br>';
       echo  '<div class="row">';
        echo '<div class="col-sm-4"></div>';
        echo ' <button class="col-sm-4 btn btn-danger" formaction="Trainer_MainPage.php"  type="submit" value="Guardar datos" ><i class="fas fa-undo-alt"></i></i></button>
                      </div>'; 
    }
    elseif ($_SESSION['typeUser'] == 2) {
        echo  '<div class="row">';
        echo '<div class="col-sm-3"></div>';
        echo '<a href="Admin_MainPage.php"  class="col-sm-3 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
                      </div>'; 
    } ?>
        
        
        
    </form>
<br><br>
<?php include "Guide_Table.php" ?>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


     <!-- jQuery, Popper.js, Bootstrap JS -->
     <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
</body>

</html>
