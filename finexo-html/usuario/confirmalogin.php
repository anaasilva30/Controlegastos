<?php
// Inicia a sess�o.
session_start();

// Pegando os dados de login enviados.
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
	
$query = "SELECT * FROM cadastro_usuario WHERE login=? AND pass=?";
$stm = $db->prepare($query);
$stm->bindParam(1, $cadastro_usuario);
$stm->bindParam(2, $senha_usuario);
$stm->execute();

if ($stm -> fetch()) {
	// Login efetuado com sucesso.

	// Armazenando usuário na sessão.
	$_SESSION['user'] = $usuario;
	
	// Redirecionando para a página inicial.
	header("location:indexg.html");
} else {
	// Caso usuário ou senha estejam incorretos.
	print "<p>Usuário e/ou Senha Inválidos!</p>";
	print "<a href='indexg.html'>Voltar</a>";
}
?>
