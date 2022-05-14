<?php
if(!isset($_COOKIE["auth"]) || $_COOKIE["auth"] == "false"){
    header("Location: http://localhost/HNet/login.php");
}
?>