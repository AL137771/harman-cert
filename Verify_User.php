<?php
session_start();
include 'DB_CONN.php';


$usuario = $_POST['usuario'] ;
  $password = $_POST['password'];



$sql = " SELECT * FROM users 
      WHERE  users.userName ='$usuario' AND users.password ='$password'" ;

$resultado = $db -> query($sql);

$row = mysqli_fetch_assoc($resultado);


if ($row['idTypeUser'] == 1) {
  
  $consulta = " SELECT *
                FROM users 
                INNER JOIN trainers ON trainers.userId = users.userId
                WHERE  users.userName ='$usuario' AND users.password ='$password'" ;

  $resultado = $db -> query($consulta);

    if ($row = mysqli_fetch_assoc($resultado)) {

        $_SESSION['usuarios'] = $usuario;
        $_SESSION['id'] = $row['idTrainer'] ;
        $_SESSION['name'] = $row['nameTrainer'];

        $_SESSION['typeUser'] = $row['idTypeUser'];
  header("Location: Trainer_MainPage.php");
}  
}else if ($row['idTypeUser'] == 2) {
  
$consulta = "SELECT *
              FROM users 
            INNER JOIN admin ON users.userId = admin.userId 
            WHERE  users.userName ='$usuario' AND users.password = '$password'" ;
    $resultado = $db -> query($consulta);


    if ($row = mysqli_fetch_assoc($resultado)) {
    $_SESSION['nameAdmin'] = $row['nameAdmin'];
    $_SESSION['typeUser'] = $row['idTypeUser'];
  header("Location: Admin_MainPage.php");
    }
}
else {
      header("Location: index.php");
}





 ?>
