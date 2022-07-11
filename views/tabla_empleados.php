<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../model/validador.php';
$rol = $_SESSION['empleado']["empRol"]

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Empleados - HNet</title>

    <?php 
        include '../components/head.php';
    ?>
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
            include '../components/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                    include '../components/topbar.php';
                ?>  
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Empleados</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="col-2">
                                <div class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary bg-gradient-primary w-100 boton-crear" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                                    Crear
                                    <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Run</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Rol</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Run</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Rol</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal detalles -->
            <div class="modal fade modal-empleado" id="modalDetalleEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label name="telefono" for="telefono">telefono</label>
                                    <li id="det_telefono" class="list-group-item"> </li>
                                    <label name="rol" for="rol">rol</label>
                                    <li id="det_rol" class="list-group-item"> </li>
                                    <label name="jefatura" for="jefatura">jefatura</label>
                                    <li id="det_jefatura" class="list-group-item"> </li>
                                </ul>
                            </div>
                
                            <div class="modal-footer">
                                <input type="hidden" name="id_empleado" id="det_id_empleado">             
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <!-- Modal detalles -->
            <!-- Modal Editar -->
            <?php
            if ($rol == 'UTP') {
            ?>
            <div class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                    <form method="POST" id="formulario" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">

                                <label for="run">Ingrese Run</label>
                                <input type="text" name="run" id="run" class="form-control">
                                <br />

                                <label for="pw">Ingrese contraseña</label>
                                <input type="text" name="pw" id="pw" class="form-control">
                                <br />

                                <label for="email">Ingrese el email</label>
                                <input type="email" name="email" id="email" class="form-control">
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

                                <label for="direccion">Ingrese Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                                <br />

                                <label for="telefono">Ingrese telefono</label>
                                <input type="number" name="telefono" id="telefono" class="form-control">
                                <br />

                                <label for="celular">Ingrese Celular</label>
                                <input type="number" name="celular" id="celular" class="form-control">
                                <br />

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Rol: </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" id="drop-rol">Profesor/a</a>
                                            <a class="dropdown-item" id="drop-rol">UTP</a>
                                            <a class="dropdown-item" id="drop-rol">Inspector/a</a>
                                            <a class="dropdown-item" id="drop-rol">Orientador/a</a>
                                        </div>
                                    </div>
                                    <input type="text" name="rol" id="rol" class="form-control" readonly="true">
                                </div>

                                <!-- <label for="rol">Ingrese rol</label>
                                <input type="text" name="rol" id="rol" class="form-control"> -->
                                <br />

                                <label for="jefatura">Ingrese jefatura</label>
                                <input type="number" name="jefatura" id="jefatura" class="form-control">
                                <br />

                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id_empleado" id="id_empleado">          
                                <input type="hidden" name="operacion" id="operacion">             
                                <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                            </div>
                        </div>
                    </form>
                </div>     
            </div>
            </div>
            <?php
            }
            ?>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include '../components/logout.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-empleados.js"></script>

</body>

</html>