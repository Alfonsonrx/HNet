<!-- Modal detalles -->
<div class="modal fade modal-alumno" id="modalDetalleAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modalDetalle-title" id="detalleModalLabel"> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <label name="id_curso" for="id_curso">Curso</label>
                        <li id="det_id_curso" class="list-group-item"> </li>
                        <label name="run" for="run">run</label>
                        <li id="det_run" class="list-group-item"> </li>
                        <label name="fecha_nacimiento" for="fecha_nacimiento">fecha_nacimiento</label>
                        <li id="det_fecha_nacimiento" class="list-group-item"> </li>
                        <label name="email" for="email">email</label>
                        <li id="det_email" class="list-group-item"> </li>
                        <label name="direccion" for="direccion">direccion</label>
                        <li id="det_direccion" class="list-group-item"> </li>
                        <label name="celular" for="celular">celular</label>
                        <li id="det_celular" class="list-group-item"> </li>
                    </ul>
                </div>
    
                <div class="modal-footer">
                    <input type="hidden" name="id_alumno" id="det_id_alumno">             
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- Modal detalles -->

<!-- Modal Crear/Editar -->
<?php
require_once('../model/curso.php');
$cursos = new Cursos();
$lista_cursos = $cursos->obtenerCursos();
?>
<div class="modal fade modal-alumno" id="modalAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-ingresar-title" id="crearModalLabel">Crear Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <form method="POST" id="formulario" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Curso: </button>
                                <div class="dropdown-menu">
                                    <?php
                                    foreach ($lista_cursos["data"] as $c) {
                                    ?>
                                    <a class="drop-curso dropdown-item" id="<?= $c[0]; ?>"><?= $c[3]." ".$c[4]; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <input type="text" name="id_curso" class="form-control id_curso" readonly="true">
                        </div>
                        <br />
                        
                        <label for="run">Ingrese Run</label>
                        <input type="text" name="run" id="run" class="form-control" maxlength="10">
                        <br />
                        
                        <label for="nombre">Ingrese el nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                        <br />
                        
                        <label for="apellido_paterno">Ingrese Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control">
                        <br />
                        
                        <label for="apellido_materno">Ingrese Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control">
                        <br />
                        
                        <label for="fecha_nacimiento">Ingrese fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                        <br />
        
                        <label for="email">Ingrese el email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <br />
                        
                        <label for="direccion">Ingrese Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control">
                        <br />
        
                        <label for="celular">Ingrese Celular</label>
                        <input type="number" name="celular" id="celular" class="form-control">
                        <br />
        
                    </div>
        
                    <div class="modal-footer">
                        <input type="hidden" name="id_alumno" id="id_alumno">             
                        <input type="hidden" name="operacion" id="operacion">             
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>