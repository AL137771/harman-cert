<?php
session_start();
include 'DB_CONN.php';

if (isset($_POST['Add_Answers'])) {
 $idCertification = $_POST['idCertification'];
 $nquestions = $_POST['nquestions'];
 $idTest = $_POST['idTest'];
 
  $questions =  array($_POST['question_1'], $_POST['question_2'],$_POST['question_3'] ,$_POST['question_4']
                      ,$question_5 = $_POST['question_5'],$_POST['question_6'], $_POST['question_7'],
                      $_POST['question_8'],$_POST['question_9'],$_POST['question_10'],$_POST['question_11']
                      ,$_POST['question_12'],$_POST['question_13'],$_POST['question_14']);
  
 $answer = array($_POST['answer_1'], $_POST['answer_2'], $_POST['answer_3'],$_POST['answer_4'], $_POST['answer_5'],
                  $_POST['answer_6'], $_POST['answer_7'], $_POST['answer_8'], $_POST['answer_9'], $_POST['answer_10'],
                  $_POST['answer_11'],
                  $_POST['answer_12'],
                  $_POST['answer_13'], 
                  $_POST['answer_14']); 

  if ($_POST['attempts'] == 0 ) {

    $query = 'INSERT INTO testtaken (idCertification, idTest,  date) 
                  VALUES ('.$idCertification.', '.$idTest.', "'.$date.'")';
                  if ($db -> query($query) === TRUE) {
                   echo "";
                  
                  } else {
                    echo "MAL.". $db->error;
                  }


         $query = 'SELECT * FROM testtaken WHERE idCertification ='.$idCertification ;
         $i = $db->query($query);
         
         $row = $i ->fetch_assoc();

              for ($i=0; $i < $nquestions; $i++) { 

                 $query = 'INSERT INTO answerstest (idTestTaken, idQuestion, idAnswer)
                        VALUES ("'.$row['idTestTaken'].' ", "'.$questions[$i].'", "'.$answer[$i].'")';
                          if ($db -> query($query) === TRUE) {
                            echo "";
                          
                          } else {
                            echo "MAL.". $db->error;
                          }
                 }

                 
      
        } else {

          $query = 'SELECT * FROM testtaken WHERE idCertification ='.$idCertification ;
          $i = $db->query($query);
          
          $row = $i ->fetch_assoc();


          for ($i=0; $i < $nquestions; $i++) { 
                  $query = 'UPDATE answerstest
                        SET idAnswer = "'.$answer[$i].'"
                        WHERE idTestTaken = '.$row['idTestTaken'].'
                        AND idQuestion ='.$questions[$i];


                  if ($db -> query($query) === TRUE) {
                    echo "";
                   
                   } else {
                     echo "MAL.". $db->error;
                   }
          }
        
        }

      

  

$query = 'SELECT testtaken.idTestTaken , SUM(answer.value) as total
          FROM answerstest
          INNER JOIN answer ON answer.idAnswer = answerstest.idAnswer
          INNER JOIN testtaken ON testtaken.idTestTaken = answerstest.idTestTaken
          WHERE testtaken.idCertification ='.$idCertification;
          
          $query = $db->query($query);

          $row = $query->fetch_assoc();

          $totalAciertos = $row['total'];
          $calificacionMaxima = 10;

          $regladetres = ($totalAciertos*$calificacionMaxima)/$nquestions;

            if ($regladetres >= 8 ) {
                $query = 'UPDATE certsq SET
                           calification = '.$regladetres.'
                           WHERE idCertification ='.$idCertification;
                            $db->query($query);


                 $query = 'UPDATE certsq SET
                        ap_1 = '.$regladetres.'
                           WHERE idCertification ='.$idCertification;
                            $db->query($query);
                            
                            $_SESSION['calif'] = $regladetres;
$_SESSION['win'] ="APROBADO, TU CALIFICACION FUE ".$_SESSION['calif'];
header("Location: Trainer_Cert_Complete.php");   
            }
            else {

                $query = 'UPDATE certsq SET
                calification = '.$regladetres.'
                WHERE idCertification ='.$idCertification;
                 $db->query($query);

                 $query = 'SELECT attempts FROM certsq where idCertification ='.$idCertification;
                 $i = $db->query($query);
                  $attempt = $i ->fetch_assoc();
                
                  if ($attempt['attempts'] == 0) {
                    $query = 'UPDATE certsq
                            SET attempts = 1 WHERE idCertification = "'.$idCertification.'"';
                             $db ->query($query);
                            $_SESSION['attempt'] = 1;

                  } elseif ($attempt['attempts'] == 1) {
                    $query = 'UPDATE certsq
                            SET attempts = 2 WHERE idCertification ='.$idCertification;
                             $db ->query($query);
                            $_SESSION['attempt'] = 2;

                  }  elseif ($attempt['attempts'] == 2) {

                    $query = 'UPDATE certsq
                    SET attempts = 3 WHERE idCertification ='.$idCertification;

                    if ( $db ->query($query) === TRUE) {
                      $query = 'UPDATE certsq
                      SET active = 0 WHERE idCertification ='.$idCertification;
                      $db ->query($query);
                      $_SESSION['attempt'] = 3;
                    }

                   

                 
                  }

             //  $query = 'DELETE FROM answeredTest WHERE idCertification ='.$idCertification;
                $db->query($query);
                $_SESSION['calif'] = $regladetres;
                $_SESSION['fail'] ="REPROBADO, TU CALIFICACION FUE ".$_SESSION['calif'].", llevas ".$_SESSION['attempt']." intentos";
                header("Location: Trainer_Cert_Complete.php");     
            
}
  
}




