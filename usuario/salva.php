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
	
	$query = "INSERT INTO cadastro_usuario (cpf_usuario, nome_usuario, telefone_usuario, email_usuario, senha_usuario) VALUES(?,?,?,?,?)";			
	$stm = $db->prepare($query);
	$stm->bindParam(1, $cpf_usuario);
	$stm->bindParam(2, $nome_usario);
	$stm->bindParam(3, $telefone_usario);
	$stm->bindParam(4, $email_usario);
	$stm->bindParam(5, $senha_usario);
		
	if($stm->execute()) {
		print "<p>Cadastro efetuado com sucesso! Faça seu login!</p>";
		print "<a href='indexg.php'>Login</a><br><br>";
		print "<a href='index.php'>Voltar</a>";
	}
	else {
		print "<p>Erro ao cadastrar usuário!</p>";
		print "<a href='index.php'>Voltar</a>";
	}	
?>