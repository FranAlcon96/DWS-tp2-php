<!DOCTYPE html>
<html>
<head>
	<title>Tp2 en php</title>
	<meta charset="utf-8">
	<style type="text/css">
		.formulario{
			margin: 0 auto;
			width: 500px;
			height: auto;
			position: relative;
			text-align: center;
		}

		.formulario h1{
			font-size: 40px;
			color: blue;
		}	
	</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "fran";
$dbname = "tp2";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "La conexión a MySQL se ha realizado correctamente.";
if(!isset($_POST['nombre'])) { ?>
<div class="formulario">
<h1>Ordenadores Alcón PHP</h1>
<form method="POST">
	<label>Modelo:</label>
	<br>
	<input type="text" name="nombre">
	<br>
	<br>
	<label>Marca:</label>
	<br>	
	<input type="text" name="marca">
	<br>
	<br>
	<label>Precio:</label>
	<br>
	<input type="text" name="precio">
	<br>
	<br>
	<label>País:</label>
	<br>
	<input type="text" name="pais">
	<br>
	<br>
	<input type="submit" value="Enviar">
	<input type="reset" value="Borrar">
</form>
</div>
<?php

$sql = "SELECT nombre,marca,precio,pais FROM ordenadores";
$result = $conn->query($sql);

echo "<br>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<center>" . "Modelo: " . $row["nombre"]. " - Marca: " . $row["marca"]. " - Precio: " . $row["precio"]. "País: " . $row["pais"] ."</center> <br>";
        echo "<center>" . "------------------------------------------------------------------------------------------" ."</center> <br>";
    }
} else {
    echo "no hay resultados";
}

} else {
  $nombre = $_POST['nombre'];
  $marca = $_POST['marca'];
  $precio = $_POST['precio'];
  $pais = $_POST['pais'];

  $sql = "INSERT INTO ordenadores (nombre,marca,precio,pais)
  VALUES ('$nombre', '$marca', $precio,'$pais')";

	if ($conn->query($sql) === TRUE) {
	    echo "Registro añadido correctamente.";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	echo "<br>";
	echo "<br>";

  echo "<a href='tp2.5.php'>Volver atrás</a>";
 
 }?>


</body>
</html>