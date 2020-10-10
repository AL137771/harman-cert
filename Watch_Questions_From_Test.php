<?php

session_start();
include 'DB_CONN.php';
include 'Modal.php';

if (isset($_POST['Watch_Questions_From_Test'])) {
   $idTest = $_POST['idTest'];
    $_SESSION['operacion'] = $_POST['nOperacion'];
    $query = 'SELECT questionxtest.idTest, questions.idQuestion, questions.question
    FROM test
    INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
    INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
    WHERE test.idTest ="'.$idTest.'"';
    $questions = $db->query($query);
}

if (isset($_SESSION['idTest'])) {
  $_SESSION['idTest'];


  $query = 'SELECT questionxtest.idTest, questions.idQuestion, questions.question
  FROM test
  INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
  INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
  WHERE test.idTest ='.'"'.$_SESSION['idTest'].'"';
  $questions = $db->query($query);
}

if (isset($_POST['Update_Question'])) {

  $idQuestion = $_POST['idQuestion'];
  $question = $_POST['question'];
  $idTest =$_POST['idTest'];
  $correct = $_POST['correct'];

  $answer = array($_POST['opcion_1'], $_POST['opcion_2'], $_POST['opcion_3']);

  $idAnswer = array($_POST['idAnswer_1'], $_POST['idAnswer_2'], $_POST['idAnswer_3']);

  $query = 'UPDATE questions 
            SET question ='.'"'.$question.'"
            WHERE idQuestion ='.$idQuestion;
        
        if ($db->query($query)) {
          echo "";
        } else {
          echo $db->error;
        }
        
        for ($i=0; $i < 3 ; $i++) { 
              $query = 'UPDATE answer 
                        SET answer ='.'"'.$answer[$i].'"
                        WHERE idAnswer ='.$idAnswer[$i];
                        if ($db->query($query)) {
                          echo "";
                        } else {
                          echo $db->error;
                        }
              
                  if ($correct == $i ) {
                $query = 'UPDATE answer 
                SET answer.value = 1
                WHERE idAnswer ='.$idAnswer[$i];
                 if ($db->query($query)) {
                  echo "";
                } else {
                  echo $db->error;
                }
              } else {
              
              $query = 'UPDATE answer 
                        SET answer.value = 0
                        WHERE idAnswer ='.$idAnswer[$i];
                         if ($db->query($query)) {
                          echo "";
                        } else {
                          echo $db->error;
                        }
                      }
            }

            
            $query = 'SELECT questionxtest.idTest, questions.idQuestion, questions.question
            FROM test
            INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
            INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
            WHERE test.idTest ='.$idTest;
            $questions = $db->query($query);



}



if (isset($_POST['Add_Question'])) {
  $idTest = $_POST['idTest'];
  $_SESSION['idTest'] = $_POST['idTest'];
  
  if(isset($_SESSION['preguntarepetida'])){
      echo "<script type='text/javascript'>
              alert('" . $_SESSION['preguntarepetida'] . "');
            </script>";
      //to not make the error message appear again after refresh:
      unset($_SESSION['preguntarepetida']);
    }

 
    $_SESSION['idTest'];
  $question = $_POST['question'];
  

  $opcion_1 = $_POST['opcion_1'];
  $opcion_2 = $_POST['opcion_2'];
  $opcion_3 = $_POST['opcion_3'];
  $correct = $_POST['correct'];
    

  $query = 'SELECT idQuestion from questions where question ="'.$question.'"';

          
  if (mysqli_num_rows($ans = $db->query($query))) {

    
      $row = $ans ->fetch_assoc();
      
     
          $_SESSION['preguntarepetida'] = "Pregunta ya existia";

    }
    else {


      $query = 'INSERT into questions (question)
      VALUES ("'.$question.'")';
          $db->query($query);
          
          
      $query = 'SELECT idQuestion from questions where question ="'.$question.'"';
    ////  $db->query($query);

          $ans = $db->query($query);
          $row = $ans ->fetch_assoc();

          $query = 'INSERT into questionxtest (idQuestion, idTest)
          VALUES ('.$row['idQuestion'].','.$_SESSION['idTest'].')';
          
          if ($db->query($query) === TRUE) {
              echo "";
          }
          else {
              echo $db->error;
          }
          
    

          $answers1 = 'INSERT into answer (idQuestion, answer)
          VALUES ('.$row['idQuestion'].',"'.$opcion_1.'")';
  

          if ($db->query($answers1)===  TRUE) {
              echo "";
          }
          else {
              echo "OPCION 1 :";
              echo $db->error;
              echo "<br>";
          }
          
          $answers2 = 'INSERT into answer (idQuestion, answer)
          VALUES ('.$row['idQuestion'].',"'.$opcion_2.'")';
          //$question2 = 
          
          if ($db->query($answers2) ===  TRUE) {
              echo "";
           
          }
          else {
              echo "OPCION 2 :";
      
              echo $db->error;
              echo "<br>";
          }   
          $answers3 = 'INSERT into answer (idQuestion, answer)
          VALUES ('.$row['idQuestion'].',"'.$opcion_3.'")';
            //$question3 = 
           
            if ($db->query($answers3) ===  TRUE) {
              echo "";
          }
          else {
              echo "OPCION 3 :";
      
              echo $db->error;
              echo "<br>";
          }
          
            if ($correct == 1) {
                $query = 'UPDATE answer 
                          SET value = 1
                          WHERE idQuestion ='.$row['idQuestion'].'
                          AND answer ='.'"'.$opcion_1.'"';
                       if ($db->query($query) ===  TRUE) {
                           echo "";
                       }
                       else {
                           echo $db->error;
                       }
                          $db->query($query);
            } elseif ($correct == 2) {
              $query = 'UPDATE answer 
                          SET value = 1
                          WHERE idQuestion ='.$row['idQuestion'].'
                          AND answer ='.'"'.$opcion_2.'"';
                          $db->query($query);
                          if ($db->query($query) ===  TRUE) {
                              echo "";
                          }
                          else {
                              echo $db->error;
                          }
          } elseif ($correct == 3) {
              $query = 'UPDATE answer 
                          SET value = 1
                          WHERE idQuestion ='.$row['idQuestion'].'
                          AND answer ='.'"'.$opcion_3.'"';
                          $db->query($query);
                          if ($db->query($query) ===  TRUE) {
                              echo "";
                          }
                          else {
                              echo $db->error;
                          }
          } 
    
    
      }

      $query = 'SELECT questionxtest.idTest, questions.idQuestion, questions.question
      FROM test
      INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
      INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
      WHERE test.idTest ='.$idTest;
      $questions = $db->query($query);

  
}



