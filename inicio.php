<?php
session_start();
include("funciones.php");
include("conectaBD.php");
include("crud.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}else{
    $user = $_SESSION['usuario'];
    $sql = "select tipoUsuario from usuarios where nombre ='".$user."'";
    $result = $conexion -> query($sql);
    $result = $result -> fetch_row();
    $tipoUsuario = $result[0];
}
if($tipoUsuario != "administrador"){
    header("Location: index.php");
}

cabecera();
menu("inicio", $tipoUsuario, $user);

$usuarios = selectUsuarios();
$categorias = selectCategorias();
$temas = selectTemas();

mostrarUsuarios($usuarios, "");
mostrarCategorias($categorias);
mostrarTemas($temas, "", $user, "");


footer();
?>