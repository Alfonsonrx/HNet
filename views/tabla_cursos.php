<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../model/validador.php';

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cursos - HNet</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Cursos</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="col-2">
                                <div class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary bg-gradient-primary w-100 boton-crear" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                                    <i class="bi bi-plus-circle-fill"></i> Crear
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
                                            <th>ID Libro</th>
                                            <th>Año</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Sala</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID Libro</th>
                                            <th>Año</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Sala</th>
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

            <!-- Modal Crear/Editar -->
            <div class="modal fade modal-alumno" id="modalCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearModalLabel">Crear Usuario</h5>
                            <button type="button" class="btn-close fas fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <form method="POST" id="formulario" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-body">
                                    
                                    <label for="run">Ingrese Id Libro</label>
                                    <input type="text" name="run" id="run" class="form-control">
                                    <br />

                                    <label for="run">Ingrese Año</label>
                                    <input type="date" name="run" id="run" class="form-control">
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
                                </div>
                    
                                <div class="modal-footer">
                                    <input type="hidden" name="id_curso" id="id_curso">             
                                    <input type="hidden" name="operacion" id="operacion">             
                                    <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>

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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
    <script src="../js/demo/datatables-cursos.js"></script>
    
</body>

</html>