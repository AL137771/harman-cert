<?php

session_start();
include 'DB_CONN.php';
if(isset($_SESSION['fail'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['fail'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['fail']);
}



if (isset($_POST['Add_Answers'])) {
  $idCertification = $_POST['idCertification'];
  $nquestions = $_POST['nquestions'];
  $idTest = $_POST['idTest'];
  $questions =  array($_POST['question_1'], $_POST['question_2'],$_POST['question_3'] ,$_POST['question_4']
  ,$question_5 = $_POST['question_5'],$_POST['question_6'], $_POST['question_7'],
  $_POST['question_8'],$_POST['question_9'],$_POST['question_10'],$_POST['question_11']
  ,$_POST['question_12'],$_POST['question_13'],$_POST['question_14']);

$answer = array($_POST['answer_1'], $_POST['answer_2'], $_POST['answer_3'],$_POST['answer_4'], $_POST['answer_5'],
$_POST['answer_6'], $_POST['answer_7'], $_POST['answer_8'], $_POST['answer_9'], $_POST['answer_10'],
$_POST['answer_11'],
$_POST['answer_12'],
$_POST['answer_13'], 
$_POST['answer_14']); 
   
                   if ($_POST['attempts'] == 0 ) {

                    $query = 'INSERT INTO esptesttaken (idCertification, idTest,  date) 
                                  VALUES ('.$idCertification.', '.$idTest.', "'.$date.'")';
                                  if ($db -> query($query) === TRUE) {
                                   echo "";
                                  
                                  } else {
                                    echo "MAL.". $db->error;
                                  }
                
                
                         $query = 'SELECT * FROM esptesttaken WHERE idCertification ='.$idCertification ;
                         $i = $db->query($query);
                         
                         $row = $i ->fetch_assoc();
                
                              for ($i=0; $i < $nquestions; $i++) { 
                
                                 $query = 'INSERT INTO espanswerstest (idTestTaken, idQuestion, idAnswer)
                                        VALUES ("'.$row['idTestTaken'].' ", "'.$questions[$i].'", "'.$answer[$i].'")';
                                          if ($db -> query($query) === TRUE) {
                                            echo "";
                                          
                                          } else {
                                            echo "MAL.". $db->error;
                                          }
                                 }
                
                                 
                      
                        } else {
                
                          $query = 'SELECT * FROM esptesttaken WHERE idCertification ='.$idCertification ;
                          $i = $db->query($query);
                          
                          $row = $i ->fetch_assoc();
                
                
                          for ($i=0; $i < $nquestions; $i++) { 
                                  $query = 'UPDATE espanswerstest
                                        SET idAnswer = "'.$answer[$i].'"
                                        WHERE idTestTaken = '.$row['idTestTaken'].'
                                        AND idQuestion ='.$questions[$i];
                
                
                                  if ($db -> query($query) === TRUE) {
                                    echo "";
                                   
                                   } else {
                                     echo "MAL.". $db->error;
                                   }
                          }
                        
                        }

                        $query = 'SELECT esptesttaken.idTestTaken , SUM(answer.value) as total
                        FROM espanswerstest
                        INNER JOIN answer ON answer.idAnswer = espanswerstest.idAnswer
                        INNER JOIN esptesttaken ON esptesttaken.idTestTaken = espanswerstest.idTestTaken
                        WHERE esptesttaken.idCertification ='.$idCertification;
                        
                        $query = $db->query($query);
                        
                        $row = $query->fetch_assoc();
                        
                        $totalAciertos = $row['total'];
                        $calificacionMaxima = 10;
                        $regladetres = ($totalAciertos*$calificacionMaxima)/$nquestions;
             if ($regladetres >= 8 ) {
                 $query = 'UPDATE sp_recert SET
                            calification = '.$regladetres.'
                            WHERE idCertification ='.$idCertification;
                             $db->query($query);
 
                             
             }
             else {
 
                 $query = 'UPDATE sp_recert SET
                 calification = '.$regladetres.'
                 WHERE idCertification ='.$idCertification;
                  $db->query($query);
 
                  $query = 'SELECT attempts FROM sp_recert where idCertification ='.$idCertification;
                  $i = $db->query($query);
                   $attempt = $i ->fetch_assoc();
                 
                   if ($attempt['attempts'] == 0) {
                     $query = 'UPDATE sp_recert
                             SET attempts = 1 WHERE idCertification = "'.$idCertification.'"';
                              $db ->query($query);
                             $_SESSION['attempt'] = 1;
 
                   } elseif ($attempt['attempts'] == 1) {
                     $query = 'UPDATE sp_recert
                             SET attempts = 2 WHERE idCertification ='.$idCertification;
                              $db ->query($query);
                             $_SESSION['attempt'] = 2;
 
                   }  elseif ($attempt['attempts'] == 2) {
 
                     $query = 'UPDATE sp_recert
                     SET attempts = 3 WHERE idCertification ='.$idCertification;
 
                     if ( $db ->query($query) === TRUE) {
                       $query = 'UPDATE sp_recert
                       SET active = 0 WHERE idCertification ='.$idCertification;
                       $db ->query($query);
                       $_SESSION['attempt'] = 3;
                     }
 
                    
 
                  
                   }
 
               /* $query = 'DELETE FROM answeredTest WHERE idCertification ='.$idCertification;
                 $db->query($query);*/
                 $_SESSION['calif'] = $regladetres;
                 $_SESSION['fail'] ="HAS REPROBADO PAPI, TU CALIFICACION FUE ".$_SESSION['calif'].", llevas ".$_SESSION['attempt']." intentos";
                 header("Location: Trainer_SP_Recert.php");     
             
 }
 
   
 }
 



if (isset($_POST['Send_Area_Info'])) {
  $trainer = $_SESSION['id'];
  $area = $_POST['area'];
  $operacion = $_POST['operacion'];
  $complejidad = $_POST['complejidad'];
  $idEmpleado = $_POST['idEmpleado'];
  $nameEmpleado = $_POST['nameEmpleado'];


  
$sql = "INSERT INTO sp_recert  (idTrainer, idArea, idOperacion, idComplejidad, idEmpleado, nameEmpleado, fechaCreacion)
VALUES ('$trainer', '$area', '$operacion', '$complejidad', '$idEmpleado', '$nameEmpleado', '$date')";

$db->query($sql);

}


$query = 'SELECT DISTINCT sp_recert.idCertification, sp_recert.idTrainer, trainers.nameTrainer, sp_recert.idArea, area.nombreArea, 
                    sp_recert.idOperacion, operacion.nOperacion , sp_recert.idComplejidad, complejidad.tipoComplejidad, 
                    sp_recert.idEmpleado, sp_recert.nameEmpleado,  sp_recert.fechaCreacion, sp_recert.calification,
                    sp_recert.attempts
                    
                      FROM sp_recert 
                      INNER JOIN areaxtrainer ON areaxtrainer.idTrainer = sp_recert.idTrainer
                      INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
                      INNER JOIN area ON area.idArea = sp_recert.idArea
                      INNER JOIN operacion ON operacion.idOperacion = sp_recert.idOperacion
                      INNER JOIN complejidad ON complejidad.idComplejidad = sp_recert.idComplejidad
                      WHERE trainers.idTrainer = '.$_SESSION['id']  ;

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
        <button class="btn btn-success" id="menu-toggle"> RECERTIFICACIONES ESPECIALES</button>

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
                             
                               
                                <td>EXAMEN</td> 
                                <td></td>
                                <td>CALIFICACION</td>
                                <td>RECERTIFICACION</td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $search->fetch_array()) {
                                     
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
                                  
                              
                                            if ($data['calification'] >= 8) {
                                              echo '<td>N/A</td>'; 
                                              } else {
                                              echo  '<td><button type="submit" formaction="Apply_Test_Esp.php" name="Apply_Test" 
                                            class="btn btn-outline-success"> <i class="fas fa-user-graduate"></i></button></td>';
                              
                                              }

                                      if ($data['calification'] > 0) {
                                        echo  '<td><button type="submit" formaction="See_Test_Esp.php" name="Apply_Test" 
                                        class="btn btn-outline-success"> <i class="fas fa-eye"></i></button></td>';
                                      } else {
                                        echo '<td></td>';
                                      }
                                echo  '<td><input type="hidden" name="calification" value="'.$data['calification'].'">'.$data['calification'].'</td>';                             
                                            if ($data['calification'] < 8) {
                                              echo '<td>N/A</td>'; 
                                              } else {
                                echo '<td><button type="submit" formaction="Create_Recert_From_Cert.php" name="Create_Recert_From_Cert" 
                                class="btn btn-outline-success"><i class="fas fa-file-alt"></i></button></td>';
                                              }
                                              echo '</form>';
                                echo '</tr>';
                                
                                    
                                    
                              

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
