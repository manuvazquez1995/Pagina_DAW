<?php
include("conectaBD.php");
include("crud.php");

/*
* IMPORTANTE: primero hay que crear la base de datos antes de ejecutar
este código, si no, no funciona. Con el siguiente código se crean las tablas y sus relaciones.
*/
$sql ="";

$sql .= "create table usuarios (
    id int(50) not null auto_increment,
    nombre varchar(50) not null,
    password varchar(50) not null,
    email varchar(20) not null,
    tipoUsuario varchar(20) not null,
    n_temas int(100) not null,
    n_post int(100) not null,
    primary key (id)    
);";
$sql .= "create table categorias(
    id int(50) not null auto_increment,
    nombre varchar(50) not null,
    descripcion varchar(500) not null,
    fecha_creacion timestamp default current_timestamp,
    primary key(id)
);";
$sql .= "create table temas(
    id int(50) not null auto_increment,
    id_usuario int(50) not null,
    id_categorias int(50) not null,
    nombre varchar(50) not null,
    descripcion varchar(500) not null,
    n_resp int(100) not null,
    fecha_creacion date not null,
    fecha_cierre date null,
    primary key(id),
    foreign key (id_usuario) references usuarios(id),
    foreign key (id_categorias) references categorias(id)
);";
$sql .= "create table comentarios(
    id int(50) not null auto_increment,
    id_usuario int(50) not null,
    id_tema int(50) not null,
    titulo varchar(50) not null,
    comentario varchar(250) not null,
    fecha_creacion timestamp default current_timestamp,
    primary key(id),
    foreign key (id_usuario) references usuarios(id),
    foreign key (id_tema) references temas(id)
);";


$result = mysqli_multi_query($con,$sql);

// Se crea también un usuario administrador por defecto llamado "Usuario".
insertUsuario("administrador", "abc123.", "administrador@foro.com", "administrador", 0, 0);

if(!$result){
    echo "TABLAS NO CREADAS";
}else{
    header("Location: index.php");
}

?>