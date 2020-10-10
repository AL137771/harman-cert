<?php 
// Include the database config file 
include_once 'DB_CONN.php'; 
 
if(!empty($_POST["idEmpleado"])){ 
    $query = "SELECT empleados.idEmpleado, empleados.nameEmpleado from empleados
    WHERE empleados.idEmpleado = ".$_POST["idEmpleado"]; 
    
    $result = $db->query($query); 
    if($result->num_rows > 0){  
        echo '<option value="">SELECCIONA NOMBRE EMPLEADO</option>';
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['nameEmpleado'].'">'.$row['nameEmpleado'].'</option>'; 
        } 
     }
 else {
    echo '<option value=" ">Opcion no disponible</option>';
}
}



?>