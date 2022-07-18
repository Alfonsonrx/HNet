<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../model/validador.php';
require_once("../model/horario.php");
require_once("../model/alumno.php");

$id_horario = (isset($_GET["id"])) ? $_GET["id"] : "";
$horario = new Horario();
$det_horario = $horario->obtenerHorario($id_horario);
$al = new Alumnos();

$jef_curso = ($det_horario[2] == $_SESSION["empleado"]["curso_jef"] or $_SESSION["empleado"]["empRol"] == 'UTP');

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Horario <?=$id_horario?> - HNet</title>
    <?php include '../components/head.php'; ?>
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../components/sidebar.php'; ?>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include '../components/topbar.php'; ?>  
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" id="page-header">Asistencias en horario: <?=$id_horario?></h1>
                    <div class="card-body">
                        <input type="hidden" id="lbl-idcurso">             

                        <span id="lbl-idlibro" class="text-monospace">Asignatura: <?=$det_horario[1] ?></span>
                        <br>
                        <span id="lbl-idlibro" class="text-monospace">Id Curso: <?=$det_horario[2] ?></span>
                        <br>
                        <span id="lbl-anio" class="text-monospace">Fecha: <?=$det_horario[3] ?></span>
                        <br>
                        <span id="lbl-profesor" class="text-monospace">Hora Inicio: <?=$det_horario[4] ?></span>
                        <br>
                        <span id="lbl-profesor" class="text-monospace">Hora Fin: <?=$det_horario[5] ?></span>
                    </div>
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th >ID</th>
                                                <th >Nombre Alumno</th>
                                                <th >Observacion</th>
                                                <th >Estado Asistencia</th>
                                                <th ></th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th >ID</th>
                                                <th >Nombre Alumno</th>
                                                <th >Observacion</th>
                                                <th >Estado Asistencia</th>
                                                <th ></th>
                                                <th ></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-3" >
                                    <div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Alumno: </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" disabled >Selecionar Alumno:</a>
                                                    
                                                    <?php
                                                    $alumnos = $al->obtenerAlumnosCurso($det_horario[2]);    
                                                    
                                                    foreach ($alumnos as $a) {
                                                    ?>
                                                    <a class="alumnos-drop dropdown-item" id="<?= $a['IDALUMNO'] ?>"><?= $a['NOMBREIDALUMNO']." ".$a['PATERNOIDALUMNO']." ".$a['MATERNOIDALUMNO'] ?></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="inpt-alumno" disabled>
                                        </div>
                                    </div>

                                    <label for="observacion">Observacion:</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="observacion" aria-label="With textarea"></textarea>
                                    </div>
                                    </br>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Estado Asistencia: </span>
                                        </div>
                                        <div class="form-check form-check-inline" style="padding-left: 2em;">
                                            <input class="form-check-input" type="radio" name="asistencia" id="asistencia1" value="1">
                                            <label class="form-check-label" for="chebox_asistencia">Presente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="asistencia" id="asistencia2" value="0">
                                            <label class="form-check-label" for="chebox_asistencia">Ausente</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary bg-gradient-primary w-100 btn-block" id="btn-agregar">Agregar asistencia: </button>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id_asistencia" id="id_asistencia" value="">             
                                        <input type="hidden" name="id_horario" id="id_horario" value="<?=$id_horario ?>">             
                                        <input type="hidden" name="fecha_horario" id="fecha_horario" value="<?=$det_horario[3] ?>">             
                                        <input type="hidden" name="operacion_asistencia" id="operacion_asistencia" value="Crear">             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include '../components/modal_alumno.php'; ?>

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
    <script src="../js/demo/datatables-asistencias.js"></script>

</body>