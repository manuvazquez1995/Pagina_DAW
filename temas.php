<?php
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
    $idUsuario = $result[1];
}

cabecera();
menu("temas", $tipoUsuario, $user);

$temas = selectTemas();

mostrarTemas($temas, "cerrar", $user, $idUsuario); //Como el admin tiene control total puede elimnar temas que no son suyos.

if($tipoUsuario == "administrador" | $tipoUsuario == "creador"){ 
    if(empty($_GET)){
        $nCat = contarCategorias();
        if($nCat[0] == 0){
            ?>
            <div class="container p-3 my-5 border">
                <p>No hay ninguna categoria para poder crear un tema.</p>
            </div>
            <?php
        }else{
            crearTemaForm(selectCategoriasIdNombre());

        }
     
    }else{
        insertTema($idUsuario, $_GET['categoria'], $_GET['nombre'], $_GET['descripcion'],0);
        header("Location: temas.php");
    
    }
}


footer();
?>