<?php 
include 'DB_CONN.php';
session_start();

if (isset($_POST['Apply_Test'])) {

  $idOperacion = $_POST['operacion'];
  $idCertification = $_POST['idCertification'];

  
  $query = 'SELECT trainers.nameTrainer, area.nombreArea, operacion.nOperacion, empleados.nameEmpleado, 
                    empleados.idEmpleado, certsq.calification, testtaken.date
            FROM certsq
            INNER JOIN trainers ON trainers.idTrainer = certsq.idTrainer
            INNER JOIN area ON area.idArea = certsq.idArea
            INNER JOIN operacion ON operacion.idOperacion = certsq.idOperacion
            INNER JOIN empleados ON empleados.idEmpleado = certsq.idEmpleado
            INNER JOIN testtaken ON certsq.idCertification = testtaken.idCertification
            WHERE certsq.idCertification ='.$idCertification;
  $j = $db->query($query);
    $row2 = $j -> fetch_assoc();



$query = 'SELECT test.idTest, questions.idQuestion, questions.question
FROM test 
INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
INNER JOIN certsq ON certsq.idOperacion = test.idOperacion
WHERE certsq.idCertification  ='.$idCertification;
          $i = $db->query($query);
 
          
$query = 'SELECT COUNT(questions.idQuestion) as suma
            FROM test 
            INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
            INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
            INNER JOIN certsq ON certsq.idOperacion = test.idOperacion
            WHERE certsq.idCertification  ='.$idCertification;
            $j = $db->query($query);
            $jj = $j -> fetch_assoc();       
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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      

</head>

<body>

  <div class="d-flex" id="wrapper">
  <?php 
  if ($_SESSION['typeUser'] == 1) {
    include "Trainer_Template.php";
  } else {
    include "Admin_Template.php";
  }
  
   
  
  ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-info" id="menu-toggle">CREAR EXAMEN</button>

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
        <div class="container">
          <div class="row">
            <div class="col-sm">
            <form>
  <div class="row">
    <div class="col">
     <p><strong>Entrenador: </strong><?php echo $row2['nameTrainer'] ?></p>
    </div>
    <div class="col">
    <div class="col">
     <p><strong>Fecha: </strong><?php echo $row2['date'] ?></p>
    </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
     <p><strong>Area: </strong><?php echo $row2['nombreArea'] ?></p>
    </div>
    <div class="col">
    <div class="col">
     <p><strong>Operacion: </strong><?php echo $row2['nOperacion'] ?></p>
    </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
     <p><strong>NO. Reloj: </strong><?php echo $row2['idEmpleado'] ?></p>
    </div>
    <div class="col">
    <div class="col">
     <p><strong>Nombre Empleado: </strong><?php echo $row2['nameEmpleado'] ?></p>
    </div>
    </div>
  </div>


  <div class="row">
    <div class="col">
     <p><strong>Calificacion: </strong><?php echo $row2['calification'] ?></p>
    </div>
    <div class="col">
    <div class="col">
     <p><strong>Aprobado: </strong><?php if ($row2['calification'] >= 8) { echo "SI";} else { echo "NO";} ?></p>
    </div>
    </div>

    </div>
</form>


           
            <?php




echo '<form action="" method="post">';

echo '<input type="hidden" name="idCertification" value="'.$idCertification.'">';
echo '<input type="hidden" name="nquestions" value="'.$jj['suma'].'">';
$cont = 1;
while ($row = $i->fetch_assoc()) {
  echo $cont.'.    ';
  echo '<input type="hidden" name="question_'.$cont.'" value="'.$row['idQuestion'].'">'.$row['question'];
                $query = 'SELECT answerstest.idQuestion, answerstest.idAnswer, answer.answer, answer.value
                from answerstest
                  INNER JOIN answer ON answer.idAnswer =  answerstest.idAnswer
                  INNER JOIN testtaken ON testtaken.idTestTaken = answerstest.idTestTaken
                  WHERE answerstest.idQuestion="'.$row['idQuestion'].'"'.'AND testtaken.idCertification ="'.$idCertification.'"';;
                $j = $db->query($query);
                echo '<br>';
                echo '<br>';

    
                while($row2 = $j->fetch_assoc()){
                  if ($row2['value'] == 0) {
                  
                  echo '<select class="selectpicker col-md-10" data-style="btn-danger"  name="answer_'.$cont.'" >';
                          
                  } elseif ($row2['value'] == 1) {
                  
                    echo '<select class="selectpicker col-md-10" data-style="btn-success"  name="answer_'.$cont.'" >';
                            
                    }
                 
                    echo '<option class="text-muted" value="'.$row2['idAnswer'].'">'.$row2['answer'].'</option>';
                  
                  echo '</select>';
                  }
                  echo '<br>';
                  $cont++;
                }
  echo '<br>';

        ?>
            </div>
        </div>
    </div>
    <div class='row'>
   
                <div class='col-sm-3'></div>    
                 <?php
                  if ($_SESSION['typeUser'] == 1) {
                   echo '<button class="col-sm-3 btn btn-primary" formaction="Trainer_Cert_Complete.php"  type="submit"><i class="fas fa-undo-alt"></i></button>';
                  } else {
                    echo '<button class="col-sm-3 btn btn-primary" formaction="Admin_Cert_Complete.php"  type="submit"><i class="fas fa-undo-alt"></i></button>';
                  }
                  
                 ?>

                
                </div>

                 <div class='row'>
                <div class='col-sm-1'></div>   
                <p>_____________________________________________________</p>
            
                <div class='col-sm-2'></div>    

                 <p>_____________________________________________________</p>
       
                <div class='col-sm-2'></div>
                </div>

                <div class='row'>
                <div class='col-sm-1'></div>   
                <p>FIRMA JEFE INMEDIATO SUPERIOR</p>
                <div class='col-sm-4'></div>    
                <p>FIRMA DEL ENTRENADOR</p>
                <div class='col-sm-2'></div>
                </div>


                  <br>
                <div class='row'>
                    <div class='col-sm-1'></div>   
                 <p>_____________________________________________________</p>
                <div class='col-sm-2'></div>
                <p>_____________________________________________________</p>
                <div class='col-sm-2'></div>
                </div>

                <div class='row'>
                <div class='col-sm-1'></div>   
                <p>FIRMA DEL EMPLEADO</p>
                <div class='col-sm-5'></div>    
                <p>CALIFICACION</p>
                <div class='col-sm-2'></div>
                </div>
</div>
</div>
</div>

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
