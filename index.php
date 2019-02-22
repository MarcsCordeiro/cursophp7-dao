<?php 

require_once("config.php");

$root = new Usuario();

$root->loadbyId(8);

echo $root;
?>