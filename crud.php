<?php
/*
EN ESTE ARCHIVO ESTA TODAS LAS CONSULTAS PREPARADAS PARA CREAR, BORRAR O MODIFICAR DATOS DE LA BD.
*/
include("conectaBD.php");

// PARA LOS USUARIOS.
// Funcion que nos devuelve todos los usuarios con sus datos.
/**
* Funcion que seleccionar todos los usuarios de la base de datos.
* @return array con una lista da todos los usuarios.
*/
function selectUsuarios(){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select * from usuarios");
    $result = $consulta->fetch_all(MYSQLI_ASSOC);
    $consulta -> close();
    $conexion->close();
    return $result;
}

// Funcion que extrae el nombre de un usuario buscandolo por su id.
/**
* Funcion que busca un usuario de la base de datos  buscandolo por su id
* @return un array con los valore de sus columnas.
*/
function selectNombreUser($idUsuario){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select nombre from usuarios where id=".$idUsuario);
    $result = $consulta->fetch_row();
    $consulta -> close();
    $conexion->close();
    return $result;
}


// Funcion que inserta un usuario.
/**
* Funcion que inserta un usuario pasandole los siguientes parametros.
* @param string $nombre : nombre del usuario.
* @param string $password : password del usuario.
* @param string $email : email del usuario.
* @param string $tipoUsuario : le asigna un tipo se usuario (admin, creator...).
* @param integer $n_temas : numero de temas en los que puede estar.
* @param integer Â$n_post : numero de post creados por el usuario.
*/
function insertUsuario($nombre, $password, $email, $tipoUsuario, $n_temas, $n_post){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("insert into usuarios(nombre,password,email,tipoUsuario,n_temas,n_post) values (?,?,?,?,?,?)");
    $consulta -> bind_param('ssssii', $nombre, $password, $email, $tipoUsuario, $n_temas, $n_post);
    $datos = $consulta -> execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}


// Funcion que elimina un usuario.
/**
* Function que elimina un usuario de la base de datos.
* @param integer $id : id del usuario a eliminar.
*/
function borrarUsuario($id){
    $conexion = new mysqli("localhost", "root", "abc123.", "Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("delete from usuarios where id=?");
    $consulta -> bind_param("i", $id);
    $datos = $consulta->execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}





// PARA LAS CATEGORIAS.
// Funcion que nos devuelve todas las categorias.
function selectCategorias(){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select * from categorias");
    $consulta = $consulta->fetch_all(MYSQLI_ASSOC);
    $conexion -> close();
    return $consulta;
}

// Funcion que inserta una categoria a la base de datos.
function insertCategoria($nombre, $descripcion){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("insert into categorias(nombre,descripcion) values (?,?)");
    $consulta -> bind_param('ss', $nombre, $descripcion);
    $datos = $consulta -> execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}

// Funcion que nos devuelve solo los id y los nombres de las categorias (Necesario para algunas funciones). 
function selectCategoriasIdNombre(){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select id,nombre from categorias");
    $consulta = $consulta->fetch_all(MYSQLI_ASSOC);
    $conexion -> close();
    return $consulta;
}

// Funcion que comprueba si existen categorias (lo requiere en el formulario de temas).
function contarCategorias(){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select count(id) from categorias");
    $consulta = $consulta->fetch_row();
    $conexion->close();
    return $consulta;
}




// PARA LOS TEMAS.
// Funcion que nos devuelve todos los temas.
function selectTemas(){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select * from temas");
    $consulta = $consulta->fetch_all(MYSQLI_ASSOC);
    $conexion -> close();
    return $consulta;
}

// Funcion que borra un tema.
function borrarTema($id){
    $conexion = new mysqli("localhost", "root", "abc123.", "Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("delete from temas where id=?");
    $consulta -> bind_param("i", $id);
    $datos = $consulta->execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}

// Funcion que cierra un tema.
function cerrarTema($id, $fecha_actual){
    $conexion = new mysqli("localhost", "root", "abc123.", "Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("update temas set fecha_cierre =? where id=?");
    $consulta -> bind_param("si", $fecha_actual, $id);
    $datos = $consulta->execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}

// Funcion que inserta un tema nuevo a la BD.
function insertTema($idUsuario, $idCategoria, $nombre, $descripcion, $n_resp){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion -> stmt_init();
    $fechaActual = date("Y-m-d H:i:s");
    $consulta -> prepare("insert into temas(id_usuario,id_categorias,nombre,descripcion,n_resp,fecha_creacion) values (?,?,?,?,?,?)");
    $consulta -> bind_param("iissis", $idUsuario, $idCategoria, $nombre, $descripcion, $n_resp,$fechaActual);
    $datos = $consulta -> execute();
    $consulta -> close();
    $conexion -> close();
    return $datos;
}




// PARA LOS COMENTARIOS.
// Funcion que nos devuelve todos los comentarios de un tema.
function selectComentarios($tema){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion->query("select * from comentarios where id_tema='".$tema."'");
    $consulta = $consulta->fetch_all(MYSQLI_ASSOC);
    $conexion -> close();
    return $consulta;
}

// Funcion que inserta un comentario.
function insertComentario($idUsuario, $idTema, $titulo, $comentario){
    $conexion = new mysqli("localhost", "root", "abc123.","Foro");
    $consulta = $conexion -> stmt_init();
    $consulta -> prepare("insert into comentarios (id_usuario,id_tema,titulo,comentario) values (?,?,?,?)");
    $consulta -> bind_param('iiss', $idUsuario, $idTema, $titulo, $comentario);
    $consulta -> execute();
    $consulta -> close();
    $conexion -> close();
    //return $datos;
}


?>
