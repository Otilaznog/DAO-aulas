<?php

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(":id"=>$id));

			if (count($results) > 0){

				$this->setData($results[0]);


			}

		}

		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario;");

		}

		public static function search($login){

			$sql =new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%"));

		}

		public function login($login, $senha){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :login AND dessenha = :senha", array(":login"=>$login, ":senha"=>$senha));

			if (count($results) > 0){

				$this->setData($results[0]);

			} else {

				throw new Exception("Login e senha inválidos.");

			}

		}

		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));	

		}

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:login,  :senha)", array(':login'=>$this-> getDeslogin(), ':senha'=>$this->getDessenha()
		));

			if (count($results) > 0){

				$this->setData($results[0]);
			
			}

		}

		public function Update($login, $senha){

			$this->setDeslogin($login);
			$this->setDessenha($senha);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :login, dessenha = :senha WHERE idusuario = :id", array(
				':login'=>$this->getDeslogin(),
				':senha'=>$this->getDessenha(),
				':id'=>$this->getIdusuario()
			));

		}

		public function __construct ($login = "", $senha = ""){

			$this->setDeslogin($login);
			$this->setDessenha($senha);

		}

		public function __toString(){

			return json_encode(array("idusuario"=>$this->getIdusuario(),
									 "deslogin"=>$this->getDeslogin(), 
									 "dessenha"=>$this->getDessenha(), 
									 "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
									));	
		}

	}

?>