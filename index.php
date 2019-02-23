<?php 

require_once("config.php");

//Carrega um só usuario
//$root = new Usuario();
//$root->loadbyId(8);
//echo $root;

//carrega todos os usuários da tabela
//$lista = Usuario::getList();
//echo json_encode($lista);

//Busca pelo login
//$seach = Usuario::seach("ma");
//echo json_encode($seach);

$usuario = new Usuario();
$usuario->login("user", "111223");

echo $usuario;
?>