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



      
        $query = 'SELECT DISTINCT TIMESTAMPDIFF(HOUR,certsq.lastUp, now()) as diferencia, certsq.idCertification, certsq.idTrainer, trainers.nameTrainer, certsq.idArea, area.nombreArea, 
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
                <form action="" method="POST">
                <br>
                <div class="input-group">
                                <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Horas a agregar</span>
                                  </div>
                                    <input type="number" class="col-sm-5" step=.5 min="1" max="3" name="num" id="num">
                                    
                <button type="submit" formaction="Verify_Multi.php" name="data_sent" 
                                    class="btn btnlg btn-outline-primary">
                                    <i class="fas fa-sign-in-alt"></i></button>

                                   </div>
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
                                    if ($data['diferencia'] > 0 OR empty($data['lastUp'])) {
                                      echo '<tr class="table-success">';
                                    } 
                                    else  {
                                      echo '<tr class="table-danger">';
                                    }
                                   
                                   
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
                                  
                                    
                               if ($value < 150 ) {

                                if ($data['diferencia'] > 0 OR empty($data['lastUp'])) {
                                  echo  '<td><input class="check"  type="checkbox" name="data[]" value="'.$data['idCertification'].'"></td>';
                                } 
                                else  {
                                  echo '<td></td>';
                                }

                              
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
                                
                                echo '</tr>';
                              } 
                            }   
                          

                                    
                                ?>
                                  
                            
                            </tbody>
                    </table>    
                   
                                    </form>           
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

    var checks = document.querySelectorAll(".check");
var max = 5;
for (var i = 0; i < checks.length; i++)
  checks[i].onclick = selectiveCheck;
function selectiveCheck (event) {
  var checkedChecks = document.querySelectorAll(".check:checked");
  if (checkedChecks.length >= max + 1)
    return false;
}


    console.log("Hols Hols");
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

    <script>
    
    
</body>

</html>
