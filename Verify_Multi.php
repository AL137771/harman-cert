<?php 
include 'DB_CONN.php';
session_start();

if (isset($_POST['data_sent'])) {

    $data = $_POST['data'];
   $num = $_POST['num'];
    foreach ($data as $datas){ 
        
        $query = 'SELECT * FROM certsq
          WHERE certsq.idCertification ='.$datas;
          
          $query = $db->query($query);

          $row = $query->fetch_assoc();

          $num = $_POST['num'];
          $idEmpleado = $row['idEmpleado'];
          $idCertification = $row['idCertification'];
          $fechaCreacion = $row['fechaCreacion'];
          $fechaIngreso = $date; 
          $lastUp = $row['lastUp'];
          $idTrainer = $row['idTrainer'];
          $timestamp1 = strtotime($lastUp);


          $query = 'SELECT certsq.idTrainer, trainers.nameTrainer, turno.idTurno, turno.nameTurno,  turno.start, turno.end 
		from certsq
        INNER JOIN trainers ON trainers.idTrainer = certsq.idTrainer
        INNER JOIN turno ON turno.idTurno = trainers.idTurno
        WHERE certsq.idCertification ='.$idCertification;
         $result = $db ->query($query);
        $row = $result -> fetch_assoc() ;  
        
        if ($row['idTurno'] == 3) {
            $date1st = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date) ) ));

        } else {
            $date1st = date('Y-m-d',strtotime($date));
        }
        
      
        $hrFirst = $row['start'];
        $combinedDate = date('Y-m-d H:i:s', strtotime("$date1st $hrFirst"));  
         $lastUp ; 


    if (!empty($fechaCreacion)) {
        if (!empty($lastUp)) {
            if ($lastUp < $combinedDate) {
                $lastUp = $combinedDate;
              
                   
                     $timestamp1 = strtotime($lastUp);  
                     $timestamp2 = strtotime($fechaIngreso); 
              $time = abs(($timestamp2 - $timestamp1)/(60*60));
       
               
               
       
            } else {
            
                $timestamp1 = strtotime($lastUp); 
                $timestamp2 = strtotime($fechaIngreso);  
                $time = abs(($timestamp2 - $timestamp1)/(60*60)); 
            }
            
        } else {
          
            if ($fechaCreacion < $combinedDate) {
                $fechaCreacion = $combinedDate;
            
                   $timestamp1 = strtotime($fechaCreacion); 
                   $timestamp2 = strtotime($fechaIngreso); 
                  $time = abs(($timestamp2 - $timestamp1)/(60*60));
            } else {
           
                $timestamp1 = strtotime($fechaCreacion); 
                $timestamp2 = strtotime($fechaIngreso); 
                $time = abs(($timestamp2 - $timestamp1)/(60*60));  
          
            }
           
        }
    }


        if ($time < $num) { 
        $_SESSION['errorMessage'] = "Aun no puedes agregar horas a esta certificacion";
      header("Location: Multi_Add_Cert.php");
            
        } else {
           
            $query = 'Select idHourReg,  idEmpleado, fechaRegist, time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 as timeRemain
                        FROM hrsregistered
                        WHERE idEmpleado = '.$idEmpleado.' AND time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 < 1 
                        ORDER BY idHourReg DESC LIMIT 1';

                            
                if (mysqli_num_rows($result = $db->query($query))) {                  
                    $row = $result -> fetch_assoc() ;  
                      if ($row['timeRemain'] < 1) {
                        $_SESSION['empRestriction'] = "No puedes agregar horas en diferentes operaciones a un mismo empleado";
                        header("Location: Multi_Add_Cert.php");
                      } 

                }
                 else {
                
               
          

            if (!empty($fechaCreacion)) {
                if (!empty($lastUp)) {
                    $query = 'INSERT INTO hrsregistered (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num.'")';
                    $db->query($query);
                    $_SESSION['done'] = $_SESSION['done'] .  "Se han agregado ". $num . " horas a la certificacion #".$idCertification.', '; 

                } else {
                    $query = 'INSERT INTO hrsregistered (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num.'")';
                    $db->query($query);
                    $_SESSION['done'] = $_SESSION['done'] . "Se han agregado ". $num . " horas a la certificacion #".$idCertification.', '; 
                }
            }

        

        $query = 'SELECT progress FROM certsq where idCertification ='.$idCertification;
        $result = $db -> query($query);                 ////////////////OBTENER VALOR AGREGADO
    
        $row = $result -> fetch_assoc() ;    ////// CONVERTIR RES DEL QUERY EN ARRAY
    
    
        $query2 = 'SELECT hrsregistered.idCertification, SUM(hrsregistered.hourRegistered) as total
                    FROM hrsregistered 
                    WHERE hrsregistered.idCertification ='.$idCertification; 
          $result2 = $db -> query($query2);       
        $conteo = $result2 -> fetch_assoc() ; 
        

        $query2 = 'UPDATE certsq SET 
        progress    = '.$conteo['total'].'
        WHERE idCertification ='.$idCertification; ////  EL RESULTADO DEL QUERY
        $result2 = $db -> query($query2);



        $query2 = 'SELECT progress FROM certsq where idCertification ='.$idCertification;
        $result2 = $db -> query($query2);
        
        $row2 = $result2 -> fetch_assoc() ;  

       if ($row2['progress'] < 150) {
            
            
            $final = 'UPDATE certsq SET 
            lastUp  ='.'"'.$fechaIngreso.'"'.' 
            WHERE idCertification ='.$idCertification;
            $result4 = $db->query($final);     

          header("Location: Multi_Add_Cert.php");

        } else {
            $final = 'UPDATE certsq SET 
            status  = 1  
            WHERE idCertification ='.$idCertification;
            $result4 = $db->query($final);    
        }

     
        if ($conteo['total'] == 34) {
         
        header("Location: Multi_Add_Cert.php");     
                         }
    
                }
    }
            
        }
      

}


