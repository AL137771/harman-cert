<?php

include 'DB_CONN.php';
session_start();



  

if (isset($_POST['Create_Test'])) {

      $_SESSION['cantA'] = $_POST['cantA'];
      $idOperacion = $_POST['idOperacion'];
      $query = 'SELECT test.idTest, test.idOperacion FROM test where test.idOperacion ='.'"'.$idOperacion.'"';


      if (mysqli_num_rows($db->query($query))) {
      $_SESSION['test_restriction'] = "EL EXAMEN QUE HAS INGRESADO YA EXISTE";
      header("Location: Create_Test.php");
      } else {

    $query = 'INSERT INTO test (idOperacion) VALUES ('.$idOperacion.')';
    $db->query($query);

    $query = 'SELECT idTest from test WHERE idOperacion ='.$idOperacion;
    $test = $db ->query($query);
    $row = $test -> fetch_assoc();
    $_SESSION['idTest'] = $row['idTest'];

}

}


if (isset($_POST['Add_Question'])) {
    
    if(isset($_SESSION['preguntarepetida'])){
        echo "<script type='text/javascript'>
                alert('" . $_SESSION['preguntarepetida'] . "');
              </script>";
        //to not make the error message appear again after refresh:
        unset($_SESSION['preguntarepetida']);
      }

    if ($_SESSION['Test'] < $_SESSION['cantA']) {

    
    $question = $_POST['question'];
    

    $opcion_1 = $_POST['opcion_1'];
    $opcion_2 = $_POST['opcion_2'];
    $opcion_3 = $_POST['opcion_3'];
    $correct = $_POST['correct'];
      

    $query = 'SELECT idQuestion from questions where question ="'.$question.'"';
  
            
    if (mysqli_num_rows($ans = $db->query($query))) {

      
        $row = $ans ->fetch_assoc();
        
        $query = 'INSERT into questionxtest (idQuestion, idTest)
            VALUES ('.'"'.$row['idQuestion'].'", '.$_SESSION['idTest'].')';

            $db->query($query);
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



 
    $_SESSION['Test']++;
    
} else {

    $question = $_POST['question'];
    

    $opcion_1 = $_POST['opcion_1'];
    $opcion_2 = $_POST['opcion_2'];
    $opcion_3 = $_POST['opcion_3'];
    $correct = $_POST['correct'];
      

    $query = 'SELECT idQuestion from questions where question ="'.$question.'"';
  
            
    if (mysqli_num_rows($ans = $db->query($query))) {

      
        $row = $ans ->fetch_assoc();
        
        $query = 'INSERT into questionxtest (idQuestion, idTest)
            VALUES ('.'"'.$row['idQuestion'].'", '.$_SESSION['idTest'].')';

            $db->query($query);
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
                echo "MUY BIEN";
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



 
   /// $_SESSION['Test']++;
    header("Location: Create_Test.php");

}   


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



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
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
        <button class="btn btn-success" id="menu-toggle">Pregunta <?php echo  $_SESSION['Test']?> de <?php echo  $_SESSION['cantA']?> </button>

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

                    <div class='col-md-3'></div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <input type="hidden" name="idTest" value="<?php echo $row['idTest'] ?>">
                            <span class="input-group-text" id="">PREGUNTA </span>
                        </div>
                        
                        <input required type="text" name='question' class="form-control">
                        
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
                                <input required type="text" name='opcion_1' id='opcion_1' class="form-control">  
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
                                <input required type="text" name='opcion_2' id='opcion_2' class="form-control">  
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
                                <input required type="text" name='opcion_3' id='opcion_3' class="form-control">  
                            </div>            
                    <div class='formcontrol col-md-3'></div>
                   </div>
                
                <br><br><br>
                <div class='row'>
                    <div class='col-md-3'></div>
                     <select required class="form-control col-md-6" data-style="btn-primary" name="correct">
                    <option></option>
                     <option value="1">OPCION 1</option>
                     <option value="2">OPCION 2</option>
                     <option value="3">OPCION 3</option>
                   

                     </select>
                   </div>
                <br><br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Add_Questions_To_Created_Test.php" name='Add_Question' type="submit">Guardar datos</button>
                </div>
                    
                <br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <a href="Admin_MainPage.php"  class="col-sm-6 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
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
