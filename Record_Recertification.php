<?php 
session_start();
include 'DB_CONN.php';

if (isset($_POST['Record_Recertification'])) {
    $idCertification = $_POST['idCertification'];
    $nameEmpleado = $_POST['nameEmpleado'];
        $query = 'SELECT hrsregisteredrecert.fechaRegist, area.nombreArea, hrsregisteredrecert.idTrainer,
         trainers.nameTrainer, hrsregisteredrecert.hourRegistered, hrsregisteredrecert.idEmpleado, empleados.nameEmpleado
        FROM hrsregisteredrecert
        INNER JOIN empleados ON empleados.idEmpleado = hrsregisteredrecert.idEmpleado
        INNER JOIN trainers ON trainers.idTrainer = hrsregisteredrecert.idTrainer
        INNER JOIN recertsq on recertsq.idCertification = hrsregisteredrecert.idCertification
        INNER JOIN area ON area.idArea = recertsq.idArea
        WHERE hrsregisteredrecert.idCertification = '.$idCertification;
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
 
  <?php 
  if ($_SESSION['typeUser']== 2) {
    include "Admin_Template.php";
  } elseif ($_SESSION['typeUser']== 1) {
    include "Trainer_Template.php";
  }
 
  
  ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><?php echo $nameEmpleado ?> </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <?php

if ($_SESSION['typeUser'] == 1) {
 echo  '<form action="" method="POST">
 <button class="btn btn-danger" formaction="Trainer_RecertPage.php" type="submit">
 <i class="fas fa-undo-alt"></i></button>
 </form>';
}
elseif ($_SESSION['typeUser'] == 2) {
  echo  '<form action="" method="POST">
  <button class="btn btn-danger" formaction="Admin_RecertPage.php"  type="submit">
  <i class="fas fa-undo-alt"></i></button>
  </form>';
}



?>
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
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <td>ENTRENADOR</td>
                                <td>AREA</td>
                                <td>EMPLEADO</td>
                                <td>FECHA REGISTRO</td>
                                <td>HRS REGISTRADAS</td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $search->fetch_array()) {
                                      echo '<tr>';
                                    echo   '<form action="" method="POST">';
                                    echo '<td><input type="hidden" name="nameTrainer" value="'.$data['idTrainer'].'">'.$data['nameTrainer'].'</td>';
                                    echo '<td><input type="hidden" name="idArea" value="'.$data['idArea'].'">'.$data['nombreArea'].'</td>';
                                    echo '<td><input type="hidden" name="idEmpleado" value='.$data['idEmpleado'].'>'.$data['idEmpleado'].'</td>';
                                    echo  '<td><input type="hidden" name="fechaRegist" value="'.$data['fechaRegist'].'">'.$data['fechaRegist'].'</td>';
                                    echo  '<td><input type="hidden" name="hourRegistered" value="'.$data['hourRegistered'].'">'.$data['hourRegistered'].'</td>';
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
