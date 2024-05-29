<?php

/**
* @author Manuel Vazquez Suares
* Clase que se encarga de las categorias.
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
    if($tipoUsuario != "administrador" & $tipoUsuario != "creador"){
        header("Location: index.php");
    }
}

cabecera();
menu("categorias", $tipoUsuario, $user);

/* ESTA PÁGINA SOLO LA PUEDE ADMINISTRAR UN USUARIO ADMINISTRADOR O CREADOR. */

$categorias = selectCategorias();

mostrarCategorias($categorias);

if(empty($_GET)){
    crearCategoriaForm();
        
}else{
    insertCategoria($_GET['nombre'], $_GET['descripcion']);
    header("Location: categorias.php");

}



footer();
?>
