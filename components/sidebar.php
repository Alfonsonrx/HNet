
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Humberto<sup>Net</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="../index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Paginas
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-users-cog"></i>
            <span>Administrar</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tablas:</h6>
                <!-- <a class="collapse-item" href="../views/login.php">Login</a> -->
                <a class="collapse-item" href="../views/tabla_libros.php">Libros de Curso</a>
                <a class="collapse-item" href="../views/tabla_asignaturas.php">Asignaturas</a>
                <div class="collapse-divider"></div>
                <!-- <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="../views/404.php">404 Page</a>
                <a class="collapse-item" href="../views/blank.php">Blank Page</a> -->
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="../views/tabla_cursos.php">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Cursos</span></a>
    </li>

    <!-- Nav Item - Alumnos -->
    <li class="nav-item">
        <a class="nav-link" href="../views/tabla_alumnos.php">
        <i class="fas fa-users"></i>
        <span>Alumnos</span></a>
    </li>
    <?php
    if ($_SESSION['empleado']["empRol"] == "UTP") {
    ?>
    <!-- Nav Item - Empleados -->
    <li class="nav-item">
        <a class="nav-link" href="../views/tabla_empleados.php">
        <i class="fas fa-address-card"></i>
        <span>Empleados</span></a>
    </li>
    <?php
    }
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>