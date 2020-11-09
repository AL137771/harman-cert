<?php 
session_start();
include 'DB_CONN.php';


if(isset($_SESSION['done'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['done'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['done']);
  echo "<script>window.close();</script>";
}

if(isset($_SESSION['empRestriction'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['empRestriction'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['empRestriction']);
  echo "<script>window.close();</script>";

}

if (isset($_POST['Change_Area_Certification'])) {

$trainer = $_POST['trainer'];

$area = $_POST['area'];


  $query = 'UPDATE certsq
            SET certsq.idTrainer = '.$trainer.'
                WHERE certsq.idTrainer = '.$_SESSION['id'].'
                  AND certsq.idArea = "'.$area.'"';

                 if ($db->query($query) === TRUE) {
                   echo "";
                 } else {
                   echo  $db->error;
                 }
}

if (isset($_POST['Add_Answers'])) {
 $idCertification = $_POST['idCertification'];
  $question =  array($_POST['question_1'], $_POST['question_2'],$_POST['question_3'] ,$_POST['question_4']
                      ,$question_5 = $_POST['question_5'],$_POST['question_6'], $_POST['question_7'],
                      $_POST['question_8'],$_POST['question_9'],$_POST['question_10'],$_POST['question_10']);
  
 $answer = array($_POST['answer_1'], $_POST['answer_2'], $_POST['answer_3'],$_POST['answer_4'], $_POST['answer_5'],
                  $_POST['answer_6'], $_POST['answer_7'], $_POST['answer_8'], $_POST['answer_9'], $_POST['answer_10'],
                  $_POST['answer_11']); 
  
 //   $value = array($_POST['ans1'], $_POST['ans2'], $_POST['ans3'], $_POST['ans4'], $_POST['ans5'], $_POST['ans6'],
   //             $_POST['ans7'], $_POST['ans8'], $_POST['ans9'], $_POST['ans10'], $_POST['ans11']);



for ($i=0; $i < 11; $i++) { 
  $query = 'INSERT INTO answeredtest (idQuestion, idCertification,  idAnswer) 
                  VALUES ('.$question[$i].','.$idCertification.','.$answer[$i].')';
                  if ($db -> query($query) === TRUE) {
                   echo "";
                   echo "<br>";
                  } else {
                    echo "MAL.". $db->error;
                  }
                  
}

$query = 'SELECT answeredtest.idCertification, SUM(answer.value) as total
          FROM answeredtest
          INNER JOIN answer ON answer.idAnswer = answeredtest.idAnswer
          WHERE answeredtest.idCertification ='.$idCertification;
          
          $query = $db->query($query);

          $row = $query->fetch_assoc();

          $totalPreguntas = 11 ;
          $totalAciertos = $row['total'];
          $calificacionMaxima = 10;

          echo 'Obtuviste '.$totalAciertos.'aciertos';
          $regladetres = ($totalAciertos*$calificacionMaxima)/$totalPreguntas;
          echo 'La Calificacion final del examen es'.$regladetres;


        
  
}

if (isset($_POST['Change_Trainer_Certification'])) { ////////////////////DOOOOOOOOOOOOOOOOONE
    $trainer = $_POST['trainer'];
    $idCertification = $_POST['idCertification'];

    $sqqq = 'UPDATE certsq SET 
                idTrainer  = '.'"'.$trainer.'"'.'
                WHERE idTrainer ='.'"'.$_SESSION['id'].'" and idCertification ="'.$idCertification.'"';
    if ($db->query($sqqq) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sq . "<br>" . $db->error;
    }
} 




if(isset($_SESSION['errorMessage'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['errorMessage'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['errorMessage']);
  echo "<script>window.close();</script>";
}

if(isset($_SESSION['turnRestriction'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['turnRestriction'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['turnRestriction']);
  echo "<script>window.close();</script>";
}

if(isset($_SESSION['dayRestriction'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['dayRestriction'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['dayRestriction']);
  echo "<script>window.close();</script>";
}



/*if(isset($_SESSION['turnoerrorMessage'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['turnoerrorMessage'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['errorMessage']);
}*/

if (isset($_GET['id_delete'])) {

    $cert = $_GET['id_delete'];
   $query1 = "DELETE FROM certsq WHERE idCertification = ". $cert;
   $consulta  = $db-> query($query1);
}




if(isset($_POST['Update_Trace_Certification'])){    

$idCertification = $_POST['idCertification'];
$date_1 = $_POST['date_1'];
$av_1 = $_POST['av_1'];
$it_1 = $_POST['it_1'];
$teo_1 = $_POST['teo_1'];
$pra_1 = $_POST['pra_1'];

$date_2 = $_POST['date_2'];
$av_2 = $_POST['av_2'];
$it_2 = $_POST['it_2'];
$teo_2 = $_POST['teo_2'];
$pra_2 = $_POST['pra_2'];

$date_3 = $_POST['date_3'];
$av_3 = $_POST['av_3'];
$it_3 = $_POST['it_3'];
$teo_3 = $_POST['teo_3'];
$pra_3 = $_POST['pra_3'];

$date_4 = $_POST['date_4'];
$av_4 = $_POST['av_4'];
$it_4 = $_POST['it_4'];
$ap_1 = $_POST['ap_1'];
$teo_4 = $_POST['teo_4'];
$pra_4 = $_POST['pra_4'];

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

        

        $query = 'INSERT INTO califications (idCertification, calification)
        VALUES ('.$idCertification.','.$regladetres.')';
        $db->query($query);

        $query = 'SELECT DISTINCT certsq.idCertification, certsq.idTrainer, trainers.nameTrainer, certsq.idArea, area.nombreArea, 
        certsq.idOperacion, operacion.nOperacion , certsq.idComplejidad, complejidad.tipoComplejidad, 
        certsq.idEmpleado, certsq.nameEmpleado, certsq.lastUp , certsq.fechaCreacion, 
        certsq.progress
          FROM certsq 
          INNER JOIN areaxtrainer ON areaxtrainer.idTrainer = certsq.idTrainer
          INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
          INNER JOIN area ON area.idArea = certsq.idArea
          INNER JOIN operacion ON operacion.idOperacion = certsq.idOperacion
          INNER JOIN complejidad ON complejidad.idComplejidad = certsq.idComplejidad
          WHERE trainers.idTrainer = '.$_SESSION['id'].' AND certsq.progress < 150 AND certsq.active = 1' ; ;

            $search = $db -> query($query);
            
            
            if (isset($_GET['id_delete'])) {
            
                $cert = $_GET['id_delete'];
               $query1 = "DELETE FROM certsq WHERE idCertification = ". $cert;
               $consulta  = $db-> query($query1);
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

  <?php include "Trainer_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">CERTIFICACIONES EN PROGRESO</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <form action="" method='POST'>
            <button class="btn btn-success" formaction="Trainer_Cert_Complete.php" name="Exchange_Op" type="submit">
            <i class="fas fa-check"></i></i></button>
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
                    <table id="example" class="table table-bordered table-hover table-striped table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>AREA</strong></td>
                                <td><strong>OPERACION</strong></td>
                                <td><strong>COMPLEJIDAD</strong></td>
                                <td><strong>#</strong></td>
                                <td><strong>EMPLEADO</strong></td>
                                <td><strong>FECHA CREACION</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>ULTIMA ACTUALIZACION</strong></td>
                                <td><strong>TOT HRS</strong></td>
                                <td><strong>PROGRESO</strong></td>
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
                                    echo '<input type="hidden" name="av_1" value='.$data['av_1'].'>';
                                    echo '<input type="hidden" name="av_2" value='.$data['av_2'].'>';
                                    echo '<input type="hidden" name="av_3" value='.$data['av_3'].'>';
                                    echo '<input type="hidden" name="av_4" value='.$data['av_4'].'>';
                                    echo '<td><input type="hidden" name="idCertification" value='.$data['idCertification'].'>'.$data['idCertification'].'</td>';;
                                    echo  '<td><input type="hidden" name="area" value="'.$data['idArea'].'">'.$data['nombreArea'].'</td>';
                                    echo  '<td><input type="hidden" name="operacion" value="'.$data['idOperacion'].'">'.$data['nOperacion'].'</td>';
                                    echo  '<td><input type="hidden" name="complejidad" value="'.$data['idComplejidad'].'">'.$data['tipoComplejidad'].'</td>';
                                    echo  '<td><input type="hidden" name="idEmpleado" value="'.$data['idEmpleado'].'">'.$data['idEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="nameEmpleado" value="'.$data['nameEmpleado'].'">'.$data['nameEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="fechaCreacion" value="'.$data['fechaCreacion'].'">'.$data['fechaCreacion'].'</td>';
                                    echo  '<td><button type="submit" formaction="Change_Trainer_Certification.php" name="change_Certification_Trainer" class="btn btn-outline-primary"><i class="fas fa-sync-alt"></i></button></td>';
                                    echo  '<td><button type="submit" formaction="Trace_Created_Certification.php" name="Trace_Created_Certification" class="btn btn-outline-info"><i class="fas fa-clipboard"></i></button></td>';
                                    echo  '<td><button type="submit" formaction="Record_Certification.php" name="Record_Certification" 
                                    class="btn btn-outline-success">
                                    <i class="fas fa-history"></i></button></td>';
                                    
                               if ($value < 150 ) {
                                
                                echo  '<td><button type="submit" formtarget="_blank" formaction="Add_Hours.php" name="Add_Hours_Certification" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i></button></td>';
                                echo  '<td><input type="hidden" name="lastUp" value="'.$data['lastUp'].'">'.$data['lastUp'].'</td>';
                                echo  '<td>'.$data['progress'].' HRS</td>';
                                echo '<td><div class="progress" style="height: 32px;">
                                <div class="progress-bar progress-bar-animated progress-bar-striped bg-warning" 
                                            role="progressbar" text-dark aria-valuenow=""aria-valuemin="0" 
                                            aria-valuemax="150" style="color:black ;
                                             width:'.$prom.'%">'.round($prom, 2).'%
                                </div>
                              </div>
                              </div></td>';
                                echo '</form>';
                                echo '</tr>';
                              } 
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
