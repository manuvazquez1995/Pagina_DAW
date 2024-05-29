<?php
session_start();
include("funciones.php");
include("conectaBD.php");

cabecera();

/*
* @author Manuel Vazquez Suarez
*/


if(isset($_SESSION['usuario'])){
    header("Location: inicio.php");

}else{

    if(empty($_GET)){
        login();

    }else{
        $nombre = $_GET['nombre'];
        $password = $_GET['password'];
        $result = $conexion -> query("select password from usuarios where nombre='".$nombre."'");
        $datos = $result -> fetch_row();


        if(empty($datos)){
            ?>
            <div class="container p-3 my-5 border">
                <p>No existe el usuario <strong><?php echo $_GET['nombre']; ?></strong></p>
                <a href="index.php">Volver a login.</a>
            </div>
            <?php

        }else{
            $_SESSION['usuario'] = $nombre;
            header("Location: temas.php");

        }

        $result -> close();
        $conexion -> close();
    }

}


footer();
?>
