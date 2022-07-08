<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../model/validador.php';
require_once('../model/curso.php');
require_once("../model/asignatura.php");
$as = new Asignatura();
$asignaturas = $as->obtenerAsignaturas();

$id_curso = (isset($_GET["id"])) ? $_GET["id"] : "";


?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

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
                    <h1 class="h3 mb-2 text-gray-800" id="page-header">Curso </h1>
                    <div class="card-body">
                        <input type="hidden" id="lbl-idcurso">             

                        <span id="lbl-idlibro" class="text-monospace">Id Libro: </span>
                        <span id="texto-idlibro" class="text-monospace"></span>
                        <br>
                        <span id="lbl-anio" class="text-monospace">Año: </span>
                        <br>
                        <span id="lbl-profesor" class="text-monospace">Profesor Jefe: </span>
                        <br>
                        <span id="lbl-sala" class="text-monospace">Sala: </span>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="alumnos" aria-selected="true">Alumnos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="asignatura-tab" data-toggle="tab" href="#asignatura" role="tab" aria-controls="asignatura" aria-selected="false">Asignaturas</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="horario-tab" data-toggle="tab" href="#horario" role="tab" aria-controls="horario" aria-selected="false">Horarios</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="alumnos_dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th >ID</th>
                                                <th >Curso</th>
                                                <th >Run</th>
                                                <th >Nombre</th>
                                                <th >Apellido Paterno</th>
                                                <th >Apellido Materno</th>
                                                <th ></th>
                                                <th ></th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th >ID</th>
                                                <th >Curso</th>
                                                <th >Run</th>
                                                <th >Nombre</th>
                                                <th >Apellido Paterno</th>
                                                <th >Apellido Materno</th>
                                                <th ></th>
                                                <th ></th>
                                                <th ></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="asignatura" role="tabpanel" aria-labelledby="asignatura-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <table class="table table-bordered" id="asignatura_dataTable" width="100%" >
                                                <thead>
                                                    <tr>
                                                        <th >ID</th>
                                                        <th >Nombre</th>
                                                        <th >Profesor</th>
                                                        <th ></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th >ID</th>
                                                        <th >Nombre</th>
                                                        <th >Profesor</th>
                                                        <th ></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Asignatura: </button>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    foreach ($asignaturas as $a) {
                                                    ?>
                                                    <a class="asignatura_tabla dropdown-item" id="<?= $a['IDASIGNATURA'] ?>"><?= $a['NOMBREASIGNATURA'] ?></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="inpt-asignatura">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ID Profesor: </span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <button type="button" class="btn btn-primary bg-gradient-primary w-100 btn-block">Agregar asignatura</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="horario" role="tabpanel" aria-labelledby="horario-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm" id="tabla_horario">
                                        <table class="table table-bordered" id="horario_dataTable" width="100%" >
                                                <thead>
                                                    <tr>
                                                        <th >ID</th>
                                                        <th >Asignatura</th>
                                                        <th >ID Libro</th>
                                                        <th >Fecha</th>
                                                        <th >Hora Inicio</th>
                                                        <th >Hora Fin</th>
                                                        <th >Asistencia Profesor</th>
                                                        <th ></th>
                                                        <th ></th>
                                                        <th ></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th >ID</th>
                                                        <th >Asignatura</th>
                                                        <th >ID Libro</th>
                                                        <th >Fecha</th>
                                                        <th >Hora Inicio</th>
                                                        <th >Hora Fin</th>
                                                        <th >Asistencia Profesor</th>
                                                        <th ></th>
                                                        <th ></th>
                                                        <th ></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                    </div>
                                    <div class="col-4" >
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Asignatura: </button>
                                                <div class="dropdown-menu">
                                                    <?php
                                                    foreach ($asignaturas as $a) {
                                                    ?>
                                                    <a class="asignatura_horario dropdown-item" id="<?= $a['IDASIGNATURA'] ?>"><?= $a['NOMBREASIGNATURA'] ?></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="inpt-asignatura_horario" disabled>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Fecha: </span>
                                            </div>
                                            <input type="date" class="form-control " id="fecha-asignatura" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Inicio: </span>
                                            </div>
                                            <input type="time" class="form-control" id="inicio-asignatura" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Fin: </span>
                                            </div>
                                            <input type="time" class="form-control" id="final-asignatura" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Asistencia Profesor: </span>
                                            </div>
                                            <div class="form-check form-check-inline" style="padding-left: 2em;">
                                                <input class="form-check-input" type="radio" name="asistencia" id="asistencia1" value="Presente">
                                                <label class="form-check-label" for="chebox_asistencia">Presente</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="asistencia" id="asistencia2" value="Ausente">
                                                <label class="form-check-label" for="chebox_asistencia">Ausente</label>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary bg-gradient-primary w-100 btn-block" id="btn-agregar">Agregar horario </button>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id_horario" id="id_horario">             
                                            <input type="hidden" name="operacion_horario" id="operacion_horario" value="Crear">             
                                        </div>
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
    <script src="../js/demo/datatables-alumnos.js"></script>
    <script src="../recursos/js/curso_detail.js"></script>

</body>