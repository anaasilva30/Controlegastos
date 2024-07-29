<html lang='pt-br'>
	<head>
		<meta charset='UTF-8'>
		<title>Controle de Gastos</title>
	</head>
	<body>
		<a href='index.php'>Inicio</a> 
		|
		<a href='pesquisa.php'>Pesquisa</a>
		<br>
		<h2>Pesquisa de Usuário</h2>
		<form method="post" action="pesquisa.php">
			<label>CPF: </label>
			<input type="text" name="nome" />
			<button type="submit">Pesquisar</button>
		</form>
		<h2>Listagem de usuários</h2>
		<table border>
			<tr>
				<th>CPF</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Email</th>
				<th>Senha</th>
			</tr>
		<?php
			$nome_usuario = '';
			if (isset($_POST['nome_usuario'])){
				$nome_usuario = $_POST['nome_usuario'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=controlegastos';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM cpf_usuario WHERE cpf LIKE '%$cpf%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$cpf_usuario= $row['cpf_usuario'];
					$nome_usuario = $row['nome_usuario'];
					$telefone_usuario= $row['telefone_usuario'];
					$email_usuario = $row['email_usuario'];
					$senha_usuario = $row['senha_usuario'];
	
					print "<tr>
					<td>$cpf_usuario</td>
                    <td>$nome_usuario</td>
					<td>$telefone_usuario</td>
					<td>$email_usuario</td>
					<td>$senha_usuario</td>
					<td><a href='delete.php?id=$cpf_usuario'>Excluir</a> | 	
					<a href='edita.php?id=$cpf_usuario'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao encontrar usuário!</p>';
			}
		?>
		</table>
	</body>
</html>