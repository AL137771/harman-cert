<?php
include 'DB_CONN.php';


if (isset($_POST["import"])) {
    
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          
     //     $sqlInsert = "INSERT into empleados (idEmpleado,nameEmpleado,Puesto,Turno)
                  // values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
            
            $query =  'INSERT INTO empleados (idEmpleado , nameEmpleado , Puesto , Turno)
                        SELECT * FROM ('.$column[0].',"'.$column[1].'","'.$column[2].'","'.$column[3].'") 
                        WHERE NOT EXISTS ( SELECT * FROM empleados )';

            $resultado = $db -> query($query);
            
            if ($resultado = $db -> query($query) === TRUE) {
                echo "Registro Completo";
             header("Location: Admin_MainPage.php");
            } else {
                echo "Error". $db ->error;
                echo "<br>";
                echo "<br>";
            }
        }
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>
</head>
<body>

<div class='container'>

<div class='jumbotron'>

<form class="form-horizontal" action="" method="post" name="uploadCSV" enctype="multipart/form-data">
    <div class="input-row">
    <label for="escogerCSV">Escoge archivo CSV</label>
        
        <input  type="file" name="file" id="file" accept=".csv">
        
        <button type="submit" class="btn btn-primary" id="submit" name="import"
            class="btn-submit">Import</button>
        <br />
        <br><br>
        <div class='row'>
              
                <a href="admin.php"  class="col-sm-3 btn btn-secondary btn-sm" role="button" aria-disabled="true">Volver</a>
                </div>
                    
    </div>
    <div id="labelError"></div>
</form>
</div>

</div>
</body>
</html>