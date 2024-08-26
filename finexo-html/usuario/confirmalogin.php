<?php
// Inicia a sess�o.
session_start();

// Pegando os dados de login enviados.
$cpf_usuario = $_POST['cpf_usuario'];
$senha_usario = $_POST['senha_usuario'];

/* Conectando com o banco de dados para cadastrar registros */
$datasource = 'mysql:host=localhost;dbname=controlegastos';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);
	
$query = "SELECT * FROM cadastro_usuario WHERE cpf_usuario=? AND senha_usuario=?";
$stm = $db->prepare($query);
$stm->bindParam(1, $cpf_usuario);
$stm->bindParam(2, $senha_usuario);
$stm->execute();

if ($stm -> fetch()) {
	// Login efetuado com sucesso.

	// Armazenando usuário na sessão.
	$_SESSION['cpf_usuario'] = $cadastro_usuario;
	
	// Redirecionando para a página inicial.
	header("location:index.html");
} else {
	// Caso usuário ou senha estejam incorretos.
	print "<p>Usuário e/ou Senha Inválidos!</p>";
	print "<a href='indexg.html'>Voltar</a>";
}
?>
