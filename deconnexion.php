<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location:index_etablissement_connexion.php");
?>