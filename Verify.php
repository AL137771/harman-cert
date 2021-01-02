<?php
include 'DB_CONN.php';
session_start();



if (isset($_POST['Add_Hours_Certification'])) {
        
    $num = $_POST['num'] ; /// VERIFICA POST
    $idEmpleado = $_POST['idEmpleado'];
    $idCertification = $_POST['idCertification'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $fechaIngreso = $_POST['fechaIngreso']; 
    $lastUp = $_POST['lastUp'];
    $idTrainer = $_POST['idTrainer'];
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
      header("Location: Trainer_MainPage.php");
            
        } else {
           
            $query = 'Select idHourReg,  idEmpleado, fechaRegist, time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 as timeRemain
                        FROM hrsregistered
                        WHERE idEmpleado = '.$idEmpleado.' AND time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 < 1 
                        ORDER BY idHourReg DESC LIMIT 1';

                            
                if (mysqli_num_rows($result = $db->query($query))) {                  
                    $row = $result -> fetch_assoc() ;  
                      if ($row['timeRemain'] < 1) {
                        $_SESSION['empRestriction'] = "No puedes agregar horas en diferentes operaciones a un mismo empleado";
                        header("Location: Trainer_MainPage.php");
                      } 

                }
                 else {
                
               
          

            if (!empty($fechaCreacion)) {
                if (!empty($lastUp)) {
                    $query = 'INSERT INTO hrsregistered (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num.'")';
                    $db->query($query);

                    $_SESSION['done'] = "Se han agregado ". $num . " horas a la certificacion #".$idCertification; 

                } else {
                    $query = 'INSERT INTO hrsregistered (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num.'")';
                    $db->query($query);
                    $_SESSION['done'] = "Se han agregado ". $num . " horas a la certificacion #".$idCertification; 
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

          header("Location: Trainer_MainPage.php");

        } else {
            $final = 'UPDATE certsq SET 
            status  = 1  
            WHERE idCertification ='.$idCertification;
            $result4 = $db->query($final);    
        }

     
        if ($conteo['total'] == 34) {
         
        header("Location: Trainer_MainPage.php");     
                         }
    
                }
    }
   
}


if (isset($_POST['Add_Hours_Recertification'])) {
        
        $num2 = $_POST['num2'] ; /// VERIFICA POST
        $idTrainer = $_POST['idTrainer'];
        $idEmpleado = $_POST['idEmpleado'];
        $idCertification = $_POST['idCertification'];
    
        $fechaCreacion = $_POST['fechaCreacion'];
        $fechaIngreso = $_POST['fechaIngreso'];
        $lastUp = $_POST['lastUp'];
        $idTrainer = $_POST['idTrainer'];


            
        $onlyDate = date("H:i:s",strtotime($fechaIngreso));
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
            header("Location: Trainer_RecertPage.php");
            
        } else {
    

            $query = 'Select idHourReg,  idEmpleado, fechaRegist, time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 as timeRemain
            FROM hrsregisteredrecert
            WHERE idEmpleado = '.$idEmpleado.' AND time_to_sec(timediff("'.$date.'", fechaRegist)) / 3600 < 1 
            ORDER BY idHourReg DESC LIMIT 1';

                
    if (mysqli_num_rows($result = $db->query($query))) {                  
        $row = $result -> fetch_assoc() ;  
          if ($row['timeRemain'] < 1) {
            $_SESSION['empRestriction'] = "No puedes agregar horas en diferentes operaciones a un mismo empleado";
            header("Location: Trainer_RecertPage.php");
          } 

    } 
     else {

            
            if (!empty($fechaCreacion)) {
                if (!empty($lastUp)) {
                    $query = 'INSERT INTO hrsregisteredrecert (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num2.'")';
                    $db->query($query);

                    $_SESSION['done'] = "Se han agregado ". $num2 . " horas a la certificacion #".$idCertification; 

                } else {
                    $query = 'INSERT INTO hrsregisteredrecert (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num2.'")';
                    $db->query($query);
                    $_SESSION['done'] = "Se han agregado ". $num2 . " horas a la certificacion #".$idCertification; 
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
       
        header("Location: Trainer_RecertPage.php");     
    }
    else {
       header("Location: Add_Hours.php") ;
     }


    }
   
}

}


if (isset($_GET['delete_ope'])) {

        $cert = $_GET['delete_ope'];
    
       $query1 = 'DELETE FROM area WHERE idArea = '.$cert;
       $db-> query($query1);
       $query =  'DELETE FROM alloperations WHERE idArea ='.$cert;
       $db-> query($query);
        header("Location: ver_operacion.php");
 
    
    }
  
    
    
    
    if (isset($_GET['delete_area'])) {

        $cert = $_GET['delete_area'];
    
       $query1 = "DELETE FROM areaxtrainer WHERE idRegArea = ". $cert;
       $consulta  = $db-> query($query1);

      
    header("Location: ver_area.php");
    }



    
if (isset($_POST['Admin_Add_Hours_Certification'])) {
        
    $num = $_POST['num'] ; /// VERIFICA POST
    $idEmpleado = $_POST['idEmpleado'];
    $idCertification = $_POST['idCertification'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $fechaIngreso = $_POST['fechaIngreso']; 
    $lastUp = $_POST['lastUp'];
    $idTrainer = $_POST['idTrainer'];
    $timestamp1 = strtotime($lastUp);
        
      
        $query = 'INSERT INTO hrsregistered (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
        VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num.'")';
        $db->query($query);

        $_SESSION['done_a'] = "Se han agregado ". $num . " horas a la certificacion #".$idCertification; 

               
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
        } 

        $query2 = 'SELECT progress FROM certsq where idCertification ='.$idCertification;
        $result2 = $db -> query($query2);
            $row2 = $result2 -> fetch_assoc() ;

        if ($row2['progress'] > 150) {
            $final = 'UPDATE certsq SET 
            progress  = 150 
            WHERE idCertification ='.$idCertification;
            $result4 = $db->query($final);  
        }
                    
          header("Location: Admin_MainPage.php");

       

     
    
    
   
}



if (isset($_POST['Admin_Add_Hours_Recertification'])) {
        
    $num2 = $_POST['num2'] ; /// VERIFICA POST
    $idEmpleado = $_POST['idEmpleado'];
    $idCertification = $_POST['idCertification'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $fechaIngreso = $_POST['fechaIngreso']; 
    $lastUp = $_POST['lastUp'];
    $idTrainer = $_POST['idTrainer'];
    $timestamp1 = strtotime($lastUp);
        
      
                    $query = 'INSERT INTO hrsregisteredrecert (idCertification, idTrainer, idEmpleado, fechaRegist, hourRegistered)
                    VALUES ("'.$idCertification.'", "'.$idTrainer.'","'.$idEmpleado.'","'.$date.'", "'.$num2.'")';
                    $db->query($query);

                    $_SESSION['done_a'] = "Se han agregado ". $num2 . " horas a la certificacion #".$idCertification; 

               
        $query = 'SELECT progress FROM recertsq where idCertification ='.$idCertification;
        $result = $db -> query($query);                 ////////////////OBTENER VALOR AGREGADO
    
        $row = $result -> fetch_assoc() ;    ////// CONVERTIR RES DEL QUERY EN ARRAY
    
    
        $query2 = 'SELECT hrsregisteredrecert.idCertification, SUM(hrsregisteredrecert.hourRegistered) as total
                    FROM hrsregisteredrecert 
                    WHERE hrsregisteredrecert.idCertification ='.$idCertification; 
          $result2 = $db -> query($query2);       
        $conteo = $result2 -> fetch_assoc() ; 
        

        $query2 = 'UPDATE recertsq SET 
        progress    = '.$conteo['total'].'
        WHERE idCertification ='.$idCertification; ////  EL RESULTADO DEL QUERY
        $result2 = $db -> query($query2);



        $query2 = 'SELECT progress FROM recertsq where idCertification ='.$idCertification;
        $result2 = $db -> query($query2);
        
        $row2 = $result2 -> fetch_assoc() ;  

       if ($row2['progress'] < 37.5) {
            
            
            $final = 'UPDATE recertsq SET 
            lastUp  ='.'"'.$fechaIngreso.'"'.' 
            WHERE idCertification ='.$idCertification;
            $result4 = $db->query($final);     

          header("Location: Admin_RecertPage.php");

        }

     
    
    
   
}6

?>