if (isset($_POST['Add_Answers_Re'])) {
    $idCertification = $_POST['idCertification'];
    $nquestions = $_POST['nquestions'];
    $idTest = $_POST['idTest'];
   
    $questions =  array($_POST['question_1'], $_POST['question_2'],$_POST['question_3'] ,$_POST['question_4']
    ,$question_5 = $_POST['question_5'],$_POST['question_6'], $_POST['question_7'],
    $_POST['question_8'],$_POST['question_9'],$_POST['question_10'],$_POST['question_11']
    ,$_POST['question_12'],$_POST['question_13'],$_POST['question_14']);
   
   $answer = array($_POST['answer_1'], $_POST['answer_2'], $_POST['answer_3'],$_POST['answer_4'], $_POST['answer_5'],
   $_POST['answer_6'], $_POST['answer_7'], $_POST['answer_8'], $_POST['answer_9'], $_POST['answer_10'],
   $_POST['answer_11'],
   $_POST['answer_12'],
   $_POST['answer_13'], 
   $_POST['answer_14']); 
     
                     if ($_POST['attempts'] == 0 ) {
   
                       $query = 'INSERT INTO retesttaken (idCertification, idTest,  date) 
                                     VALUES ('.$idCertification.', '.$idTest.', "'.$date.'")';
                                     if ($db -> query($query) === TRUE) {
                                      echo "";
                                     
                                     } else {
                                       echo "MAL.". $db->error;
                                     }
                   
                   
                            $query = 'SELECT * FROM retesttaken WHERE idCertification ='.$idCertification ;
                            $i = $db->query($query);
                            
                            $row = $i ->fetch_assoc();
                   
                                 for ($i=0; $i < $nquestions; $i++) { 
                   
                                    $query = 'INSERT INTO reanswerstest (idTestTaken, idQuestion, idAnswer)
                                           VALUES ("'.$row['idTestTaken'].' ", "'.$questions[$i].'", "'.$answer[$i].'")';
                                             if ($db -> query($query) === TRUE) {
                                               echo "";
                                             
                                             } else {
                                               echo "MAL.". $db->error;
                                             }
                                    }
                   
                                    
                         
                           } else {
                   
                             $query = 'SELECT * FROM retesttaken WHERE idCertification ='.$idCertification ;
                             $i = $db->query($query);
                             
                             $row = $i ->fetch_assoc();
                   
                   
                             for ($i=0; $i < $nquestions; $i++) { 
                                     $query = 'UPDATE reanswerstest
                                           SET idAnswer = "'.$answer[$i].'"
                                           WHERE idTestTaken = '.$row['idTestTaken'].'
                                           AND idQuestion ='.$questions[$i];
                   
                   
                                     if ($db -> query($query) === TRUE) {
                                       echo "JJAJAJAJAJAJA";
                                      
                                      } else {
                                        echo "MAL.". $db->error;
                                      }
                             }
                           
                           }
     
   $query = 'SELECT retesttaken.idTestTaken , SUM(answer.value) as total
   FROM reanswerstest
   INNER JOIN answer ON answer.idAnswer = reanswerstest.idAnswer
   INNER JOIN retesttaken ON retesttaken.idTestTaken = reanswerstest.idTestTaken
   WHERE retesttaken.idCertification ='.$idCertification;
   
   $query = $db->query($query);
   
   $row = $query->fetch_assoc();
   
   $totalAciertos = $row['total'];
   $calificacionMaxima = 10;
   
   $regladetres = ($totalAciertos*$calificacionMaxima)/$nquestions;
   
               if ($regladetres >= 8 ) {
                   $query = 'UPDATE recertsq SET
                              calification = '.$regladetres.'
                              WHERE idCertification ='.$idCertification;
                               $db->query($query);
   
   
                   $query = 'UPDATE recertsq SET
                           ap_1 = '.$regladetres.'
                              WHERE idCertification ='.$idCertification;
                               $db->query($query);
                               $_SESSION['calif'] = $regladetres;
                               $_SESSION['win'] ="APROBADO, TU CALIFICACION FUE ".$_SESSION['calif'];
                               header("Location: Trainer_Cert_Complete.php");   
                                
               }
               else {
   
                   $query = 'UPDATE recertsq SET
                   calification = '.$regladetres.'
                   WHERE idCertification ='.$idCertification;
                    $db->query($query);
   
                    $query = 'SELECT attempts FROM recertsq where idCertification ='.$idCertification;
                    $i = $db->query($query);
                     $attempt = $i ->fetch_assoc();
                   
                     if ($attempt['attempts'] == 0) {
                       $query = 'UPDATE recertsq
                               SET attempts = 1 WHERE idCertification = "'.$idCertification.'"';
                                $db ->query($query);
                               $_SESSION['attempt'] = 1;
   
                     } elseif ($attempt['attempts'] == 1) {
                       $query = 'UPDATE recertsq
                               SET attempts = 2 WHERE idCertification ='.$idCertification;
                                $db ->query($query);
                               $_SESSION['attempt'] = 2;
   
                     }  elseif ($attempt['attempts'] == 2) {
   
                       $query = 'UPDATE recertsq
                       SET attempts = 3 WHERE idCertification ='.$idCertification;
   
                       if ( $db ->query($query) === TRUE) {
                         $query = 'UPDATE recertsq
                         SET active = 0 WHERE idCertification ='.$idCertification;
                         $db ->query($query);
                         $_SESSION['attempt'] = 3;
                       }
   
                      
   
                    
                     }
   
                 /* $query = 'DELETE FROM answeredTest WHERE idCertification ='.$idCertification;
                   $db->query($query);*/
                   $_SESSION['calif'] = $regladetres;
                   $_SESSION['fail'] ="HAS REPROBADO, TU CALIFICACION FUE ".$_SESSION['calif'].", llevas ".$_SESSION['attempt']." intentos";
                   header("Location: Trainer_Recert_Complete.php");     
               
   }

   }
   



?>