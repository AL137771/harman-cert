<?php
include 'DB_CONN.php';
session_start();


if(isset($_SESSION['admin_restriction'])){
  echo "<script type='text/javascript'>
          alert('" . $_SESSION['admin_restriction'] . "');
        </script>";
  //to not make the error message appear again after refresh:
  unset($_SESSION['admin_restriction']);
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
        <button class="btn btn-dark" id="menu-toggle">CREAR ADMINISTRADOR</button>

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

      <form action='' method="post">
        <div class='form-group container'>
                <div class='row'>

                    <div class='col-md-3'></div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">NOMBRE</span>
                        </div>
                        
                        <input type="text" name='admin' id='admin' class="form-control">
                        
                        </div>
                                            
                        <div class='formcontrol col-md-3'></div>
                       </div>

                    <br>


                    <div class='row'>
                
                <div class='col-md-3'></div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">E-MAIL</span>
                    </div>
                    
                    <input type="text" name='email' id='email' class="form-control">

                    <input type="hidden" name="typeUser" value="2">
                    
                    </div>
                                        
                    <div class='formcontrol col-md-3'></div>
                   </div>
                <br>

                 
                <div class='row'>


                <div class='col-sm-3'></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Visualize_Admins.php" name='Create_Admin' type="submit">Guardar datos</button>
                </div>
                    
                    <br>
                <div class='row'>
                <div class='col-sm-3'></div>    
                <a href="Admin_MainPage.php"  class="col-sm-6 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
                </div>
                    
    

                
                
        </div>
        <div class='form-group container'>
                <div class='row'>
                
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
