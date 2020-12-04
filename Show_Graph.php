<?php

include "DB_CONN.php";
session_start();

    if (isset($_POST['Graph'])) {
       
    $date_1 = $_POST['date_1'];
    $date_2 = $_POST['date_2'];

    $typeC = $_POST['typeC'];
    $typeV = $_POST['typeV'];
    $typeG = $_POST['typeG'];

    if ($typeC == 1) {
        if ($typeV ==1) {
            if ($typeG == 1) {
                $sql ='SELECT DISTINCT CAST(hrsregistered.fechaRegist AS DATE), hrsregistered.idTrainer, trainers.nameTrainer, 
                                SUM(hrsregistered.hourRegistered) as totHRS
             FROM hrsregistered
             INNER JOIN trainers on trainers.idTrainer = hrsregistered.idTrainer
             WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.' AND '.'"'.$date_2.'"'.'
             GROUP BY hrsregistered.idTrainer';
            
             $result = $db->query($sql);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                $productname[]  = $row['nameTrainer']  ;
                $sales[] = $row['totHRS'];
            }
            } elseif ($typeG == 2) {
                            
                            $sql ='SELECT DISTINCT CAST(hrsregistered.fechaRegist AS DATE), turno.idTurno, turno.nameTurno,
                            SUM(hrsregistered.hourRegistered) as totHRS
                            FROM hrsregistered
                            INNER JOIN trainers on trainers.idTrainer = hrsregistered.idTrainer
                            INNER JOIN turno on trainers.idTurno = turno.idTurno
                            WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.' AND '.'"'.$date_2.'"'.'
                            GROUP BY turno.idTurno';
                        
                        
                        
                        $result = $db->query($sql);
                         $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                            $productname[]  = $row['nameTurno']  ;
                            $sales[] = $row['totHRS'];}
            }
             elseif ($typeG == 3) {

                $result = 'SELECT DISTINCT area.idArea, area.nombreArea, SUM(hrsregistered.hourRegistered) as totHRS FROM hrsregistered
                 INNER JOIN trainers on trainers.idTrainer = hrsregistered.idTrainer 
                 INNER JOIN certsq on hrsregistered.idCertification = certsq.idCertification 
                 INNER JOIN area ON area.idArea = certsq.idArea 
                 WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.' AND '.'"'.$date_2.'"'.'
                 GROUP BY area.idArea';

                   
                    $result = $db->query($result);
                           $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                        $productname[]  = $row['nombreArea']  ;
                        $sales[] = $row['totHRS'];}
                    }

                
        }
        elseif ($typeV == 2) {
             if ($typeG == 1) {
               $query = 'SELECT CAST(lastUp AS DATE), certsq.idTrainer, trainers.nameTrainer, SUM(certsq.status) as status
                FROM certsq
                INNER JOIN trainers on trainers.idTrainer = certsq.idTrainer
                WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                AND certsq.status = 1 
                GROUP BY certsq.idTrainer';

                $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                    $productname[]  = $row['nameTrainer']  ;
                    $sales[] = $row['status'];}


            } elseif ($typeG == 2) {
                $query = 'SELECT DISTINCT CAST(lastUp AS DATE), certsq.idTrainer, turno.idTurno, turno.nameTurno , SUM(certsq.status) as status
                FROM certsq
                INNER JOIN trainers on trainers.idTrainer = certsq.idTrainer
                INNER JOIN turno on trainers.idTurno = turno.idTurno
                WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                AND certsq.status = 1 
                GROUP BY turno.idTurno';

               $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                    $productname[]  = $row['nameTurno']  ;
                    $sales[] = $row['status'];}
            }
             elseif ($typeG == 3) {
                $query = 'SELECT CAST(lastUp AS DATE), certsq.idTrainer, area.idArea, area.nombreArea , SUM(certsq.status) as status
                FROM certsq
                INNER JOIN trainers on trainers.idTrainer = certsq.idTrainer
                INNER JOIN area on area.idArea = certsq.idArea
                WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                AND certsq.status = 1 
                GROUP BY certsq.idArea';

                $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                    $productname[]  = $row['nombreArea']  ;
                    $sales[] = $row['status'];}
            }        
        }
    }
    elseif ($typeC == 2) {
        if ($typeV ==1) {
            if ($typeG == 1) {
                $sql ='SELECT DISTINCT CAST(hrsregisteredrecert.fechaRegist AS DATE), hrsregisteredrecert.idTrainer, trainers.nameTrainer, 
                SUM(hrsregisteredrecert.hourRegistered) as totHRS
                FROM hrsregisteredrecert
                INNER JOIN trainers on trainers.idTrainer = hrsregisteredrecert.idTrainer
                WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.' AND '.'"'.$date_2.'"'.'
                GROUP BY hrsregisteredrecert.idTrainer';
                $result = $db->query($sql);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                $productname[]  = $row['nameTrainer']  ;
                $sales[] = $row['totHRS'];
                }
            } elseif ($typeG == 2) {
                $sql ='SELECT DISTINCT CAST(hrsregisteredrecert.fechaRegist AS DATE), turno.idTurno, turno.nameTurno ,
                            SUM(hrsregisteredrecert.hourRegistered) as totHRS
                            FROM hrsregisteredrecert
                            INNER JOIN trainers on trainers.idTrainer = hrsregisteredrecert.idTrainer
                            INNER JOIN turno on trainers.idTurno = turno.idTurno
                            WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.' AND '.'"'.$date_2.'"'.'
                            GROUP BY turno.idTurno';
                        
                        
                        $result = $db->query($sql);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                            $productname[]  = $row['nameTurno']  ;
                            $sales[] = $row['totHRS'];}
            }
             elseif ($typeG == 3) {
                $result = 'SELECT DISTINCT area.idArea, area.nombreArea, SUM(hrsregisteredrecert.hourRegistered) as totHRS FROM hrsregisteredrecert
                INNER JOIN trainers on trainers.idTrainer = hrsregisteredrecert.idTrainer 
                INNER JOIN certsq on hrsregisteredrecert.idCertification = certsq.idCertification 
                INNER JOIN area ON area.idArea = certsq.idArea 
                WHERE CAST(fechaRegist AS DATE) BETWEEN '.'"'.$date_1.'"'.'AND '.'"'.$date_2.'"'.'
                GROUP BY area.idArea';

                  
                  $result = $db->query($result);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                       $productname[]  = $row['nombreArea']  ;
                       $sales[] = $row['totHRS'];}
                   }
                

                      
        }
        elseif ($typeV == 2) {
                if ($typeG == 1) {
                    $query = 'SELECT CAST(lastUp AS DATE), recertsq.idTrainer, trainers.nameTrainer, SUM(recertsq.status) as status
                     FROM recertsq
                     INNER JOIN trainers on trainers.idTrainer = recertsq.idTrainer
                     WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                     AND recertsq.status = 1 and recertsq.active = 1
                     GROUP BY recertsq.idTrainer';
     
                     $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                         $productname[]  = $row['nameTrainer']  ;
                         $sales[] = $row['status'];}
     
            } elseif ($typeG == 2) {
                $query = 'SELECT CAST(lastUp AS DATE), recertsq.idTrainer, turno.idTurno, turno.nameTurno , SUM(recertsq.status) as status
                FROM recertsq
                INNER JOIN trainers on trainers.idTrainer = recertsq.idTrainer
                INNER JOIN turno on trainers.idTurno = turno.idTurno
                WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                AND recertsq.status = 1 and recertsq.active = 1 
                GROUP BY turno.idTurno';

               $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                    $productname[]  = $row['nameTurno']  ;
                    $sales[] = $row['status'];}
            }
             elseif ($typeG == 3) {
                $query = 'SELECT CAST(lastUp AS DATE), recertsq.idTrainer, area.idArea, area.nombreArea , SUM(recertsq.status) as status
                FROM recertsq
                INNER JOIN trainers on trainers.idTrainer = recertsq.idTrainer
                INNER JOIN area on area.idArea = recertsq.idArea
                WHERE CAST(lastUp AS DATE) BETWEEN '.'"'.$date_1.'"'.'  AND '.'"'.$date_2.'"'.' 
                AND recertsq.status = 1 and recertsq.active = 1
                GROUP BY recertsq.idArea';

                $result = $db->query($query);
             $chart_data= "";
             while ($row = $result ->fetch_array()) { 
                    $productname[]  = $row['nombreArea']  ;
                    $sales[] = $row['status'];
                }
            }        
        }
    
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

     <link rel="stylesheet" href="js/Chart.min.js">  
