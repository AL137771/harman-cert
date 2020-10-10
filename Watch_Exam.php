<?php 
include 'DB_CONN.php';
session_start();

if (isset($_POST['Apply_Test'])) {
 $idOperacion = $_POST['operacion'];
 $idCertification = $_POST['idCertification'];

    $test = 'SELECT test.idTest, questions.idQuestion, questions.question
              FROM test
              INNER JOIN questions ON questions.idTest = test.idTest
              WHERE test.idOperacion ='.$idOperacion;
    $questions = $db->query($test);

    $conteo = $db->query($test);
 
    $i = 'SELECT COUNT(questions.idQuestion) as suma FROM test 
    INNER JOIN questions ON questions.idTest = test.idTest
    WHERE idOperacion  = '.$idOperacion;
    
    $ii = $db->query($i);
    $iii = $ii -> fetch_assoc();

    $jj = $db->query($i);
    $jjj = $jj -> fetch_assoc();

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

  <?php include "Trainer_Template.php"; ?>

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
        <div class="container">
          <div class="row">
            <div class="col-sm">
            <?php

echo '<form action="" method="post">';
echo '<input type="hidden" name="idCertification" value="'.$idCertification.'">';
echo '<input type="hidden" name="nquestions" value="'.$iii['suma'].'">';

$cont = 1;
while ($cont <= $iii['suma']){

            while ($row = $questions -> fetch_assoc() ) {

             echo '<div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Pregunta '.$cont.'</span>
                    </div>';
              echo  '<input type="hidden" name="question_'.$cont.'" value="'.$row['idQuestion'].'">'.$row['question'];
              
              $cont++;
              echo '</div>';
              echo '<br>';
              echo '<br>';
              echo '<br>';
              }
              
            }
            ?>
            </div>
            <div class="col-sm">
            <?php
            $l = 1;
        while ($l <= $jjj['suma']){
        while ($cont = $conteo->fetch_assoc()) {
  
          $answers = 'SELECT test.idTest, questions.idQuestion, answer.idAnswer, answer.answer, answer.value
                      FROM test
                      INNER JOIN questions ON questions.idTest = test.idTest
                      INNER JOIN answer ON answer.idQuestion = questions.idQuestion
                      WHERE questions.idQuestion = '.$cont['idQuestion'];
                  $resp = $db->query($answers);
               
                  echo '<select class="form-control col-md-8" name="answer_'.$l.'" >';
                  echo '<option class="text-muted" value="">'.$l.'</option>';
                  while ($contar = $resp -> fetch_assoc()) {
                    echo '<option class="text-muted" value="'.$contar['idAnswer'].'">'.$contar['answer'].'</option>';
                  }
                  echo '</select>';
                  echo '<br>';
                  echo '<br>';
                  echo '<br>';
                  $l++;
      }
    }
    
        ?>
            </div>
        </div>
    </div>
    <div class='row'>
                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Trainer_Cert_Complete.php" name='Add_Answers' type="submit">Guardar datos</button>
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
