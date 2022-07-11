<!-- Modal detalles -->
<div class="modal fade modal-alumno" id="modalDetalleAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-info"></i>
                <h5 class="modalDetalle-title" id="detalleModalLabel"> </h5>
                <button type="button" class="btn-close fas fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
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
<div class="modal fade modal-alumno" id="modalAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearModalLabel">Crear Usuario</h5>
                <button type="button" class="btn-close fas fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        
            <form method="POST" id="formulario" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">
                        <label for="id_curso">Ingrese el id del curso</label>
                        <input type="text" name="id_curso" id="id_curso" class="form-control">
                        <br />
                        
                        <label for="run">Ingrese Run</label>
                        <input type="text" name="run" id="run" class="form-control">
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
                        <input type="text" name="celular" id="celular" class="form-control">
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