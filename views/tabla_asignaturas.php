<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../model/validador.php';
require_once("../model/empleado.php");

$prof = new Empleado();
$profesores = $prof->obtenerProfesores();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Libros de Clase - HNet</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Asignaturas</h1>
                    <!-- DataTales Example -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <table class="table table-bordered" id="asignatura_dataTable" width="100%" >
                                        <thead>
                                            <tr>
                                                <th >ID</th>
                                                <th >Nombre Asignatura</th>
                                                <th >Profesor</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th >ID</th>
                                                <th >Nombre Asignatura</th>
                                                <th >Profesor</th>
                                                <th ></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                            <div class="col-3">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Profesor: </button>
                                        <div class="dropdown-menu">
                                            <?php
                                            foreach ($profesores as $p) {
                                            ?>
                                            <a class="empleado-drop dropdown-item" id="<?= $p['IDEMPLEADO'] ?>"><?= $p['NOMBREEMPLEADO']." ".$p['PATERNOEMPLEADO']." ".$p['MATERNOEMPLEADO'] ?></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button" id="inpt-empleado" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Nombre: </span>
                                    </div>
                                    <input type="text" class="form-control" id="inpt-asignatura" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                                <button type="button" class="btn btn-primary bg-gradient-primary w-100 btn-block" id="btn-agregar">Agregar asignatura</button>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
    <script src="../js/demo/datatables-asignaturas.js"></script>

</body>

</html>