<?php

	require_once("config.php");



//Carregando apenas um usuário
	/*$root = new Usuario();

	$root->loadById(8);

	echo $root;

	*/
//Carregando uma lista de usuários

	/*$lista = Usuario::getList();

	echo json_encode($lista);*/

//Carregando uma lista de usuario, ordenando por login

	/*$search = Usuario::search("j");

	echo json_encode($search);*/

//Carregando um usuário atravez do login e da senha

	/*$usuario = new Usuario();
	$usuario->login("user", "!@#$");

	echo $usuario;*/

//Inserindo um usuário

	$aluno = new Usuario();

	$aluno->setDeslogin("aluno");
	$aluno->setDessenha("@lun0");

	$aluno->insert();

	echo $aluno;

	/*$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);*/

?>