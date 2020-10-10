<?php

session_start();
include 'DB_CONN.php';
include 'Modal.php';


if (isset($_POST['Area_Complete'])) {


    $nameArea = $_POST['nameArea'];
    $numOp = $_POST['numOp'];

    $j = array($_POST['o1'], $_POST['o2'],$_POST['o3'],$_POST['o4'],$_POST['o5'], 
                $_POST['o6'], $_POST['o7'],$_POST['o8'],$_POST['o9'],$_POST['o10'],
                $_POST['o11'], $_POST['o12'],$_POST['13'],$_POST['14'],$_POST['15'], 
                $_POST['o16'], $_POST['o17'],$_POST['o18'],$_POST['o19'],$_POST['o20'],
                $_POST['o21'], $_POST['o22'],$_POST['o23'],$_POST['o24'],$_POST['o25'], 
                $_POST['o26'], $_POST['o27'],$_POST['o28'],$_POST['o29'],$_POST['o30'], 
                $_POST['o31'], $_POST['o32'],$_POST['o33'],$_POST['o34'],$_POST['o35'], 
                $_POST['o36'], $_POST['o37'],$_POST['o38'],$_POST['o39'],$_POST['o40']);
    
    
    $sql = 'SELECT area.idArea, area.nombreArea
	FROM area
    WHERE nombreArea = '.'"'.$nameArea.'"';
    $area = $db -> query($sql);
    
    $row = $area -> fetch_assoc();
    
    $cont = 1;
    $cont2 = 0;
    while ($cont <= $numOp) {
        $sql = 'INSERT INTO alloperations (idArea, idOperacion)
        VALUES ('.$row['idArea'].','.$j[$cont2].')';
              $cont++;
              $cont2++;
            if ($db->query($sql) === TRUE ) {
                echo "";
            }
            else {
                echo "Error". $db ->error;
                echo "<br>";
            }
              
        }
    
      $query = "SELECT area.idArea, area.nombreArea FROM area";
      $areas = $db->query($query);

}

    
if (isset($_POST['Change_Turn'])) { 
    $turno = $_POST['turno'];
   $trainer = $_POST['trainer'];
   $turno_to_change = $_POST['turn_to_change'];
 


    $query = 'UPDATE trainers SET 
             idTurno  = '.$turno_to_change.'
                WHERE idTrainer = '.$trainer.' AND idTurno='.$turno;

    if ($db ->query($query)) {
        echo "";
    }
    else {
        echo "Error". $db ->error;
    }
}


$query = "SELECT area.idArea, area.nombreArea FROM area";
$areas = $db->query($query);



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
        <button class="btn btn-danger" id="menu-toggle">AREAS</button>

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
<div class="container-fluid">
      <div class='row'>    
        
        <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>AREA</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                                    while($data = $areas ->fetch_array()) {            
                                    echo '<tr>';
                                    echo   '<form action="" method="POST">';
                                    echo '<td><input type="hidden" name="idArea" value="'.$data['idArea'].'">'.$data['idArea'].'</td>';
                                    echo '<td><input type="hidden" name="nombreArea" value='.$data['nombreArea'].'>'. $data['nombreArea'].'</td>';
                                    echo  '<td>
                                          <button type="submit" 
                                          formaction="Watch_Op_From_Area.php" 
                                          name="Watch_Op_From_Area" 
                                          class="btn btn-outline-info">
                                          <i class="fas fa-eye"></i>
                                          </button>
                                          </td>';
                                    echo  '<td><button type="submit" 
                                          formaction="Delete.php" 
                                          name="Delete_Area" 
                                          class="btn btn-outline-danger">
                                          <i class=" fas fa-trash-alt"></i>                                                      
                                            </button>
                                          </td>';
                                    echo "</form>";
                                    echo "</tr>";

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
