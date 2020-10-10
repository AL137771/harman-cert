<?php
session_start();

include "DB_CONN.php";

if (isset($_POST['Exchange_Area'])) {

    if (isset($_POST['idTrainer']) AND empty($_POST['SessionIdTrainer'])) {
    $idTrainer = $_POST['idTrainer'];
   $query = 'SELECT areaxtrainer.idArea, area.nombreArea, areaxtrainer.idTrainer, trainers.nameTrainer
    FROM areaxtrainer
    INNER JOIN area ON area.idArea = areaxtrainer.idArea
    INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
    WHERE areaxtrainer.idTrainer='. $idTrainer ;

    $consulta = $db->query($query);


    $query2 = 'SELECT COUNT(*) as var  FROM areaxtrainer WHERE idTrainer = '. $idTrainer;
    $consulta2 = $db->query($query2);

    
    } elseif (isset($_POST['SessionIdTrainer'])) {
       
        $idTrainer = $_POST['SessionIdTrainer'];
       $query = 'SELECT areaxtrainer.idArea, area.nombreArea, areaxtrainer.idTrainer, trainers.nameTrainer
        FROM areaxtrainer
        INNER JOIN area ON area.idArea = areaxtrainer.idArea
        INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
        WHERE areaxtrainer.idTrainer='. $idTrainer ;
    
        $consulta = $db->query($query);
    
    
        $query2 = 'SELECT COUNT(*) as var  FROM areaxtrainer WHERE idTrainer = '. $idTrainer;
        $consulta2 = $db->query($query2);
        }
    $query3 = 'SELECT COUNT(*) as var  FROM area' ;
    $consulta3 = $db->query($query3);

  
$query =  'SELECT * FROM area ';

$qq1 = $db -> query($query);$qq2 = $db -> query($query);$qq3 = $db -> query($query);
$qq4 = $db -> query($query);$qq5 = $db -> query($query);

$k = array($qq1, $qq2, $qq3, $qq4, $q5);

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

  <?php include "Admin_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <button class="btn btn-success" id="menu-toggle"><?php echo $_SESSION['nameTrainer'] ; ?></button>
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

$row2 = $consulta2 -> fetch_assoc();
$total = $row2['var'];

$cont2 = 0;
echo '<div class="form-group container">';
echo '<form action="ver_area.php" method="post">';
echo  '<input type="hidden"  name="idTrainer" value="'.$idTrainer.'">';
echo  '<input type="hidden"  name="total" value="'.$total.'">';
while ($cont2 < $total) {
        
        while($row = $consulta -> fetch_assoc()){
            echo '<div class="row">';
            echo '<div class="col-md-3"></div>';
            echo '<select class="form-control col-md-6" name="a'.$cont2.'" id="a'.$cont2.'">';
            echo '<option class="text-muted" value="'.$row['idArea'].'">'.$row['nombreArea'].'</option>';
            while($row3 = $k[$cont2] -> fetch_assoc()){
                echo '<option class="text-muted" value="'.$row3['idArea'].'">'.$row3['nombreArea'].'</option>';      
            }
            echo '</select>';
            echo '</div>';
            $cont2++;
                }
              
            }       

    
?>
             <br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Watch_Areas_From_Trainer.php" name='Change_Areas' type="submit">Guardar datos</button>
                </div>
              
                <br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <a href="ver_area.php"  class="col-sm-6 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
                </div>
                    
               
    

                
                
        </div>
        <div class='form-group container'>
                <div class='row'>
                
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

