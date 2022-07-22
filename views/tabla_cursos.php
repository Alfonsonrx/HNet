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
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Sala</th>
                                            <th>Año</th>
                                            <th>ID Libro</th>
                                            <th></th>
                                            <?php
                                            if ($rol == 'UTP') {
                                            ?>
                                            <th ></th>
                                            <th ></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nivel</th>
                                            <th>Seccion</th>
                                            <th>Sala</th>
                                            <th>Año</th>
                                            <th>ID Libro</th>
                                            <th></th>
                                            <?php
                                            if ($rol == 'UTP') {
                                            ?>
                                            <th ></th>
                                            <th ></th>
                                            <?php
                                            }
                                            ?>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    
                        <form method="POST" id="formulario" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-body">
                                    
                                    <label for="id_libro">Ingrese Id Libro</label>
                                    <input type="number" name="id_libro" id="id_libro" class="form-control">
                                    <br />

                                    <label for="anio">Ingrese Año</label>
                                    <input type="date" name="anio" id="anio" class="form-control">
                                    <br />
                                    
                                    <label for="nivel">Ingrese Nivel</label>
                                    <input type="text" name="nivel" id="nivel" class="form-control">
                                    <br />
                                    
                                    <label for="seccion">Ingrese Seccion</label>
                                    <input type="text" name="seccion" id="seccion" class="form-control">
                                    <br />
                                    
                                    <label for="sala">Ingrese Sala</label>
                                    <input type="number" name="sala" id="sala" class="form-control">
                                    <br />
                                </div>
                    
                                <div class="modal-footer">
                                    <input type="hidden" name="id_curso" id="id_curso" value="0">             
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

    <?php include '../components/logout.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-cursos.js"></script>
    
</body>

</html>