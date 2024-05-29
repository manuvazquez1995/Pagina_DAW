<?php
/**
*@Author Manuel Vazquez
*/


function cabecera(){
    ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>DAWIN</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
        <body> 
    <?php
}


function footer(){
    ?>
        </body>
        <footer>
            <div class="container p-1 my-5 bg-dark text-white">
                <p class="text-center">FORO</p>
            </div>
        </footer>
    </html>    
    <?php
}

/**
* Funcion que muestra un menu en la web.
* @param string $pagina para mostrar el nombre de la pagina
* @param string $tipoUsuario para mostrar que tipo de usuario esta logeado.
* @param string $user muestra el nombre del usuario
*/

function menu($pagina, $tipoUsuario, $user){
    if($tipoUsuario == "administrador"){
    ?>
    <div class="container p-2 my-5 bg-dark text-white">
        <p><strong><?php echo $user; ?></strong> (<?php echo $tipoUsuario; ?>)</p>
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item"><a class="nav-link<?php if($pagina=="inicio"){echo " active";} ?>" href="inicio.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link<?php if($pagina=="temas"){echo " active";} ?>" href="temas.php">Temas</a></li>
            <li class="nav-item"><a class="nav-link<?php if($pagina=="usuarios"){echo " active";} ?>" href="usuarios.php">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link<?php if($pagina=="categorias"){echo " active";} ?>" href="categorias.php">Categorias</a></li>
            <li class="nav-item"><a class="nav-link" href="cerrarSesion.php">Cerrar sesión</a></li>
        </ul>
    </div>
    <?php
    }
    if($tipoUsuario == "creador"){
        ?>
        <div class="container p-2 my-5 bg-dark text-white">
            <p><strong><?php echo $user; ?></strong> (<?php echo $tipoUsuario; ?>)</p>
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item"><a class="nav-link<?php if($pagina=="temas"){echo " active";} ?>" href="temas.php">Temas</a></li>
                <li class="nav-item"><a class="nav-link<?php if($pagina=="categorias"){echo " active";} ?>" href="categorias.php">Categorias</a></li>
                <li class="nav-item"><a class="nav-link" href="cerrarSesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
        <?php
    }
    if($tipoUsuario == "comentador" | $tipoUsuario == "soloLectura"){
        ?>
        <div class="container p-2 my-5 bg-dark text-white">
            <p><strong><?php echo $user; ?></strong> (<?php echo $tipoUsuario; ?>)</p>
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item"><a class="nav-link<?php if($pagina=="temas"){echo " active";} ?>" href="temas.php">Temas</a></li>
                <li class="nav-item"><a class="nav-link" href="cerrarSesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
        <?php
    }
}


function login(){
    ?>
    <div class="container p-3 my-5 border">
        <h3>Login:</h3>
        <form action="" method="get">
            <div class="mb-3 mt-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión:</button>
        </form> 
    </div>
    <?php
}

/**
* Funcion que muestra una lista de usuarios con opcion.
* @param array $usuarios recibe un array con todos los usuarios.
* @param integer $op recibe un numero de opcion.
*/