if (isset($_POST['data_sent_re'])) {

    $data = $_POST['data'];
   $num2 = $_POST['num'];
    foreach ($data as $datas){ 
        
        $query = 'SELECT * FROM recertsq
          WHERE recertsq.idCertification ='.$datas;
          
          $query = $db->query($query);

          $row = $query->fetch_assoc();

          $num = $_POST['num'];
          $idEmpleado = $row['idEmpleado'];
          $idCertification = $row['idCertification'];
          $fechaCreacion = $row['fechaCreacion'];
          $fechaIngreso = $date; 
          $lastUp = $row['lastUp'];
          $idTrainer = $row['idTrainer'];
          $timestamp1 = strtotime($lastUp);


        
          $query = 'SELECT recertsq.idTrainer, trainers.nameTrainer, turno.idTurno, turno.start, turno.end 
          from recertsq
          INNER JOIN trainers ON trainers.idTrainer = recertsq.idTrainer
          INNER JOIN turno ON turno.idTurno = trainers.idTurno
          WHERE recertsq.idCertification ='.$idCertification;
           $result = $db ->query($query);
           $row = $result -> fetch_assoc() ;  
           
           if ($row['idTurno'] == 3) {
               $date1st = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date) ) ));
   
           } else {
               $date1st = date('Y-m-d',strtotime($date));
           }
           
         
           $hrFirst = $row['start'];
              $combinedDate = date('Y-m-d H:i:s', strtotime("$date1st $hrFirst"));  
               $lastUp ;
           
   
   
       if (!empty($fechaCreacion)) {
           if (!empty($lastUp)) {
               if ($lastUp < $combinedDate) {
                   $lastUp = $combinedDate;
                 
                      
                       $timestamp1 = strtotime($lastUp);  
                       $timestamp2 = strtotime($fechaIngreso); 
                 $time = abs(($timestamp2 - $timestamp1)/(60*60));
          
                  
                  
          
               } else {
               
                   $timestamp1 = strtotime($lastUp); 
                   $timestamp2 = strtotime($fechaIngreso);  
                   $time = abs(($timestamp2 - $timestamp1)/(60*60)); 
               }
               
           } else {
             
               if ($fechaCreacion < $combinedDate) {
                   $fechaCreacion = $combinedDate;
               
                      $timestamp1 = strtotime($fechaCreacion); 
                      $timestamp2 = strtotime($fechaIngreso); 
                     $time = abs(($timestamp2 - $timestamp1)/(60*60));
               } else {
              
                   $timestamp1 = strtotime($fechaCreacion); 
                   $timestamp2 = strtotime($fechaIngreso); 
                   $time = abs(($timestamp2 - $timestamp1)/(60*60));  
             
               }
              
           }
       }
          
          if ($time < $num2) {
             
      
              $_SESSION['errorMessage'] = "Aun no puedes agregar horas a esta certificacion";
              header("Location: Multi_Add_Recert.php");
              
          } else {
      
  
              $query = 'Select idHourReg,  idEmpleado, fechaRegist, time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 as timeRemain
              FROM hrsregisteredrecert
              WHERE idEmpleado = '.$idEmpleado.' AND time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 < 1 
              ORDER BY idHourReg DESC LIMIT 1';
  
                  
      if (mysqli_num_rows($result = $db->query($query))) {                  
          $row = $result -> fetch_assoc() ;  
            if ($row['timeRemain'] < 1) {
              $_SESSION['empRestriction'] = "No puedes agregar horas en diferentes operaciones a un mismo empleado";
              header("Location: Multi_Add_Recert.php");
            } 
  
      } 
       else {
  
              
              if (!empty($fechaCreacion)) {
                  if (!empty($lastUp)) {
                      $query = 'INSERT INTO hrsregisteredrecert (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                      VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num2.'")';
                      $db->query($query);
  
                      $_SESSION['done'] = $_SESSION['done'] . "Se han agregado ". $num2 . " horas a la certificacion #".$idCertification.', '; 
  
                  } else {
                      $query = 'INSERT INTO hrsregisteredrecert (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                      VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num2.'")';
                      $db->query($query);
                      $_SESSION['done'] = $_SESSION['done']. "Se han agregado ". $num2 . " horas a la certificacion #".$idCertification.', ';; 
                  }
              }
  
      $query = 'SELECT progress FROM recertsq where idCertification ='.$idCertification;
      $result = $db -> query($query);                 ////////////////OBTENER VALOR AGREGADO
  
      $row = $result -> fetch_assoc() ;    ////// CONVERTIR RES DEL QUERY EN ARRAY
  
      $valor = $row['progress'] + $num2 ;
  
      $query2 = 'UPDATE recertsq SET 
      progress    = '.$valor.'
      WHERE idCertification ='.$idCertification; ////  EL RESULTADO DEL QUERY
      $result2 = $db -> query($query2);
  
  
  
      $query2 = 'SELECT progress FROM recertsq where idCertification ='.$idCertification;
      $result2 = $db -> query($query2);
      
      $row2 = $result2 -> fetch_assoc() ;  
  
     if ($row2['progress'] < 37) {
          
          $final = 'UPDATE recertsq SET 
          lastUp  ='.'"'.$fechaIngreso.'"'.' 
          WHERE idCertification ='.$idCertification;
          $result4 = $db->query($final);       
      }
  
   
      if ($result2 OR $result3 OR $result4  === TRUE) {
         
          header("Location: Multi_Add_Recert.php");     
      }
      else {
         header("Location: Add_Hours.php") ;
       }
  
  
      }
     
  }
            
        }
      

}


?>