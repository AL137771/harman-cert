<?php
session_start();
include "DB_CONN.php";


if (isset($_POST['Create_Emp'])) {
    $trainer = $_SESSION['id'];
    $area = $_POST['area'];
    $operacion = $_POST['operacion'];
    $complejidad = $_POST['complejidad'];
    $idEmpleado = $_POST['idEmpleado'];
    $nameEmpleado = $_POST['nameEmpleado'];
    
    $datecheck = date('Y-m-d',strtotime($date));

    $query = 'SELECT * FROM checklist  
                INNER JOIN checklist_dates ON checklist.idCheck = checklist_dates.idCheck
                WHERE 
                checklist.idOperacion = '.$operacion.'
                AND checklist.idEmpleado ='.$idEmpleado.'
                AND CAST(checklist_dates.dateRegistro AS DATE) ='.'"'.$datecheck.'"';

    $db->query($query) ;

if (mysqli_num_rows($db->query($query))) {
           
  $_SESSION['checklist_restriction'] = "La persona que estas tratando de crear ya ha sido creada en el checklist el dia de hoy";
    header("Location: Create_Emp_For_Checklist.php");
} else {

  $query = 'SELECT * FROM checklist  
  INNER JOIN checklist_dates ON checklist.idCheck = checklist_dates.idCheck
  WHERE 
  checklist.idOperacion = '.$operacion.'
  AND checklist.idEmpleado ='.$idEmpleado;
  
  if (mysqli_num_rows($db->query($query))) {

$query = 'SELECT idCheck FROM checklist
          WHERE 
              checklist.idOperacion = '.$operacion.'
              AND checklist.idEmpleado ='.$idEmpleado;
          $i = $db->query($query);
          $j = $i->fetch_assoc();

              $id = $j["idCheck"];
              $sql2 = "INSERT INTO checklist_dates  (idCheck, idTrainer,  idArea, dateRegistro) 
                  VALUES ('$id', '$trainer', '$area','$date')";
              
              if ($db->query($sql2) === TRUE) {
              $_SESSION['checklist_success'] = "EMPLEADO YA ESTABA EN ESTA OPERACION, FECHA REGISTRADO";
              header("Location: Create_Emp_For_Checklist.php");
              } else {
              echo $db->error;
              }
  } else {

    $sql = "INSERT INTO checklist  (idOperacion, idComplejidad, idEmpleado, nameEmpleado)
VALUES ('$operacion', '$complejidad', '$idEmpleado', '$nameEmpleado')";

  if ($db->query($sql) === TRUE) {
   
    $query = 'SELECT idCheck FROM checklist
    WHERE 
        checklist.idOperacion = '.$operacion.'
        AND checklist.idEmpleado ='.$idEmpleado;
    $i = $db->query($query);
    $j = $i->fetch_assoc();

        $id = $j["idCheck"];
        $sql2 = "INSERT INTO checklist_dates  (idCheck, idTrainer,  idArea, dateRegistro) 
            VALUES ('$id', '$trainer', '$area', '$date')";
        if ($db->query($sql2) === TRUE) {
        $_SESSION['checklist_success'] = "EMPLEADO NO ESTABA REGISTRADO ANTES, CREADO REGISTRO Y FECHA";
        header("Location: Create_Emp_For_Checklist.php");
        } else {
        echo $db->error;
        }
              }
}



}

}






?>