if (!isset($_SESSION['idTest'])) {

$query = 'SELECT questionxtest.idTest, questions.idQuestion, questions.question
FROM test
INNER JOIN questionxtest ON questionxtest.idTest = test.idTest
INNER JOIN questions ON questions.idQuestion = questionxtest.idQuestion
WHERE test.idTest ='.$idTest;
$questions = $db->query($query);
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
        <button class="btn btn-success" id="menu-toggle"><?php echo $_SESSION['operacion'] ?>
        <?php 
      ///  $row = $name->fetch_assoc(); 
     ///   echo $row['nameTrainer'] ;
     ///   $_SESSION['nameTrainer'] = $row['nameTrainer'] ;
        ?> 
        </button>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <form action="" method="post">
<button type="button" class="btn btn-info " data-toggle="modal" data-target="#exampleModalCenter">
<i class="fas fa-plus-square"></i> Pregunta
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">AGREGAR NUEVA PREGUNTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class='form-group container'>
                <div class='row'>

                    <div class='col-md-3'></div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <input type="hidden" name="idTest" value="<?php echo $idTest ?>">
                            <span class="input-group-text" id="">PREGUNTA </span>
                        </div>
                        
                        <input type="text" name='question' class="form-control">
                        
                        </div>
                                            
                        <div class='formcontrol col-md-3'></div>
                       </div>

                    <br>


                <div class='row'>
                    <div class='col-md-3'></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">OPCION 1</span>
                            </div>
                                <input type="text" name='opcion_1' id='opcion_1' class="form-control">  
                            </div>            
                    <div class='formcontrol col-md-3'></div>
                   </div>
                <br>
                <div class='row'>
                    <div class='col-md-3'></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">OPCION 2</span>
                            </div>
                                <input type="text" name='opcion_2' id='opcion_2' class="form-control">  
                            </div>            
                    <div class='formcontrol col-md-3'></div>
                   </div>
                <br>
                <div class='row'>
                    <div class='col-md-3'></div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">OPCION 3</span>
                            </div>
                                <input type="text" name='opcion_3' id='opcion_3' class="form-control">  
                            </div>            
                    <div class='formcontrol col-md-3'></div>
                   </div>
                
                <br><br><br>
                <div class='row'>
                    <div class='col-md-3'></div>
                     <select class="form-control" data-style="btn-primary" name="correct">
                     <option value="1">OPCION 1</option>
                     <option value="2">OPCION 2</option>
                     <option value="3">OPCION 3</option>
               

                     </select>
                   </div>
                <br><br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Watch_Questions_From_Test.php" name='Add_Question' type="submit">Guardar datos</button>
                </div>
                    
                <br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <a href="Admin_MainPage.php"  class="col-sm-6 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
                </div>
                  
        </div>
   
      </div>
    </div>
  </div>
</div>
</form>

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
                                <td>Question</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                            
                    while($data = $questions->fetch_array()) {            
                    echo '<tr>';
                    echo   '<form action="" method="POST">';
                    echo '<input type="hidden" name="idTest" value="'.$data['idTest'].'">';
                    echo '<td><input type="hidden" name="idQuestion" value="'.$data['idQuestion'].'">'.$data['idQuestion'].'</td>';
                    echo '<td><input type="hidden" name="question" value="'.$data['question'].'">'.$data['question'].'</td>';
                    echo  '<td>
                    <button type="submit" 
                    formaction="Watch_Options_From_Question.php" 
                    name="Watch_Options_From_Question" 
                    class="btn btn-outline-info">
                    <i class="fas fa-eye"></i>
                    </button>
                    </td>';
                    echo  '<td><button type="submit" 
                            formaction="Delete.php" 
                            name="Delete_Question_From_Test" 
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
