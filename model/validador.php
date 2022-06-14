<?php

if(!isset($_SESSION["auth"]) || $_SESSION["auth"] == "false"){
    header("Location: http://localhost/HNet/views/login.php");
}

?>