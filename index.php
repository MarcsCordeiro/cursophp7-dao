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


//$usuario = new Usuario();
//$usuario->login("user", "111223");

//echo $usuario;

/*
//Inserindo sem uso do construtor 
$aluno = new Usuario();

$aluno->setDeslogin("AlunoMM");
$aluno->setDessenha("eppeeppe");

$aluno->insert();

echo $aluno;
*/

/*
//Inserindo com o construtor
$aluno = new Usuario("Vicente", "jajaja");
$aluno->insert();
echo $aluno;
*/

//Fazendo o update pelo id
$aluno = new Usuario();

$aluno->loadbyId(7);
$aluno->update("profissional", "mestre");
echo $aluno;

?>