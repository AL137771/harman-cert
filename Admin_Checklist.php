<?php

session_start();
include 'DB_CONN.php';

$trainer = $_SESSION['id'];

$date2 = date('Y-m-d',strtotime($date));

$date1 = date('Y-m-d',(strtotime ( '-5 day' , strtotime ($date) ) ));


$query = 'SELECT DISTINCT trainers.idTurno, turno.nameTurno, checklist_dates.idArea, area.nombreArea, CAST(checklist_dates.dateRegistro AS DATE) as DATE
FROM checklist
  INNER JOIN checklist_dates ON checklist.idCheck = checklist_dates.idCheck
  INNER JOIN area ON area.idArea = checklist_dates.idArea
  INNER JOIN trainers ON trainers.idTrainer = checklist_dates.idTrainer
  INNER JOIN turno ON turno.idTurno = trainers.idTurno
  WHERE CAST(checklist_dates.dateRegistro AS DATE) 
        BETWEEN '.'"'.$date1.'"'.' AND '.'"'.$date2.'"'.'
        GROUP BY checklist_dates.idArea, checklist_dates.dateRegistro';
 
        $search = $db->query($query);


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
        <button class="btn btn-dark" id="menu-toggle"> CHECKLIST</button>

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
                                <td>TURNO</td>
                                <td>AREA</td>
                                <td>FECHA</td>
                                <td>ANTIGUEDAD</td>
                                <td></td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $search->fetch_array()) {

                                      
                                     
                                    echo '<tr>';
                                    echo   '<form action="" method="POST">';
                                    echo '<td><input type="hidden" name="turno" value='.$data['idTurno'].'>'.$data['nameTurno'].'</td>';;
                                    echo '<td><input type="hidden" name="idArea" value='.$data['idArea'].'>'.$data['nombreArea'].'</td>';;
                                    echo  '<td><input type="hidden" name="dateRegistro" value="'.$data['DATE'].'">'.$data['DATE'].'</td>';
                                    //echo  '<td><input type="hidden" name="total" value="'.$data['total'].'">'.$data['total'].'</td>';    
                                    
                                    $date2 = date('Y-m-d', strtotime($data['DATE']));
                                        $date1 = date('Y-m-d', strtotime($date));
  
                                            // Calulating the difference in timestamps 
                                            $diff = strtotime($date2) - strtotime($date1); 
                                              
                                            // 1 day = 24 hours 
                                            // 24 * 60 * 60 = 86400 seconds 
                                         $dateDiff =  round($diff / 86400); 
                                    
                                      if ($dateDiff > 0 ) {
                                        
                                      } else {
                                        if ($data['DATE'] == $date1) {
                                          echo '<td><strong>Hoy</strong></td>';
                                        } else { 
                                        echo '<td>Hace <strong>'.abs($dateDiff).'</strong> dias </td>';
                                      }
                                      }
                                    
                                    
                                    echo  '<td>
                                    <button type="submit" 
                                    formaction="Admin_Watch_Selected_Checklist.php" 
                                    name="Watch_Selected_Checklist" 
                                    class="btn btn-outline-dark">
                                    <i class="fas fa-eye"></i>
                                    </button>
                                    </td>';
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