</head>

<body>

  <div class="d-flex" id="wrapper">

  <?php include "Admin_Template.php"; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-secondary" id="menu-toggle">GRAFICAS</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
            <?php 
                
    date_default_timezone_set('America/Chihuahua');
    $date = date('Y-m-d');

    echo '<form action="" method="post">';
    echo '<button type="button" class="btn btn-primary"
        data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fas fa-chart-bar"></i>            Nueva Grafica</i>  
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Selecciona</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="form-group container">
        <div class="row">
        <div class="col-md-3"></div>
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="">Initial Date</span>
        </div>
        <input type="date" name="date_1" id="trainer" class="form-control" value="'.$date.'">
        </div>
        <div class="formcontrol col-md-3"></div>
        </div>
        <div class="row">
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="">Final Date</span>
        </div>
        <input type="date" name="date_2" id="email" class="form-control" value="'.$date.'">
        </div>  
        <div class="formcontrol col-md-3"></div>
        </div>
        <br><br>
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="">TIPO DE SEGUIMIENTO</span>
        </div>
        <select required class="form-control col-sm-6" name="typeC" id="typeC">
        <option value="1">CERTIFICACIONES</option>
        <option value="2">RECERTIFICACIONES</option>
        </select>
        </div>
        <br><br>
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="">TIPO DE VISUALIZACION</span>
        </div>
        <select required class="form-control col-sm-6" name="typeV" id="typeV">
        <option value="1">HORAS VUELO</option>
        <option value="2">NO. CERTIFICACIONES</option>
        </select>
        </div>
        <br> <br>      
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="">GRAFICAR POR </span>
        </div>
        <select required class="form-control col-sm-6" name="typeG" id="typeG">
        <option value="1">ENTRENADOR</option>
        <option value="2">TURNO</option>
        <option value="3">AREA</option>
        </select>
        </div>
        <div class="formcontrol col-md-3"></div>
        </div>
        <br><br>         
                <div class="col-sm-3"></div>    
                <button class="col-sm-6 btn btn-dark" formaction="Show_Graph.php" name="Graph" type="submit">Guardar datos</button>
                </div>
        </div>
        </div>
        </form>';

            ?>
            </li>
            <li class="nav-item">
             
            </li>
            <li class="nav-item dropdown">
             
            </li>
          </ul>
        </div>
      </nav>

      

