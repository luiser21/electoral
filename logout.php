<?php
//crear y destruir session
session_start();
// vaciarla variable de sesion
$_SESSION = array();
// destruirla
session_destroy();
header("location:index.php");
 ?>
