

<!DOCTYPE html
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js.js"></script>
    <title>Document</title>
    <style>
    </style>


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
</head>
<body>           
<?php include"main_template.php" ?>
<div class='jumbotron container'>
      <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    
                </div>
            </nav>
<?php
    if (isset($_GET['id_add'])) {


        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d H:i:s');

echo '<form action="verify.php" method="POST">';
echo '<div class="row">';
echo '<div class="col-md-4"></div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">NUMERO DE HORAS</span>
                    </div>
                    <input type="number" step=.5 min="1" max="7.5" name="num" id="num">
                    <input type="hidden" name="fechaCreacion" value="'.$fc.'">
                    <input type="hidden" name="fechaIngreso" value="'.$date.'">
                    <input type="hidden" name="lastUp" value="'.$lastUp.'">
                    
                    <input type="hidden" name="idTrainer" value="'.$idTrainer.'">
                    <input type="hidden" name="idEmpleado" value="'.$idEmpleado.'">
                    <input type="hidden" name="idCertification" value="'.$cert.'">
                    <div class="col-md-1"></div>
                    <button class="col-sm-3 btn btn-dark" type="submit">Guardar datos</button></div>
                </div>
            </div>
        </div>';
        echo '</form>';
    
}



if (isset($_GET['id_add2'])) {

    date_default_timezone_set('America/Mexico_City');
    $date = date('Y-m-d H:i:s');
    echo '<form action="verify.php" method="POST">';
echo '<div class="row">';
echo '<div class="col-md-4"></div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">NUMERO DE HORAS</span>
                    </div>
                    
                    <input type="number" step=.5 min="1" max="7.5" name="num2" id="num2">
                    <input type="hidden" name="fechaCreacion" value="'.$fc.'">
                    <input type="hidden" name="fechaIngreso" value="'.$date.'">
                    <input type="hidden" name="lastUp" value="'.$lastUp.'">


                    <input type="hidden" name="idTrainer" value="'.$idTrainer.'">
                    <input type="hidden" name="idEmpleado" value="'.$idEmpleado.'">
                    <input type="hidden" name="idCertification" value="'.$cert2.'">
                    <div class="col-md-1"></div>
                    <button class="col-sm-3 btn btn-dark" type="submit">Guardar datos</button></div>
                </div>
            </div>
        </div>';
        echo '</form>';
    
    }
?>


</div>

<script>
$("body").on("submit", "form", function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});
</script>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

     <!-- jQuery, Popper.js, Bootstrap JS -->
     <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
</body>
</html>