function mostrarUsuarios($usuarios, $op){
    if($usuarios != null){
        ?>
        <div class="container p-3 my-5 border">
            <h3>Todos los usuarios:</h3>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Tipo Usuario</th>
                        <th>Nº temas</th>
                        <th>Nº post</th>
                        <?php if($op == "eliminar"){echo "<th>Opción</th>";} ?>
                    <tr>
                </thead>
                <tbody>
                <?php
                    foreach($usuarios as $usuario){
                        ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nombre']; ?></td>
                            <td><?php echo $usuario['password']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['tipoUsuario']; ?></td>
                            <td><?php echo $usuario['n_temas']; ?></td>
                            <td><?php echo $usuario['n_post']; ?></td>
                            <?php if($op == "eliminar"){echo "<td><a href=\"eliminarUsuario.php?id=".$usuario['id']."\">Eliminar</a></td>";} ?>
                        </tr>    
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }else{
        ?>
        <div class="container p-3 my-5 border">
            <h3>Todos los usuarios:</h3>
            <p>No existe ningún usuario.</p>
        </div>
        <?php    
    }
}


/**
* Funcion que muestra por pantalla las categorias.
* @param array $categorias es un array que contiene todas las categorias existentes.
*/


function mostrarCategorias($categorias){
    if($categorias != null){
        ?>
        <div class="container p-3 my-5 border">
            <h3>Todas las categorias:</h3>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de creación:</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                    foreach($categorias as $categoria){
                        ?>
                        <tr>
                            <td><?php echo $categoria['id']; ?></td>
                            <td><?php echo $categoria['nombre']; ?></td>
                            <td><?php echo $categoria['descripcion']; ?></td>
                            <td><?php echo $categoria['fecha_creacion']; ?></td>
                        </tr>    
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }else{
        ?>
        <div class="container p-3 my-5 border">
            <h3>Todas las categorias:</h3>
            <p>No existe ninguna categoría.</p>
        </div>
        <?php    
    }
}


/**
* Funcion que muestra los temas exitentes.
* @param array $temas es un array donde contiene los temas a mostrar.
* @param integer $op variable bandera para mostrar ciertas opciones.
* @param string $usuario para mostrar el nombre de usuario.
* @param integer $idUsuario para mostrar el id del usuario.
*/


function mostrarTemas($temas, $op, $usuario, $idUsuario){
    if($temas != null){
        if($usuario == "administrador"){
            ?>
            <div class="container p-3 my-5 border">
                <h3>Todos los temas:</h3>
                <p>Para entrar en uno, haga click en el nombre.</p>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Nº respuestas</th>
                            <th>Fecha de creación:</th>
                            <th>Fecha de de cierre:</th>
                            <th><?php if($op == "cerrar"){echo "<th>Opción</th>";} ?>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($temas as $tema){
                            ?>
                            <tr>
                                <td><?php echo $tema['id']; ?></td>
                                <td><a href="verTema.php?idTema=<?php echo $tema['id'];?>&estado=<?php echo $tema['fecha_cierre'];?>"><?php echo $tema['nombre']; ?></a></td>
                                <td><?php echo $tema['descripcion']; ?></td>
                                <td><?php echo $tema['n_resp']; ?></td>
                                <td><?php echo $tema['fecha_creacion']; ?></td>
                                <td><?php echo $tema['fecha_cierre']; ?></td>
                                <?php if($op == "cerrar" & $tema['fecha_cierre']==null){echo "<td><a href=\"cerrarTema.php?id=".$tema['id']."\">Cerrar</a></td>";} ?>
                            </tr>    
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        if($usuario == "creador"){
                ?>
                <div class="container p-3 my-5 border">
                    <h3>Temas:</h3>
                    <p>Para entrar en uno, haga click en el nombre.</p>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Nº respuestas</th>
                                <th>Fecha de creación:</th>
                                <th>Fecha de de cierre:</th>
                                <th><?php if($op == "cerrar"){echo "<th>Opción</th>";} ?>
                            <tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($temas as $tema){
                                ?>
                                    <tr>
                                        <td><?php echo $tema['id']; ?></td>
                                        <td><a href="verTema.php?idTema=<?php echo $tema['id']; ?>&estado=<?php echo $tema['fecha_cierre'];?>"><?php echo $tema['nombre']; ?></a></td>
                                        <td><?php echo $tema['descripcion']; ?></td>
                                        <td><?php echo $tema['n_resp']; ?></td>
                                        <td><?php echo $tema['fecha_creacion']; ?></td>
                                        <td><?php echo $tema['fecha_cierre']; ?></td>
                                        <?php if($op == "cerrar" & $tema['fecha_cierre']==null & $tema['id_usuario'] == $idUsuario){echo "<td>Propietario<br><a href=\"cerrarTema.php?id=".$tema['id']."\">Cerrar</a></td>";} ?>
                                    </tr>    
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            <?php
        }
        if($usuario == "comentador" | $usuario == "lector"){
            ?>
            <div class="container p-3 my-5 border">
                <h3>Todos los temas:</h3>
                <p>Para entrar en uno, haga click en el nombre.</p>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Nº respuestas</th>
                            <th>Fecha de creación:</th>
                            <th>Fecha de de cierre:</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($temas as $tema){
                            ?>
                            <tr>
                                <td><?php echo $tema['id']; ?></td>
                                <td><a href="verTema.php?idTema=<?php echo $tema['id']; ?>&estado=<?php echo $tema['fecha_cierre'];?>"><?php echo $tema['nombre']; ?></a></td>
                                <td><?php echo $tema['descripcion']; ?></td>
                                <td><?php echo $tema['n_resp']; ?></td>
                                <td><?php echo $tema['fecha_creacion']; ?></td>
                                <td><?php echo $tema['fecha_cierre']; ?></td>
                            </tr>    
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="container p-3 my-5 border">
            <h3>Todos los temas:</h3>
            <p>No existe ningun tema.</p>
        </div>
        <?php    
    }
}


function mostrarComentarios($comentarios){
    if($comentarios != null){
        ?><div class="container p-3 my-5 border"><h3>Comentarios del tema:</h3><?php
        foreach($comentarios as $comentario){
            ?>
                <?php $nombre = selectNombreUser($comentario['id_usuario']); ?>
                <div>
                    <strong><?php echo $nombre[0]; ?> -></strong> <?php echo $comentario['titulo']; ?><br>
                    <?php echo $comentario['comentario']; ?>
                </div>
                <hr>
            <?php
        }
        ?></div><?php
    }else{
        ?>
        <div class="container p-3 my-5 border">
            <h3>Comentarios del tema:</h3>
            <p>Aún no hay comentarios en este tema.</p>
        </div>
        <?php
    }
}


function crearComentarioForm(){
    ?>
    <div class="container p-3 my-5 border">
        <h3>Añadir comentario:</h3>
        <form action="" method="get">
            <div class="mb-3 mt-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="comentario" class="form-label">Comentario:</label>
                <input type="text" class="form-control" id="comentario" name="comentario" required>
            </div>
            <button type="submit" class="btn btn-primary">Añadir comentario</button>
        </form> 
    </div>
    <?php
}


function crearTemaForm($categorias){
    ?>
    <div class="container p-3 my-5 border">
        <h3>Crear tema:</h3>
        <form action="" method="get">
            <div class="mb-3 mt-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3 mt-3">
                <p>Categoria: </p>
                <select name="categoria">
                    <?php
                    foreach($categorias as $categoria){
                        ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form> 
    </div>
    <?php
}



function crearUsuarioForm(){
    ?>
    <div class="container p-3 my-5 border">
        <h3>Crear usuario:</h3>
        <form action="" method="get">
            <div class="mb-3 mt-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">Password:</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3 mt-3">
                <p>Tipo de usuario: 
                <select name="tipoUsuario">
                    <option value="administrador">Administrador</option>
                    <option value="creador">Creador</option>
                    <option value="comentador">Comentador</option>
                    <option value="soloLectura">Solo Lectura</option>
                </select>
                </p>
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form> 
    </div>
    <?php
}


function crearCategoriaForm(){
    ?>
    <div class="container p-3 my-5 border">
        <h3>Crear Categoria:</h3>
        <form action="" method="get">
            <div class="mb-3 mt-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form> 
    </div>
    <?php
}



?>
