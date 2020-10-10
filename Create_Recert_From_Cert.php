<?php
session_start();
include "DB_CONN.php";

if (isset($_POST['Create_Recert_From_Cert'])) {
    $idArea = $_POST['area'];
    $idOperacion = $_POST['operacion'];
    $idComplejidad = $_POST['complejidad'];
    $idEmpleado = $_POST['idEmpleado'];
    $nameEmpleado = $_POST['nameEmpleado'];

    $query = 'SELECT certsq.idCertification, certsq.idTrainer, trainers.nameTrainer,
                        certsq.idArea, area.nombreArea, certsq.idOperacion, operacion.nOperacion,
                        certsq.idComplejidad,   complejidad.tipoComplejidad, 
                        empleados.idEmpleado, empleados.nameEmpleado
    FROM certsq 
    INNER JOIN trainers ON trainers.idTrainer = '.$_SESSION['id'].'   
    INNER JOIN area ON area.idArea = '.$idArea.'
    INNER JOIN operacion ON operacion.idOperacion = '.$idOperacion.'
    INNER JOIN complejidad ON complejidad.idComplejidad = '.$idComplejidad.'
    INNER JOIN empleados ON empleados.idEmpleado = '.$idEmpleado;

   $area =  $db ->query($query) ;
   $operacion =  $db ->query($query) ;
   $complejidad =  $db ->query($query) ;
   $idEmpleado =  $db ->query($query) ;
   $nameEmpleado =  $db ->query($query) ;
     
   

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js.js"></script>   
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
        <button class="btn btn-primary" id="menu-toggle">CREAR RECERTIFICACION</button>

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

    <form action='' method="post">
        <div class='form-group container'>
                <div class='row'>
                    <input type="hidden" name="idCertification">
                    <div class='col-md-3'></div>
                        <select required class='form-control col-md-6 chosen' name="area" id="area">
                        <?php
                    if($area ->num_rows > 0){  
                        while($row = $area -> fetch_assoc()){
                            echo '<option class="text-muted" value="'.$row['idArea'].'">'.$row['nombreArea'].'</option>';
                        }
                    }
                    ?> 
                        </select>
                      
                        <div class='formcontrol col-md-3'></div>
                       </div>

                <br>

                <div class='row'>
                <div class='col-md-3'></div>
                        <select required class='form-control col-md-6' name="operacion" id="operacion">
                        <?php
                    if($operacion ->num_rows > 0){  
                        while($row = $operacion -> fetch_assoc()){
                            echo '<option class="text-muted" value="'.$row['idOperacion'].'">'.$row['nOperacion'].'</option>';
                        }
                    }
                    ?> 
                            </select>
                    </div>
                    <br>
                    <div class='row'>
                    <div class='col-md-3'></div>
                        <select required class='form-control col-md-6' name="complejidad" id="complejidad">
                        <?php
                    if($complejidad ->num_rows > 0){  
                        while($row = $complejidad -> fetch_assoc()){
                            echo '<option class="text-muted" value="'.$row['idComplejidad'].'">'.$row['tipoComplejidad'].'</option>';
                        }
                    }
                    ?> 
                            </select>
                            <div class='formc-ontrol col-md-3'></div>       
                     </div>

        </div>
                <br>
                <br>

        <div class='form-group container' >
                <div class='row'>
                    <div class='formc-ontrol col-sm-3'></div>    
                    <select required class='form-control col-sm-6 chosen' name="idEmpleado" id="idEmpleado">  
                    <?php
                    if($idEmpleado ->num_rows > 0){  
                        while($row = $idEmpleado -> fetch_assoc()){
                            echo '<option class="text-muted" value="'.$row['idEmpleado'].'">'.$row['idEmpleado'].'</option>';
                        }
                    }
                    ?> 
                     </select>
                </div>
                <br>
                <div class='row'>    
                <div class='col-sm-3'></div>  
                    <select required class='form-control col-sm-6 ' name="nameEmpleado" id="nameEmpleado">
                    <?php
                    if($nameEmpleado ->num_rows > 0){  
                        while($row = $nameEmpleado -> fetch_assoc()){
                            echo '<option class="text-muted" value="'.$row['nameEmpleado'].'">'.$row['nameEmpleado'].'</option>';
                        }
                    }
                    ?> 
                    </select>
                    </div>
                    <br>
  

                        <br><br><br>
                <div class='row'>


                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction='Tracing_ReCertification.php' name='Send_Area_Info' type="submit">Guardar datos</button>
                </div>
                    

    

                
                
        </div>
    </div>
    </div>
    </div>
</form>
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
    <script type="text/javascript">

        $(".chosen").chosen();

</script>
</body>

</html>
