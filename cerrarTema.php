<?php
include("funciones.php");
include("conectaBD.php");
include("crud.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
if(empty($_GET['id'])){
    header("Location: temas.php");
}else{
    $id = $_GET['id'];
    unset($_GET['id']);
    $fecha_actual = date("Y-m-d H:i:s");
    $result = cerrarTema($id, $fecha_actual);
    header("Location: temas.php");
}


?>