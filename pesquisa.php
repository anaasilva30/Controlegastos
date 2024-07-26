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
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>CPF</th>
			</tr>
		<?php
			$nome = '';
			if (isset($_POST['nome'])){
				$nome = $_POST['nome'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=controlegasto';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM cpf_usuario WHERE cpf LIKE '%$cpf%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$cpf_usuario= $row['CPF'];
					$nome_usuario = $row['nome'];
					$email_usuario = $row['email'];
					$telefone_usuario= $row['telefone'];
	
					print "<tr>
					<td>$nome</td>
                    <td>$cpf</td>
					<td>$email</td>
					<td>$telefone</td>
					<td><a href='delete.php?id=$id_usuario'>Excluir</a> | 	
					<a href='edita.php?id=$id_usuario'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao encontrar usuário!</p>';
			}
		?>
		</table>
	</body>
</html>