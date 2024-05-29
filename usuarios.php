<?php
/**
* @Author Manuel Vazquez Suarez
* Este archivo sirve para eliminar un usuario.
*/
session_start();
include("funciones.php");
include("conectaBD.php");
include("crud.php");

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}else{
    $user = $_SESSION['usuario'];
    $sql = "select tipoUsuario,id from usuarios where nombre ='".$user."'";
    $result = $conexion -> query($sql);
    $result = $result -> fetch_row();
    $tipoUsuario = $result[0];
    if($tipoUsuario != "administrador"){
        header("Location: index.php");
    }
}

cabecera();
menu("usuarios", $tipoUsuario, $user);



$usuarios = selectUsuarios();

if($tipoUsuario == "administrador"){
    mostrarUsuarios($usuarios, "eliminar");
}


if(empty($_GET)){
    crearUsuarioForm();
        
}else{
    insertUsuario($_GET['nombre'], $_GET['password'], $_GET['email'], $_GET['tipoUsuario'], 0, 0);
    header("Location: usuarios.php");
    
}



footer();
?>
