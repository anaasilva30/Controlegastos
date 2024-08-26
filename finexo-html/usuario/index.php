<?php
//Inclui o arquivo de verificação de sessão.
include_once("verifica.php");
?>
<html><head><title>Página Exemplo</title></head>
<body>
	<?php 
		$cadastro_usuario = $_SESSION['user'];
		print "<p>Bem vindo, $cadastro_usuario!"; 
	?>
	<a href='logout.php'>Sair</a>
	<h3>Exemplo de Aplica��o Utilizando Login</h3>
	<p>Este texto s� pode ser visualizado por usu�rios 
		que est�o logados na aplica��o.</p>	
</body>	
</html>