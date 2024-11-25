<?php	

	/* Recebendo os dados do formulário */
	$cpf_usuario = $_POST['cpf_usuario'];
	$nome_usario = $_POST['nome_usuario'];
	$telefone_usario = $_POST['telefone_usuario'];
	$email_usario = $_POST['email_usuario'];
	$senha_usario = $_POST['senha_usuario'];

	/* Conectando com o banco de dados para cadastrar registros */
	$datasource = 'mysql:host=localhost;dbname=controlegastos';
	$user = 'root';
	$pass = 'vertrigo';
	$db = new PDO($datasource, $user, $pass);
	
	
    $foto_perfil = 'perfil.png';


	$query = "INSERT INTO cadastro_usuario (cpf_usuario, nome_usuario, telefone_usuario, email_usuario, senha_usuario, foto_perfil) VALUES(?,?,?,?,?,?)";			
	$stm = $db->prepare($query);
	$stm->bindParam(1, $cpf_usuario);
	$stm->bindParam(2, $nome_usario);
	$stm->bindParam(3, $telefone_usario);
	$stm->bindParam(4, $email_usario);
	$stm->bindParam(5, $senha_usario);
	$stm->bindParam(6, $foto_perfil);


	
	$url = "";	
	if($stm->execute()) {
		/*$mensagem1 = "Cadastro efetuado com sucesso! Faça seu login!";
		echo "<script>alert('$mensagem1');</script>";
		echo "<a href='indexg.php'>Login</a><br><br>"; 
		echo "<a href='index.php'>Voltar</a>";*/
		$url = "location: indexg.php?cadastro=true";
	}
	else {
		/*$mensagem2 = "Erro ao cadastrar usuário!";
		echo "<script>alert('$mensagem2');</script>";
		echo "<a href='index.php'>Voltar</a>";*/
		print "Erro ao cadastrar";
		$erroInfo = $stm->errorInfo();
		if (strpos($erroInfo[2], "Duplicate")!== false){
			$url = "location: cadastra.php?cadastro=false";
		}
		else {
			print "Erro ao cadastrar";
			print_r($stm->errorInfo());
		}
	}
	if (!empty($url)){
		header($url);
	}	
?>