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

if(empty($_GET['idTema']) & empty($_GET['estado'])){
    header("Location: temas.php");
}else{
    $idTema = $_GET['idTema'];
    $estado = $_GET['estado'];
    unset($_GET['idTema']);
    unset($_GET['estado']);

}

cabecera();
menu("temas", $tipoUsuario, $user);

$comentarios = selectComentarios($idTema);

?>
    <div class="container p-3 my-5 border">
        <h3>AVISO</h3>
        <p>No se por qué, pero no me funciona la función insertComentario(), para probar los comentarios y las acciones que tienen los usuarios sobre ellos los hay que insertar manualmente los comentarios en phpmyadmin.</p>
    </div>
<?php

mostrarComentarios($comentarios);

if($tipoUsuario != "soloLectura" & $estado == null){
    if(empty($_GET)){
        crearComentarioForm();

    }else{
        insertComentario($idUsuario, $idTema, $_GET['titulo'], $_GET['comentario']);
        header("Location: temas.php");
    }
}

if($estado != null){
    ?>
    <div class="container p-3 my-5 border">
        <p><strong>Este tema está cerrado, no se puede comentar.</strong></p>
    </div>
    <?php
}


footer();
?>