<?php
        
           
      echo  '<div style="width:100%;hieght:100%;text-align:center">
            <?php echo "HO HO HO LA CHAVALES"; ?>
            <h5 class="page-header">'.$date_1.'/'.$date_2.'</h5>
            <div> </div>
            <canvas  id="chartjs_bar"></canvas> 
            </div>   ';
        

?>
 
           
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
var ctx = document.getElementById("chartjs_bar").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels:<?php echo json_encode($productname); ?>,
                datasets: [{
                    backgroundColor: [
                        "#000000",
                        "#E53914",
                        "#FF0000",
                        "#00FF00",
                        "#0000FF",
                        "#FFFF00",
                        "#00FFFF",
                        "#FF00FF",
                        "#FF0000",
                        "#ff0000",
                        "#ff8000",
                        "#ffff00",
                        "#80ff00",
                        "#00ff80",
                        "#00ffbf",
                        "#00bfff",
                        "#0040ff",
                        "#8000ff",
                        "#ff00ff",
                        "#ff0080",
                        "#ff0000",
                        "#ffe6e6",
                        "#ff8080",
                    ],
                    data:<?php echo json_encode($sales); ?>,
                }]
            },
            options: {
             
                legend: {
                display: "false",
                position: '',
                labels: {
                    fontColor: '#FF0000"',
                    fontFamily: 'Circular Std Book',
                    fontSize: 10,

                }
                
            },

                   scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    stepSize: 50

                }    
                }],
                 xAxes: [{
                ticks: {
                   display: false 
                }    
                }]
            }  
        }
        });
</script>
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

</body>

</html>
