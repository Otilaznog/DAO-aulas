<?php

	require_once("config.php");



//Carregando apenas um usuário
	/*$root = new Usuario();

	$root->loadById(8);

	echo $root;

	*/
//Carregando uma lista de usuários

	$lista = Usuario::getList();

	echo json_encode($lista);

	/*$sql = new Sql();

	$usuarios = $sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);*/

?>