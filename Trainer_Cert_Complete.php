<?php 
session_start();
include 'DB_CONN.php';
include 'Modal.php';


if(isset($_SESSION['fail'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['fail'] . "');
          </script>";
    //to not make the error message appear again after refresh:
    unset($_SESSION['fail']);
  }

 if(isset($_SESSION['win'])){
    echo "<script type='text/javascript'>
            alert('" . $_SESSION['win'] . "');
          </script>";
    //to not make the error message appear again after refresh:
    unset($_SESSION['win']);
  }





if(isset($_POST['Update_Trace_Certification'])){    

$idCertification = $_POST['idCertification'];
$date_1 = $_POST['date_1'];
$av_1 = $_POST['av_1'];
$it_1 = $_POST['it_1'];
$teo_1 = $_POST['teo_1'];
$pra_1 = $_POST['pra_1'];

//$date_2 = $_POST['date_2'];
$av_2 = $_POST['av_2'];
$it_2 = $_POST['it_2'];
$teo_2 = $_POST['teo_2'];
$pra_2 = $_POST['pra_2'];

//$date_3 = $_POST['date_3'];
$av_3 = $_POST['av_3'];
$it_3 = $_POST['it_3'];
$teo_3 = $_POST['teo_3'];
$pra_3 = $_POST['pra_3'];

//$date_4 = $_POST['date_4'];
$av_4 = $_POST['av_4'];
$it_4 = $_POST['it_4'];
$ap_1 = $_POST['ap_1'];
$teo_4 = $_POST['teo_4'];
$pra_4 = $_POST['pra_4'];

if ($av_1 > 0) {
    date_default_timezone_set('America/Chihuahua');
    $date_2 = date('Y-m-d');
}

if ($av_1 > 0 and $av_2 > 0  ) {
    date_default_timezone_set('America/Chihuahua');
    $date_3 = date('Y-m-d');
}
$date_4 = $date_3;

if ($av_1 > 0 and $av_2 > 0 and $av_3 > 0  ) {
    date_default_timezone_set('America/Chihuahua');
    $date_4 = date('Y-m-d');
}

$sq = 'UPDATE certsq SET 
            date_1  = '.'"'.$date_1.'"'.', 
            av_1    = '.$av_1.',
            it_1    = '.$it_1.',
            teo_1   = '.$teo_1.',
            pra_1   = '.$pra_1.',
            date_2  = '.'"'.$date_2.'"'.', 
            av_2    = '.$av_2.',
            it_2    = '.$it_2.',
            teo_2   = '.$teo_2.',
            pra_2   = '.$pra_2.',
            date_3  = '.'"'.$date_3.'"'.', 
            av_3    = '.$av_3.',
            it_3    = '.$it_3.',
            teo_3   = '.$teo_3.',
            pra_3   = '.$pra_3.',
            date_4  = '.'"'.$date_4.'"'.', 
            av_4    = '.$av_4.',
            it_4    = '.$it_4.',
            ap_1    = '.$ap_1.',
            teo_4   = '.$teo_4.',
            pra_4   = '.$pra_4.'
            WHERE idCertification ='.$idCertification;

if ($db->query($sq) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sq . "<br>" . $db->error;
}
 
}


if(isset($_POST['Certification_Tracing_Values'])){    

    date_default_timezone_set('America/Chihuahua');
$date = date('Y-m-d H:i:s');
    $av_1 = $_POST['av_1'];
    $it_1 = $_POST['it_1'];
    $teo_1 = $_POST['teo_1'];
    $pra_1 = $_POST['pra_1'];
    $idCertification = $_SESSION['id2'];

    
    $sq = 'UPDATE certsq SET 
                date_1  = '.'"'.$date.'"'.', 
                av_1    = '.$av_1.',
                it_1    = '.$it_1.',
                teo_1   = '.$teo_1.',
                pra_1   = '.$pra_1.'
                WHERE idCertification ='.$idCertification;
    
    if ($db->query($sq) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sq . "<br>" . $db->error;
    }
     
    }



    if(isset($_POST['sq3'])){    


        $date_1 = $_POST['date_1'];
        $av_1 = $_POST['av_1'];
        $it_1 = $_POST['it_1'];
        $ap_1 = $_POST['ap_1'];
        $teo_1 = $_POST['teo_1'];
        $pra_1 = $_POST['pra_1'];
        
        
        
        $sq = 'UPDATE recertsq SET 
                    date_1  = '.'"'.$date_1.'"'.', 
                    av_1    = '.$av_1.',
                    it_1    = '.$it_1.',
                    ap_1    = '.$ap_1.',
                    teo_1   = '.$teo_1.',
                    pra_1   = '.$pra_1.'
                    WHERE idCertification ='.$_SESSION['id3'];
        
        if ($db->query($sq) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sq . "<br>" . $db->error;
        }
         
        }


       $query = 'SELECT DISTINCT certsq.idCertification, certsq.idTrainer, trainers.nameTrainer, certsq.idArea, area.nombreArea, 
        certsq.idOperacion, operacion.nOperacion , certsq.idComplejidad, complejidad.tipoComplejidad, 
        certsq.idEmpleado, certsq.nameEmpleado, certsq.lastUp , certsq.fechaCreacion, 
        certsq.progress, certsq.calification, certsq.attempts, testtaken.date
          FROM certsq 
          INNER JOIN areaxtrainer ON areaxtrainer.idTrainer = certsq.idTrainer
          INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
          INNER JOIN area ON area.idArea = certsq.idArea
          INNER JOIN operacion ON operacion.idOperacion = certsq.idOperacion
          INNER JOIN complejidad ON complejidad.idComplejidad = certsq.idComplejidad
          LEFT JOIN testtaken ON testtaken.idCertification = certsq.idCertification
          WHERE trainers.idTrainer = '.$_SESSION['id'].' AND certsq.progress >= 150 AND active = 1' ;

            $search = $db -> query($query);
         


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

  <?php include "Trainer_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">CERTIFICACIONES COMPLETADAS</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <form action="" method='POST'>
            <button class="btn btn-warning" formaction="Trainer_MainPage.php" name="Exchange_Op" type="submit">
            <i class="fas fa-exclamation-circle"></i></button>
            </form>
            </li>
            <li class="nav-item">
             
            </li>
            <li class="nav-item dropdown">
              
              
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
      <div class='row'>    
        
        <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="example" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>AREA</td>
                                <td>OPERACION</td>
                                <td>COMPLEJIDAD</td>
                                <td>#</td>
                                <td>EMPLEADO</td>
                                <td>FECHA CREACION</td>
                                <td></td>
                                <td></td>
                                <td>ULTIMA ACTUALIZACION</td>
                                <td>EXAMEN</td> 
                                <td></td>
                                <td>CALIFICACION</td>
                                <td>RECERTIFICACION</td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $search->fetch_array()) {
                                      $value = $data['progress'];
                                        $max_value = 150;
                                        $max_percent = 100;
        
                                        
                                        $prom = ($value * $max_percent) / $max_value;
                                        
                                        if($prom > 100){
                                            $prom = 100;
                                        }
                                    echo '<tr>';
                                    echo   '<form action="" method="POST">';
                                    echo '<input type="hidden" name="idTrainer" value='.$data['idTrainer'].'>';
                                    echo '<input type="hidden" name="attempts" value='.$data['attempts'].'>';
                                    echo '<td><input type="hidden" name="idCertification" value='.$data['idCertification'].'>'.$data['idCertification'].'</td>';;
                                    echo  '<td><input type="hidden" name="area" value="'.$data['idArea'].'">'.$data['nombreArea'].'</td>';
                                    echo  '<td><input type="hidden" name="operacion" value="'.$data['idOperacion'].'">'.$data['nOperacion'].'</td>';
                                    echo  '<td><input type="hidden" name="complejidad" value="'.$data['idComplejidad'].'">'.$data['tipoComplejidad'].'</td>';
                                    echo  '<td><input type="hidden" name="idEmpleado" value="'.$data['idEmpleado'].'">'.$data['idEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="nameEmpleado" value="'.$data['nameEmpleado'].'">'.$data['nameEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="fechaCreacion" value="'.$data['fechaCreacion'].'">'.$data['fechaCreacion'].'</td>';
                                    echo  '<td><button type="submit" formaction="Trace_Created_Certification.php" name="Trace_Created_Certification" class="btn btn-outline-info"><i class="fas fa-clipboard"></i></button></td>';
                                    echo  '<td><button type="submit" formaction="Record_Certification.php" name="Record_Certification" 
                                    class="btn btn-outline-success">
                                    <i class="fas fa-history"></i></button></td>';
                                    echo  '<td>'.$data['lastUp'].'</td>';              
                                
                               
                                            if ($data['calification'] > 8) {
                                              echo '<td>N/A</td>'; 
                                              } else {
                                              echo  '<td><button type="submit" formaction="Apply_Test.php" name="Apply_Test" 
                                            class="btn btn-outline-success"> <i class="fas fa-user-graduate"></i></button></td>';
                              
                                              }

                                      if ($data['calification'] > 0) {
                                        echo  '<td><button type="submit" formaction="See_Test.php" name="Apply_Test" 
                                        class="btn btn-outline-success"> <i class="fas fa-eye"></i></button></td>';
                                      } else {
                                        echo '<td></td>';
                                      }
                                echo  '<td><input type="hidden" name="calification" value="'.$data['calification'].'">'.$data['calification'].'</td>';                             
                                              
                                if ($data['calification'] < 8) {
                                  echo "<td></td>";
                              } else {
                                    if ($data['idComplejidad'] == 1 OR $data['idComplejidad'] == 2 
                                    OR $data['idComplejidad'] == 3) {
                                     
                                      $date1 = date('Y-m-d', strtotime($data['date'].'+ 365 days'));
                                      $date2 = date('Y-m-d', strtotime($date));

                                          // Calulating the difference in timestamps 
                                          $diff = strtotime($date2) - strtotime($date1); 
                                            
                                          // 1 day = 24 hours 
                                          // 24 * 60 * 60 = 86400 seconds 
                                       $dateDiff =  round($diff / 86400); 
                                    
                                      if ($dateDiff > 0 ) {
                                        echo '<td><button type="submit" formaction="Create_Recert_From_Cert.php" name="Create_Recert_From_Cert" 
                                        class="btn btn-outline-success"><i class="fas fa-file-alt"></i></button></td>';
                                      } else {
                                        echo '<td><strong>'.abs($dateDiff).'</strong> dias para recertificar</td>';
                                      }
  
                                     
                                     
                                     
                                      /// echo '<td>Faltan:'.$tiemporestante.' dias</td>';
                                  
                                    }
                                    elseif ($data['idComplejidad'] == 4) {
                                      $date1 = date('Y-m-d', strtotime($data['date'].'+ 187 days'));
                                      $date2 = date('Y-m-d', strtotime($date));

                                          // Calulating the difference in timestamps 
                                          $diff = strtotime($date2) - strtotime($date1); 
                                            
                                          // 1 day = 24 hours 
                                          // 24 * 60 * 60 = 86400 seconds 
                                       $dateDiff =  round($diff / 86400); 
                                    
                                      if ($dateDiff > 0 ) {
                                        echo '<td><button type="submit" formaction="Create_Recert_From_Cert.php" name="Create_Recert_From_Cert" 
                                        class="btn btn-outline-success"><i class="fas fa-file-alt"></i></button></td>';
                                      } else {
                                        echo '<td><strong>'.abs($dateDiff).'</strong> dias para recertificar</td>';
                                      }
                            
                                        }
                              
                               
                              
                            }   
                               
                                echo '</tr>';
                                echo '</form>';
                                    
                                    
                              

                            }   
                                    
                                ?>
                            </tbody>
                    </table>                  
                    </div>
                </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
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
