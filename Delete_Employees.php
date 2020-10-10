<?php
include 'DB_CONN.php';
session_start();


 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    
    $_SESSION['eliminadas'] = "";
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
               $query = "SELECT * FROM empleados WHERE idEmpleado =".$getData[0];
               if (mysqli_num_rows($db->query($query))) {
                      
                    
                     $sql = "DELETE FROM hrsregistered WHERE idEmpleado = ".$getData[0];    
                    if( $result = $db->query($sql) === TRUE)
                        {
                        
                        } 
                        else {
                            echo $getData[0].": ".$db->error;
                             echo "<br>";
                        }
                    
                     $sql = "DELETE FROM certsq WHERE idEmpleado = ".$getData[0]; 
                    if( $result = $db->query($sql) === TRUE)
                        {
                        
                        } 
                        else {
                            echo $getData[0].": ".$db->error;
                           
                        }
                        
                        
                     $sql = "DELETE FROM hrsregisteredrecert WHERE idEmpleado = ".$getData[0];    
                    if( $result = $db->query($sql) === TRUE)
                        {
                        
                        } 
                        else {
                            echo $getData[0].": ".$db->error;
                             echo "<br>";
                        }
                    
                     $sql = "DELETE FROM recertsq WHERE idEmpleado = ".$getData[0]; 
                    if( $result = $db->query($sql) === TRUE)
                        {
                        
                        } 
                        else {
                            echo $getData[0].": ".$db->error;
                           
                        }
                       
             
                     $sql = "DELETE FROM empleados WHERE
                                        idEmpleado =".$getData[0];                  
                        if( $result = $db->query($sql) === TRUE)
                        {
                            $a = $getData[0]."fue borrado";
                            
                        } 
                        else {
                            $a = $getData[0].": ".$db->error;
                             
                        }
       
                    
            } else {
               
            
                $a = $getData[0]." no existia en la base de datos";
                  
                  
           }
       $_SESSION['eliminadas'] = $_SESSION['eliminadas'] . $a . ', ';
          header("Location: See_Employees.php");
           
     }
     
       }   
      
        fclose($file); 
 }
 ?>




<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">



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
        <button class="btn btn-primary" id="menu-toggle">ELIMINAR EMPLEADOS</button>

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
      <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="Delete_Employees.php" method="post"  enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Eliminar bajas</legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Seleccione un archivo CSV</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Eliminar bajas</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Eliminar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
           
        </div>
    </div>

     

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
