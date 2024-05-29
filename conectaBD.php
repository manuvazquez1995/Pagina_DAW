<?php
/**
* @author Manuel Vazquez Suarez
* Funcion que se encarga de la conexion a la base de datos.
*/

$host="localhost";
$usuario="root";
$password="abc123.";
$db= "Foro";
$con = mysqli_connect($host,$usuario,$password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//VERSION CON OBXETOS
$conexion = new mysqli($host,$usuario,$password,$db);
?>
