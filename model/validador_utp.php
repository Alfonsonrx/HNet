<?php

if(!isset($_SESSION["empleado"]["empRol"]) || $_SESSION["empleado"]["empRol"] != "UTP"){
    header("Location: http://localhost/HNet/views/404.php");
}

?>