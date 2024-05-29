<?php
include("funciones.php");
include("conectaBD.php");
include("crud.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
if(empty($_GET['id'])){
    header("Location: usuarios.php");
}else{
    $id = $_GET['id'];
    unset($_GET['id']);
    $result = borrarUsuario($id);
    header("Location: usuarios.php");
}


?>