<?php
session_start();
include "DB_CONN.php";

$query =  'SELECT * FROM area
          ' ;  


$areaOpt = $db -> query($query);


$query2 =  "SELECT * from empleados ORDER BY idEmpleado";
$empOptions = $db-> query($query2);
 

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js.js"></script>   
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <link rel="stylesheet" href="fstdropdown.css">
  <script src="fstdropdown.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
   
  
   </head>

<body>
  <div class="d-flex" id="wrapper">
  <?php include "Trainer_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-success" id="menu-toggle">CREAR RECERTIFICACION</button>

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

    <form action='' method="post">
        <div class='form-group container'>
                <div class='row'>
                    <input type="hidden" name="idCertification">
                    <div class='col-md-3'></div>
                        <select required class="form-control col-md-6"  name="area" id="area">
                        <option value="">SELECCIONA AREA</option>
                        <?php
                        if($areaOpt->num_rows > 0){  
                            while($row = $areaOpt -> fetch_assoc()){
                                echo '<option value="'.$row['idArea'].'">'.$row['nombreArea'].'</option>';
                                
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
                            </select>
                    </div>
                    <br>
                    <div class='row'>
                    <div class='col-md-3'></div>
                        <select required class='form-control col-md-6' name="complejidad" id="complejidad">
                            </select>
                            <div class='formc-ontrol col-md-3'></div>       
                     </div>

        </div>
                <br>
                <br>

            <div class='form-group container'>
              <div class='row'>
                <div class='col-sm-6'></div>    
                  <select required class='fstdropdown-select form-control col-md-6'  name="idEmpleado" id="idEmpleado">  
                    <option value="">SELECCIONA NO. RELOJ</option>
                       <?php
                          while($row = $empOptions -> fetch_assoc()){
                             echo '<option class="text-muted" value="'.$row['idEmpleado'].'">'.$row['idEmpleado'].'</option>';
                          }
                       ?>
                </select>
            </div>
         </div>


                <br>
                <div class='row'>    
                <div class='col-sm-3'></div>  
                    <select required class='form-control col-sm-6 ' name="nameEmpleado" id="nameEmpleado">
                    </select>

                    </div>
                    <br>
  

                        <br><br><br>
                <div class='row'>


                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction='Trainer_SP_Recert.php' name='Send_Area_Info' type="submit">Guardar datos</button>
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
 
 
</body>

</html>
