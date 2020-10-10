<?php
session_start();


include "DB_CONN.php";

$nameArea = $_POST['nameArea'];
$numOp = $_POST['numOp'];


$query = 'SELECT area.idArea, area.nombreArea FROM area
WHERE area.nombreArea = '.'"'.$nameArea.'"';


if (mysqli_num_rows($db->query($query))) {
  $_SESSION['area_restriction'] = "El AREA QUE HAS INGRESADO YA EXISTE";
  header("Location: Create_Area.php");
}
else {




$sql = 'INSERT INTO area (nombreArea) VALUES ('.'"'.$nameArea.'")';

$db -> query($sql);

$query =  'SELECT * FROM operacion';

$query2 = 'SELECT * FROM operacion';

$q1 = $db -> query($query2);$q2 = $db -> query($query2);$q3 = $db -> query($query2);
$q4 = $db -> query($query2);$q5 = $db -> query($query2);$q6 = $db -> query($query2);
$q7 = $db -> query($query2);$q8 = $db -> query($query2);$q9 = $db -> query($query2);
$q10 = $db -> query($query2);$q11 = $db -> query($query2);$q12 = $db -> query($query2);
$q13 = $db -> query($query2);$q14 = $db -> query($query2);$q15 = $db -> query($query2);
$q16 = $db -> query($query2);$q17 = $db -> query($query2);$q18 = $db -> query($query2);
$q19 = $db -> query($query2);$q20 = $db -> query($query2);$q21 = $db -> query($query2);
$q22 = $db -> query($query2);$q23 = $db -> query($query2);$q24 = $db -> query($query2);
$q25 = $db -> query($query2);$q26 = $db -> query($query2);$q27 = $db -> query($query2);
$q28 = $db -> query($query2);$q29 = $db -> query($query2);$q30 = $db -> query($query2);
$q31 = $db -> query($query2);$q32 = $db -> query($query2);$q33 = $db -> query($query2);
$q34 = $db -> query($query2);$q35 = $db -> query($query2);$q36 = $db -> query($query2);
$q37 = $db -> query($query2);$q38 = $db -> query($query2);$q39 = $db -> query($query2);


$i = array($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15,
             $q16, $q17, $q18, $q19, $q20, $q21, $q22, $q23, $q24, $q25, $q26, $q27, 
             $q28, $q29, $q30, $q31, $q32, $q33, $q34, $q35, $q36, $q37, $q38, $q39 );
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
        <button class="btn btn-danger" id="menu-toggle">AGREGAR OPERACIONES A AREA</button>

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

$cont = 1;
$cont2 = 0;

echo '<div class="form-group container">';
echo '<form action="" method="post">';
while ($cont <= $numOp) {
        echo '<div class="row">';
        echo '<div class="col-md-3"></div>';
        echo '<input type="hidden" name="nameArea" value="'.$nameArea.'">';
        echo '<input type="hidden" name="numOp" value="'.$numOp.'">';
        echo '<select class="form-control col-md-6" name="o'.$cont.'" id="o'.$cont.'">';
        echo '<option value="">SELECCIONA OPERACION</option>';
        $cont++;
            if($i[$cont2]->num_rows > 0){  
                while($row = $i[$cont2] -> fetch_assoc()){
                    echo '<option class="text-muted" value="'.$row['idOperacion'].'">'.$row['nOperacion'].'</option>';
                    }
                    echo '</select>';
                    

                }
               
    $cont2++;
    echo '</div>';
    echo '<br>';
}

    
?>


                <div class='row'>
                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Visualize_Areas.php" name="Area_Complete" type="submit">Guardar datos</button>
                </div>
  </div>      
  </div>
</form>
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
