
<?php 
// Include the database config file 
include_once 'DB_CONN.php'; 
 

 if(!empty($_POST["idArea"])){ 
                $query = "SELECT DISTINCT alloperations.idArea, area.nombreArea, alloperations.idOperacion, operacion.nOperacion
                FROM alloperations
                INNER JOIN operacion ON operacion.idOperacion = alloperations.idOperacion
                INNER JOIN area ON area.idArea = alloperations.idArea
                WHERE area.idArea = ".$_POST["idArea"]; 

                $result = $db->query($query); 
            if($result->num_rows > 0){ 
            echo '<option value="">SELECCIONA OPERACION</option>'; 
            while($row = $result->fetch_assoc()){  
                echo '<option value="'.$row["idOperacion"].'">'.$row["nOperacion"].'</option>'; 
            }   
            } else{ 
                echo '<option value="">Operacion no disponible</option>'; 
            } 
            } elseif(!empty($_POST["idOperacion"])){ 
                $query = "SELECT DISTINCT alloperations.idOperacion, operacion.nOperacion, operacion.idComplejidad, complejidad.tipoComplejidad 
                FROM alloperations 
                INNER JOIN operacion ON operacion.idOperacion = alloperations.idOperacion 
                INNER JOIN complejidad ON complejidad.idComplejidad = operacion.idComplejidad 
                WHERE operacion.idOperacion = ".$_POST["idOperacion"]; 
                
                $result = $db->query($query); 
                if($result->num_rows > 0){ 
                    echo '<option value="">SELECCIONA COMPLEJIDAD</option>'; 
                    while($row = $result->fetch_assoc()){  
                        echo '<option value="'.$row["idComplejidad"].'">'.$row["tipoComplejidad"].'</option>'; 
                    } 
                } else{ 
                    echo '<option value="">Complejidad no disponible</option>'; 
                } 
            }


?>