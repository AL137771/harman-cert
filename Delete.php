<?php
session_start();
include 'DB_CONN.php';


if (isset($_POST['Delete_Test'])) {

   $idTest = $_POST['idTest'];
  
   $query1 = 'DELETE FROM test WHERE idTest ='.'"'.$idTest.'"';
   $consulta  = $db-> query($query1);
  
   $query2 = 'DELETE FROM questionxtest WHERE idTest ='.'"'.$idTest.'"';
   $consulta  = $db-> query($query2);

  /* $query3 = 'DELETE answer
   FROM answer
   INNER JOIN questions ON questions.idQuestion = answer.idQuestion
   INNER JOIN test ON test.idTest = questions.idTest 
   WHERE test.idTest ='.$idTest; */
   
   if ($db-> query($query3)) {
      echo "EL QUERY SE HA HECHO EXITOSAMENTE";
   } else {
      echo $db->error;
   }
   
 header("Location: Visualize_Test.php");


}

if (isset($_POST['Bin_Certification'])) {

    $idCertification = $_POST['idCertification'];
    $query1 = 'UPDATE certsq SET certsq.active = 0 WHERE certsq.idCertification ='.'"'.$idCertification.'"';
    $consulta  = $db-> query($query1);
   
  
   $consulta2  = $db-> query($query1);

    header("Location: Admin_MainPage.php");
 

}

if (isset($_POST['Restore_Certification'])) {

   $idCertification = $_POST['idCertification'];
   $query1 = 'UPDATE certsq SET certsq.active = 1 WHERE certsq.idCertification ='.'"'.$idCertification.'"';

   $consulta  = $db-> query($query1);

  $consulta2  = $db-> query($query1);

   header("Location: Recycle_Bin.php");

}

if (isset($_POST['Delete_Certification'])) {

   $idCertification = $_POST['idCertification'];
  
   $query1 = 'DELETE FROM certsq WHERE idCertification = "'.$idCertification.'"';
   $consulta  = $db-> query($query1);
  
  $query1 = 'DELETE FROM hrsregistered WHERE idCertification = "'. $idCertification.'"';
  $consulta2  = $db-> query($query1);

   header("Location: Recycle_Bin.php");

}


if (isset($_POST['Bin_Recertification'])) {

   $idCertification = $_POST['idCertification'];
   $query1 = 'UPDATE recertsq SET recertsq.active = 0 WHERE recertsq.idCertification ='.'"'.$idCertification.'"';
   $consulta  = $db-> query($query1);
  
 
  $consulta2  = $db-> query($query1);

   header("Location: Admin_RecertPage.php");


}



if (isset($_POST['Restore_Recertification'])) {

   $idCertification = $_POST['idCertification'];
   $query1 = 'UPDATE recertsq SET recertsq.active = 1 WHERE recertsq.idCertification ='.'"'.$idCertification.'"';

   $consulta  = $db-> query($query1);

  $consulta2  = $db-> query($query1);

   header("Location: Recycle_Bin_Recesrt.php");

}
if (isset($_POST['Delete_Recertification'])) {

   $idCertification = $_POST['idCertification'];
 
   $query1 = 'DELETE FROM recertsq WHERE idCertification = "'.$idCertification.'"';
   $consulta  = $db-> query($query1);
  
   $query1 = 'DELETE FROM hrsregisteredrecert WHERE idCertification = "'. $idCertification.'"';
  $consulta2  = $db-> query($query1);

   header("Location: Recycle_Bin_Recert.php");


}



if (isset($_POST['Delete_Op_From_Area'])) {
      echo "El id del Area es".$_POST['idArea'];
      $_SESSION['idArea'] = $_POST['idArea'];
      $idRegist = $_POST['idRegist'];
      $query1 = 'DELETE FROM alloperations WHERE idRegist = '.$idRegist;
      $consulta  = $db-> query($query1);

    header("Location: Watch_Op_From_Area.php");
}

