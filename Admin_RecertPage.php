<?php 
session_start();
include 'DB_CONN.php';


$query = 'SELECT * FROM trainers';
$trainerOpt = $db->query($query);


$query =  'SELECT * FROM area';
$areaOpt = $db -> query($query);

$query =  'SELECT * FROM operacion';
$opOpt = $db -> query($query);





if (isset($_POST['Check_Cert_Employee'])) {
  $idEmpleado = $_POST['idEmpleado'];

  $query = 'SELECT * FROM recertsq where active = 2' ;
            
            $search = $db -> query($query);
}
 else {
 
  $query = 'SELECT * FROM recertsq where active = 2' ;

$search = $db -> query($query);

 }
            
            
        
              
if (isset($_POST['Search'])) {
  $trainer = $_POST['trainer'];
  $area = $_POST['area'];
  $operacion = $_POST['operacion'];
  $idEmpleado = $_POST['idEmpleado'];
  $nameEmpleado = $_POST['nameEmpleado'];
 
  if (!empty($trainer)) {
   $t = 'AND recertsq.idTrainer ="'.$trainer.'"'; 
  } else {
    $t = '';
    }
  if (!empty($area)) {
   $a = 'AND recertsq.idArea ="'.$area.'"';
 }else {
   $a = '';
   }
 if (!empty($operacion)) {
   $o = 'AND recertsq.idOperacion ="'.$operacion.'"';
 } else {
   $o = '';
   }
 
 if (!empty($idEmpleado)) {
   $ie = 'AND recertsq.idEmpleado ="'.$idEmpleado.'"';
 }else {
   $ie = '';
   }
 if (!empty($nameEmpleado)) {
   $ne = 'AND recertsq.nameEmpleado LIKE "%'.$nameEmpleado.'%"';
 } else {
   $ne = '';
   }
 
   $finalstring = $t.$a.$o.$ie.$ne;
 
   $query = 'SELECT DISTINCT recertsq.idCertification, recertsq.idTrainer, trainers.nameTrainer, recertsq.idArea, area.nombreArea, 
   recertsq.idOperacion, operacion.nOperacion , recertsq.idComplejidad, complejidad.tipoComplejidad, 
   recertsq.idEmpleado, recertsq.nameEmpleado, recertsq.lastUp , recertsq.fechaCreacion, 
   recertsq.progress
     FROM recertsq 
     INNER JOIN areaxtrainer ON areaxtrainer.idTrainer = recertsq.idTrainer
     INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
     INNER JOIN area ON area.idArea = recertsq.idArea
     INNER JOIN operacion ON operacion.idOperacion = recertsq.idOperacion
     INNER JOIN complejidad ON complejidad.idComplejidad = recertsq.idComplejidad
     WHERE  recertsq.progress < 151 and recertsq.active = 1 and recertsq.status = 0 '.$finalstring;
            $search = $db -> query($query);
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

  <?php include "Admin_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">RECERTIFICACIONES EN PROGRESO</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <form action="" method="post">
                <button type="submit" formaction="Recycle_Bin_Recert.php" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-recycle"></i>
                </button>
              </form>  
            </li>
            <li class="nav-item">
            <form action="" method="post">
                <button type="submit" formaction="Admin_Recert_Complete.php" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-check"></i>
                </button>
              </form>  
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
      <form action="" method="post">
      <div class='row'>     
      <select  class='form-control col-md-4 chosen' name="trainer" id="trainer">
                        <?php
                          echo "<option value=''>SELECCIONA ENTRENADOR</option>";
                            while($row = $trainerOpt -> fetch_assoc()){
                                echo '<option value="'.$row['idTrainer'].'">'.$row['nameTrainer'].'</option>';
                            }
                                     
                        ?>   
            </select>
      <select  class='form-control col-md-4 chosen' name="area" id="area">
                        <?php
                          echo "<option value=''>SELECCIONA AREA</option>";
                            while($row = $areaOpt -> fetch_assoc()){
                                echo '<option value="'.$row['idArea'].'">'.$row['nombreArea'].'</option>';
                                
                              }
                         
                        

                        
                        ?>   
            </select>
            <select class='form-control col-md-4 chosen' name="operacion" id="operacion">
                        <?php
                          echo "<option value=''>SELECCIONA OPERACION</option>";
                            while($row = $opOpt -> fetch_assoc()){
                                echo '<option value="'.$row['idOperacion'].'">'.$row['nOperacion'].'</option>';
                                
                              }
                         
                        

                        
                        ?>   
            </select>
            </div>
            <div class="row">
            <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder='NUMERO DE RELOJ' class='form-control col-md-5 chosen' type="text" name="idEmpleado" id="">
            <input placeholder='NOMBRE DE EMPLEADO'  class='form-control col-md-5 chosen' type="text" name="nameEmpleado" id="">
            <button type="submit" formaction="Admin_RecertPage.php" name="Search" class="col-md-2 btn btn-primary">Buscar</button>
            </div>
            </form>
            <br>
        <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                            <td>#</td>
                                <td>ENTRENADOR</td>
                                <td>AREA</td>
                                <td>OPERACION</td>
                                <td>COMPLEJIDAD</td>
                                <td>#</td>
                                <td>EMPLEADO</td>
                                <td>FECHA CREACION</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>ULTIMA ACTUALIZACION</td>
                                <td>TOT HRS</td>
                                <td>PROGRESO</td>
                                <td>RECERT</td> 
                                
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $search->fetch_array()) {
                                        $value = $data['progress'];
                                        $max_value = 37.5;
                                        $max_percent = 100;
        
                                        
                                        $prom = ($value * $max_percent) / $max_value;
                                        
                                        if($prom > 100){
                                            $prom = 100;
                                        }
                                    echo '<tr>';
                                    echo   '<form action="" method="POST">';
                                    echo '<td><input type="hidden" name="idCertification" value="'.$data['idCertification'].'">'.$data['idCertification'].'</td>';
                                    echo '<td><input type="hidden" name="idTrainer" value='.$data['idTrainer'].'>'.$data['nameTrainer'].'</td>';
                                    echo  '<td><input type="hidden" name="area" value="'.$data['idArea'].'">'.$data['nombreArea'].'</td>';
                                    echo  '<td><input type="hidden" name="operacion" value="'.$data['idOperacion'].'">'.$data['nOperacion'].'</td>';
                                    echo  '<td><input type="hidden" name="complejidad" value="'.$data['idComplejidad'].'">'.$data['tipoComplejidad'].'</td>';
                                    echo  '<td><input type="hidden" name="idEmpleado" value="'.$data['idEmpleado'].'">'.$data['idEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="nameEmpleado" value="'.$data['nameEmpleado'].'">'.$data['nameEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="fechaCreacion" value="'.$data['fechaCreacion'].'">'.$data['fechaCreacion'].'</td>';
                                    echo  '<td><button type="submit" formaction="Trace_Created_Recertification.php" name="Trace_Created_Recertification" class="btn btn-outline-info"><i class="fas fa-clipboard"></i></button></td>';
                                    echo  '<td><button type="submit" formaction="Record_Recertification.php" name="Record_Recertification" 
                                    class="btn btn-outline-success">
                                    <i class="fas fa-history"></i></button></td>';
                                    echo  '<td><button type="submit" formaction="Delete.php" name="Bin_Recertification" class="btn btn-outline-danger">
                                    <i class="fas fa-recycle"></i></button></td>';
                                    echo  '<td><input type="hidden" name="lastUp" value="'.$data['lastUp'].'">'.$data['lastUp'].'</td>';
                                    echo  '<td>'.$data['progress'].'</td>';
                                    if($value < 150) {
                                        $color ='warning';
                                      } else {
                                        $color ='success';
                                      }
                                    echo '<td><div class="progress" style="height: 32px;">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-'.$color.'" 
                                                role="progressbar" text-dark aria-valuenow=""aria-valuemin="0" 
                                                aria-valuemax="150" style="color:black ;
                                                width:'.$prom.'%">'.round($prom, 2).'%
                                    </div>
                                    </div>
                                    </div></td>';
                                    echo '<td></td>';
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
