<?php
include 'DB_CONN.php';
session_start();


if (isset($_POST['Add_Hours_Certification'])) {

    $av_1 = $_POST['av_1'];
    $av_2 = $_POST['av_2'];
    $av_3 = $_POST['av_3'];
    $av_4 = $_POST['av_4'];

    $idTrainer = $_POST['idTrainer'];
    $idCertification = $_POST['idCertification'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $lastUp = $_POST['lastUp'];
    $_SESSION['id'];
    $idEmpleado = $_POST['idEmpleado'];
    $actualDate = date("H:i:s",strtotime($date));
    $day = date("l",strtotime($date));
    $intermediateHour = date_create('');
    date_time_set($intermediateHour, 23, 59, 59);
   
   $hour2 =  date_format($intermediateHour, 'H:i:s');


    $intermediateHour = date_create('');
    date_time_set($intermediateHour, 00, 00, 00);
   
   $hour3 =  date_format($intermediateHour, 'H:i:s');

    $query = 'SELECT certsq.idCertification, certsq.av_1, certsq.av_2, certsq.av_3, certsq.av_4, certsq.progress
                     , certsq.idTrainer, trainers.nameTrainer, turno.idTurno, turno.start, turno.end 
		from certsq
        INNER JOIN trainers ON trainers.idTrainer = certsq.idTrainer
        INNER JOIN turno ON turno.idTurno = trainers.idTurno
        WHERE certsq.idCertification ='.$idCertification;

         $result = $db ->query($query);
        
        $row = $result -> fetch_assoc() ;  

      $row['start'];
      $actualDate;
      $row['end'];

      if ($row['progress'] > 37.5 AND $row['av_2'] == 0 ) {
        $_SESSION['cert'] = $idCertification;
          header("Location: Trace_Created_Certification.php");
      } elseif ($row['progress'] > 75 AND $row['av_3'] == 0 ) {
        $_SESSION['cert'] = $idCertification;
        header("Location: Trace_Created_Certification.php");
      } elseif ($row['progress'] > 112.5 AND $row['av_4'] == 0) {
        $_SESSION['cert'] = $idCertification;
        header("Location: Trace_Created_Certification.php");
      }
      
      if ($row['idTurno'] == 1 OR $row['idTurno'] == 2) {
        
        if ($day == "Monday" OR $day == "Tuesday" OR $day == "Wednesday"
                 OR $day == "Thursday" OR $day == "Friday"){
                }else {
                  $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
                  header("Location: Trainer_MainPage.php");
                }


        if ($actualDate > $row['start']   AND  $actualDate <  $row['end']  ) {
        }
    else  {
      $_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral";
      header("Location: Trainer_MainPage.php");
    }


  } elseif ($row['idTurno'] == 3) {

    if ($day == "Monday" OR $day == "Tuesday" OR $day == "Wednesday"
    OR $day == "Thursday" OR $day == "Friday" OR $day == "Saturday"){
   }else {
     $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
     header("Location: Trainer_MainPage.php");
   }


    if ($actualDate > $row['start']   AND  $actualDate < $hour2  ) {
    } elseif ($actualDate > $hour3   AND  $actualDate < $row['end']) {
  
    }
    else  {
      $_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral";
      header("Location: Trainer_MainPage.php");
    }
  }

  elseif ($row['idTurno'] == 4) {
    if ($day == "Saturday" OR $day == "Sunday"){
   }else {
     $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
     header("Location: Trainer_MainPage.php");
   }


   if ($actualDate > $row['start']   AND  $actualDate <  $row['end']  ) {
  }
else  {
$_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral";
header("Location: Trainer_MainPage.php");
}
  }


}

if (isset($_POST['Add_Hours_Recertification'])) {
  $idTrainer = $_POST['idTrainer'];
    $idCertification = $_POST['idCertification'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $lastUp = $_POST['lastUp'];
    $_SESSION['id'];
    $idEmpleado = $_POST['idEmpleado'];
    echo $actualDate = date("H:i:s",strtotime($date));
    $day = date("l",strtotime($date));
    $intermediateHour = date_create('');
    date_time_set($intermediateHour, 23, 59, 59);
   
   $hour2 =  date_format($intermediateHour, 'H:i:s');


    $intermediateHour = date_create('');
    date_time_set($intermediateHour, 00, 00, 00);
   
   $hour3 =  date_format($intermediateHour, 'H:i:s');

    $query = 'SELECT recertsq.idTrainer, trainers.nameTrainer, turno.idTurno, turno.start, turno.end 
		from recertsq
        INNER JOIN trainers ON trainers.idTrainer = recertsq.idTrainer
        INNER JOIN turno ON turno.idTurno = trainers.idTurno
        WHERE recertsq.idCertification ='.$idCertification;

         $result = $db ->query($query);
        
        $row = $result -> fetch_assoc() ;  

      $row['start'];
      $actualDate;
      $row['end'];

      if ($row['idTurno'] == 1 OR $row['idTurno'] == 2) {
        
        if ($day == "Monday" OR $day == "Tuesday" OR $day == "Wednesday"
                 OR $day == "Thursday" OR $day == "Friday"){
                }else {
                  $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
                  header("Location: Trainer_MainPage.php");
                }


        if ($actualDate > $row['start']   AND  $actualDate <  $row['end']  ) {
        }
    else  {
      $_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral1";
      header("Location: Trainer_RecertPage.php");
    }


  } elseif ($row['idTurno'] == 3) {

    if ($day == "Monday" OR $day == "Tuesday" OR $day == "Wednesday"
    OR $day == "Thursday" OR $day == "Friday" OR $day == "Saturday"){
   }else {
     $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
     header("Location: Trainer_RecertPage.php");
   }


    if ($actualDate > $row['start']   AND  $actualDate < $hour2  ) {
    } elseif ($actualDate > $hour3   AND  $actualDate < $row['end']) {
  
    }
    else  {
      $_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral2";
      header("Location: Trainer_RecertPage.php");
    }
  }

  elseif ($row['idTurno'] == 4) {
    if ($day == "Saturday" OR $day == "Sunday"){
   }else {
     $_SESSION['dayRestriction'] = "Solo puedes ingresar horas entre semana";
     header("Location: Trainer_RecertPage.php");
   }


   if ($actualDate > $row['start']   AND  $actualDate <  $row['end']  ) {
  }
else  {
$_SESSION['turnRestriction'] = "No puedes ingresar horas fuera de tu horario laboral3";
header("Location: Trainer_RecertPage.php");
}
  }

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
        <button class="btn btn-primary" id="menu-toggle">AGREGAR HORAS</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
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
                  <?php
                echo   "<br><br><br><br>";
                    if (isset($_POST['Add_Hours_Certification'])) {
                      echo '<form action="" method="POST">';
                      echo '<div class="row pl-5">';
                      echo '<div class="input-group">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Agregar horas</span>
                                  </div>
                                    <input type="number" class="col-sm-5" step=.5 min="1" max="3" name="num" id="num">
                                    <input type="hidden" name="fechaCreacion" value="'.$fechaCreacion.'">
                                    <input type="hidden" name="fechaIngreso" value="'.$date.'">
                                    <input type="hidden" name="lastUp" value="'.$lastUp.'">
                                    <input type="hidden" name="idEmpleado" value="'.$idEmpleado.'">
                                    <input type="hidden" name="idCertification" value="'.$idCertification.'">
                                    <input type="hidden" name="idTrainer" value="'.$idTrainer.'">
                                    <input type="hidden" name="av_1" value="'.$av_1.'">
                                    <input type="hidden" name="av_2" value="'.$av_2.'">
                                    <input type="hidden" name="av_3" value="'.$av_3.'">
                                    <input type="hidden" name="av_4" value="'.$av_4.'">
                                    <div class="col-md-2"></div>
                                    
                          </div>
                     
                      </div>';

                      echo "<br><br><br>";
                      echo  '<div class="row">';
                        echo '<div class="col-sm-2"></div>';
                        echo ' <button class="col-sm-4 btn btn-primary" formaction="Verify.php"  name="Add_Hours_Certification" type="submit"
                         value="Guardar datos" ><i class="fas fa-sign-in-alt"></i></button>
                                    </div>'; 

                        echo '</form>';
                    
                }


            
                if (isset($_POST['Add_Hours_Recertification'])) {
                    echo '<form action="" method="POST">';
                echo '<div class="row pl-5">';
                echo '<div class="input-group">
                          <div class="input-group-prepend">
                                  <span class="input-group-text" id="">Agregar horas</span>
                            </div>
                                    <input type="number" class="col-sm-5" step=.5 min="1" max="3" name="num2" id="num">
                                    <input type="hidden" name="fechaCreacion" value="'.$fechaCreacion.'">
                                    <input type="hidden" name="fechaIngreso" value="'.$date.'">
                                    <input type="hidden" name="lastUp" value="'.$lastUp.'">
                                    <input type="hidden" name="idEmpleado" value="'.$idEmpleado.'">
                                    <input type="hidden" name="idCertification" value="'.$idCertification.'">
                                    <input type="hidden" name="idTrainer" value="'.$idTrainer.'">
                                    <div class="col-md-1"></div>
                        </div>           
                
                    </div>';
                      echo "<br><br><br>";
                      echo  '<div class="row">';
                        echo '<div class="col-sm-2"></div>';
                        echo ' <button class="col-sm-4 btn btn-primary" formaction="Verify.php"  name="Add_Hours_Recertification" type="submit"
                         value="Guardar datos" ><i class="fas fa-sign-in-alt"></i></button>
                                    </div>'; 

                        echo '</form>';
                    
                    }
                ?>


  </div>
</div>
<script>
$("body").on("submit", "form", function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});
</script>


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