if (isset($_POST['Delete_Area_From_Trainer'])) {
   
   $_SESSION['idTrainer'] = $_POST['idTrainer'];
   $idRegArea = $_POST['idRegArea'];
  $query1 = 'DELETE FROM areaxtrainer WHERE idRegArea = '. $idRegArea;
$consulta  = $db-> query($query1);

   header("Location: Watch_Areas_From_Trainer.php");
}


if (isset($_POST['Delete_Trainer'])) {

   echo  $userId = $_POST['userId'];
   echo '<br>';
   echo $idTrainer =  $_POST['idTrainer'];

   $query1 = "DELETE FROM trainers WHERE idTrainer = ".$idTrainer;
   $consulta  = $db-> query($query1);

   $query1 = "DELETE FROM areaxtrainer WHERE idTrainer = ".$idTrainer;
   $consulta2  = $db-> query($query1);

   $query1 = "DELETE FROM users WHERE userId = ".$userId;
   $consulta3  = $db-> query($query1);

   
    header("Location: Visualize_Trainers.php");
 } 


 if (isset($_POST['Delete_Admin'])) {

   $userId = $_POST['userId'];

  $query1 = "DELETE FROM admin WHERE userId = ".$userId;
  $consulta  = $db-> query($query1);

  $query1 = "DELETE FROM users WHERE userId = ".$userId;
  $consulta3  = $db-> query($query1);

  
   header("Location: Visualize_Admins.php");
} 



 if (isset($_POST['Delete_Area'])) {

    $idArea = $_POST['idArea'];
   $query1 = "DELETE FROM area WHERE idArea = ". $idArea;
   $consulta  = $db-> query($query1);

   $query1 = "DELETE FROM alloperations WHERE idArea = ". $idArea;
   $consulta2  = $db-> query($query1);

    header("Location: Visualize_Areas.php");
 } 


 if (isset($_POST['Delete_Operation'])) {

    $idOperacion = $_POST['idOperacion'];

   $query1 = "DELETE FROM operacion WHERE idOperacion = ". $idOperacion;
   $consulta  = $db-> query($query1);



    header("Location: Visualize_Operations.php");
 } 


 if (isset($_POST['Delete_Question_From_Test'])) {
   
   $idTest = $_POST['idTest'];
   $_SESSION['idTest'] =  $_POST['idTest'];
   $idQuestion = $_POST['idQuestion'];

  $query1 = "DELETE FROM questionxtest WHERE idQuestion = ". $idQuestion;
  $consulta  = $db-> query($query1);
  

 /* $query2 = "DELETE FROM answer WHERE idQuestion = ". $idQuestion;
  $consulta  = $db-> query($query2); */


   header("Location: Watch_Questions_From_Test.php");
} 


if (isset($_POST['Delete_Cert_SP'])) {

   $idCertification =  $_POST['idCertification'];

   $query = "SELECT idTestTaken from esptesttaken WHERE esptesttaken.idCertification = ".$idCertification;
   $j = $db->query($query);

   
   $row = $j ->fetch_assoc();

   $row['idTestTaken'];

   $query = 'DELETE FROM espanswerstest  WHERE idTestTaken ="'.$row['idTestTaken'].'"';
   ///$consulta  = $db-> query($query2);

   if ($consulta  = $db-> query($query) === TRUE) {
      echo "";
  } else {
      echo "Error 1: " . $sq . "<br>" . $db->error;
  }
   

   $query = "DELETE FROM sp_recert WHERE sp_recert.idCertification =".$idCertification ;
   ///$consulta  = $db-> query($query);

   
   if ($consulta  = $db-> query($query) === TRUE) {
      echo "";
  } else {
      echo "Error 2: " . $sq . "<br>" . $db->error;
  }
   $query = "DELETE FROM esptesttaken WHERE esptesttaken.idCertification =".$idCertification ;
   ////$consulta  = $db-> query($query);

   if ($consulta  = $db-> query($query) === TRUE) {
      echo "";
  } else {
      echo "Error 3: " . $sq . "<br>" . $db->error;
  }

   
   header("Location: Admin_SP_Page.php");




} 


?>




