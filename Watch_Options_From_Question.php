<?php

session_start();
include 'DB_CONN.php';
include 'Modal.php';
if (isset($_POST['Watch_Options_From_Question'])) {
    $idQuestion = $_POST['idQuestion'];
    $idTest = $_POST['idTest'];
    $query = 'SELECT questions.question, answer.idAnswer, answer.answer, answer.value
    FROM answer
    INNER JOIN questions ON questions.idQuestion = answer.idQuestion
    WHERE questions.idQuestion = '.$idQuestion;

    $query2 = 'SELECT COUNT(*) as suma
    FROM answer
    INNER JOIN questions ON questions.idQuestion = answer.idQuestion
    WHERE questions.idQuestion = '.$idQuestion;

    $count = $db->query($query2);
    $conteo = $count->fetch_assoc();
    
    $answers = $db->query($query);
    
    $answers2 = $db->query($query);

    $row = $answers->fetch_assoc();

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
        <button class="btn btn-success" id="menu-toggle">
        <?php 
      ///  $row = $name->fetch_assoc(); 
        echo $row['nameTrainer'] ;
     ///   $_SESSION['nameTrainer'] = $row['nameTrainer'] ;
        ?> 
        </button>
       
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
     
<form action='' method="post">
        <div class='form-group container'>
                <div class='row'>

                    <div class='col-md-3'></div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">PREGUNTA</span>
                        </div>
                        <input type="hidden" name="idTest" value="<?php echo $idTest ?>">
                        <input type="hidden" name="idQuestion" value="<?php echo $idQuestion ?>">
                        <input type="text" name='question' class="form-control" value="<?php echo $row['question'] ?>">                        
                        </div>
                                            
                        <div class='formcontrol col-md-3'></div>
                       </div>

                    <br>

                    <?php 
                $cont = 1;
                while ($cont < $conteo['suma']) {
                while ( $row2 = $answers2 -> fetch_assoc()) {
                echo '<div class="row">
                        <div class="input-group">
                          <div class="input-group-prepend">'; 
                                echo '<span class="input-group-text" id="">OPCION '.$cont.'</span>
                          </div>
                                    <input type="hidden" name="idAnswer_'.$cont.'" value='.$row2['idAnswer'].'>';

                                    if ($row2['value'] ==  1) {
                                      echo  '<input  type="text" class="form-control text-light bg-success" name="opcion_'.$cont.'" id="opcion_1" 
                                      class="form-control" value="'.$row2['answer'].'"> 
                                                                        </div>            
                                                                      </div>';
                                    } elseif ($row2['value'] ==  0) {
                                      echo  '<input  type="text" class="form-control text-light  bg-danger"name="opcion_'.$cont.'" id="opcion_1" 
                                      class="form-control" value="'.$row2['answer'].'"> 
                                                                      </div>            
                                                                    </div>';      
                                    }
                                  
                                   
                          
                                          $cont++;
                                                      }   
                                                  }
                                              ?>
                                              <br><br>
                            <div class='row'>
                            <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">SELECCIONA LA OPCION CORRECTA</span>
                        </div>
                                <select class="form-control col-sm-12" data-style="btn-primary" name="correct">
                                  <option> </option>
                                  <option value="0">OPCION 1</option>
                                  <option value="1">OPCION 2</option>
                                  <option value="2">OPCION 3</option>
                                </select>
                                </div>
                            </div>
                            <br><br><br><br>
                              <div class='row'>
                                 <div class='col-sm-3'></div>
                                    <button class="col-sm-3 btn btn-primary" formaction="Watch_Questions_From_Test.php" name='Update_Question' type="submit"><i class="fas fa-sign-in-alt"></i></button>
                              </div>
                              <br>
                            <div class='row'>
                            <div class='col-sm-3'></div>
                            <button class="col-sm-3 btn btn-danger" formaction="Watch_Questions_From_Test.php" name='Watch_Questions_From_Test' type="submit"><i class="fas fa-undo-alt"></i></button>

                            </div> 
                                        
                              </div>
</form>

</div>
<div>
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
