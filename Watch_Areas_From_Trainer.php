<?php

session_start();
include 'DB_CONN.php';
include 'Modal.php';

if (isset($_POST['Change_Areas'])) {
$idTrainer = $_POST['idTrainer'];
$total = $_POST['total'];
  $query = 'SELECT idArea from areaxtrainer  where idTrainer ='.$idTrainer;
  
  $cons = $db-> query($query);
  $k = array($_POST['a0'],$_POST['a1'],$_POST['a2'],$_POST['a3']);
  $cont = 0;
  $cont2 = 0;
  
  while ($cont < $total) {
      while ($row = $cons -> fetch_assoc()) {
      $sq = 'UPDATE areaxtrainer SET 
                  idArea  = '.'"'.$k[$cont].'"'.'
                  WHERE idTrainer = '.'"'.$idTrainer.'"'.'AND idArea='.'"'.$row['idArea'].'"';
      
      if ($db->query($sq) === TRUE) {
         /* echo $k[$cont].' reemplaza a '.$row['idArea'].' con el ID '. $_SESSION['id'];
          echo '<br>';
          */
      } else {
          echo "Error: " . $sq . "<br>" . $db->error;
      }
  
      $cont++;
      $cont2++;
           
      }
  
  }

  $query = 'SELECT areaxtrainer.idRegArea, areaxtrainer.idArea, areaxtrainer.idTrainer, trainers.nameTrainer, area.nombreArea 
  FROM areaxtrainer
INNER JOIN area ON area.idArea = areaxtrainer.idArea
INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
where areaxtrainer.idTrainer = '.$idTrainer;
$search = $db -> query($query);

$name = $db -> query($query);
  }



if (isset($_SESSION['idTrainer']) AND isset($_POST['Add_Area_To_Trainer'])) {

  $area = $_POST['area'];
 
    $query = 'INSERT INTO areaxtrainer (idTrainer, idArea)
              VALUES ('.$_SESSION['idTrainer'].','.$area.')';
              $db->query($query);

  $query = 'SELECT areaxtrainer.idRegArea, areaxtrainer.idArea, areaxtrainer.idTrainer, trainers.nameTrainer, area.nombreArea 
  FROM areaxtrainer
INNER JOIN area ON area.idArea = areaxtrainer.idArea
INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
where areaxtrainer.idTrainer = '.$_SESSION['idTrainer'];
   $search = $db -> query($query);
   $name = $db -> query($query);
}
 
elseif (isset($_POST['Add_Area_To_Trainer'])) {
  $area = $_POST['area'];
  $idTrainer = $_POST['idTrainer'];


  $query = 'SELECT * 
  FROM areaxtrainer
  WHERE areaxtrainer.idArea ='.$area.' AND areaxtrainer.idTrainer ='.$idTrainer;


if (mysqli_num_rows($db->query($query))) {
$_SESSION['area_restriction'] = "EL AREA QUE HAS INGRESADO YA EXISTE";
///header("Location: Watch_Op_From_Area.php");
} else {
  $query = 'INSERT INTO areaxtrainer (idTrainer, idArea)
  VALUES ('.$idTrainer.','.$area.')';
  $db->query($query);
  
}


    
              $query = 'SELECT areaxtrainer.idRegArea, areaxtrainer.idArea, areaxtrainer.idTrainer, trainers.nameTrainer, area.nombreArea 
              FROM areaxtrainer
           INNER JOIN area ON area.idArea = areaxtrainer.idArea
           INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
            where areaxtrainer.idTrainer = '.$idTrainer;
 $search = $db -> query($query);
 $name = $db -> query($query);

 if(isset($_SESSION['area_restriction'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['area_restriction'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['area_restriction']);
}
}

elseif (isset($_POST['Watch_Areas_From_Trainer'])) {
    $idTrainer = $_POST['idTrainer'];
 
 $query = 'SELECT areaxtrainer.idRegArea, areaxtrainer.idArea, areaxtrainer.idTrainer, trainers.nameTrainer, area.nombreArea 
 FROM areaxtrainer
INNER JOIN area ON area.idArea = areaxtrainer.idArea
INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
where areaxtrainer.idTrainer = '.$idTrainer;
 $search = $db -> query($query);
 $name = $db -> query($query);
 }
 elseif (isset($_SESSION['idTrainer'])) {

    $query = 'SELECT areaxtrainer.idRegArea, areaxtrainer.idArea, areaxtrainer.idTrainer, trainers.nameTrainer, area.nombreArea 
    FROM areaxtrainer
 INNER JOIN area ON area.idArea = areaxtrainer.idArea
 INNER JOIN trainers ON trainers.idTrainer = areaxtrainer.idTrainer
  where areaxtrainer.idTrainer = '.$_SESSION['idTrainer'];
     $search = $db -> query($query);
     $name = $db -> query($query);

 
}



  $query = 'SELECT * FROM area';

           $areaOpt =   $db ->query($query);

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
        <button class="btn btn-success" id="menu-toggle">
        <?php 
        $row = $name->fetch_assoc(); 
        echo $row['nameTrainer'] ;
        $_SESSION['nameTrainer'] = $row['nameTrainer'] ;
        ?> 
        </button>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <form action="" method="post">
<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModalCenter">
<i class="fas fa-plus-square"></i> Area
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">SELECCIONA EL AREA A AGREGAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="idTrainer" value="<?php echo $idTrainer ?>">
      <select required class='form-control col-md-6 chosen' name="area" id="area">
                        <option value="">SELECCIONA AREA</option>
                        <?php
                        if($areaOpt->num_rows > 0){  
                            while($row = $areaOpt -> fetch_assoc()){
                                echo '<option value="'.$row['idArea'].'">'.$row['nombreArea'].'</option>';
                              }
                        }
                        ?>   
                        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" formaction="Watch_Areas_From_Trainer.php" name="Add_Area_To_Trainer" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>

            </li>
            <li class="nav-item">
            <form action="" method='POST'>
            <input type="hidden" name="idTrainer" value='<?php echo $idTrainer ?>'>
            <input type="hidden" name="SessionIdTrainer" value='<?php echo $_SESSION['idTrainer'] ?>'>

            <?php 
           /* $i = 0;
            while ($row = $search2 -> fetch_assoc()) {
              echo  '<input type="hidden" name="area'.$i.'" value="'.$row['idArea'].'">';
              $i++;
            }*/
            ?>
            <button class="btn btn-success" formaction="Exchange_Areas_From_Trainer.php" name="Exchange_Area" type="submit">
            <i class="fas fa-exchange-alt"></i> Area</button>
            </form>
            </li>
            <li class="nav-item dropdown">
            <form action="" method='POST'>
            <button class="btn btn-danger" formaction="Visualize_Trainers.php"  type="submit">
            <i class="fas fa-undo-alt"></i></button>
            </form>
              
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
                                <td>Area</td>
                                <td></td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                    while($data = $search->fetch_array()) {            
                    echo '<tr>';
                    echo   '<form action="" method="POST">';
                    echo '<input type="hidden" name="idTrainer" value="'.$data['idTrainer'].'">';
                    echo '<td><input type="hidden" name="idRegArea" value="'.$data['idRegArea'].'">'.$data['idRegArea'].'</td>';
                    echo '<td><input type="hidden" name="nombreArea" value="'.$data['nombreArea'].'">'.$data['nombreArea'].'</td>';
                      echo  '<td><button type="submit" 
                            formaction="Delete.php" 
                            name="Delete_Area_From_Trainer" 
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
<!-- AQUI -->

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
