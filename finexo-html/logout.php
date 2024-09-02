<?php
// Inicia a sessão.
session_start();

session_destroy();
header("location:index.php");
?>

