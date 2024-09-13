<html lang='pt-br'>
	<head>
		<meta charset='UTF-8'>
		<title>SaldoPrático</title>
	</head>
	<body>
		<a href='index.php'>Home</a> 
		|
		<a href='pesquisa.php'>Pesquisa</a>
		<br>
		<h2>Pesquisa de registros</h2>
		<form method="post" action="pesquisa.php">
			<label>Data: </label>
			<input type="text" name="nome" />
			<button type="submit">Pesquisar</button>
		</form>
		<h2>Listagem de Registros</h2>
		<table border>
			<tr>
				<th>Valor: </th>
				<th>Data: </th>
				<th>Tipo: </th>
                <th>Descrição: </th>
			</tr>
		<?php
			$nome = '';
			if (isset($_POST['data'])){
				$nome = $_POST['data'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=controlegastos';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM gastos_usuario WHERE data_gasto LIKE '%$data%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$valor_gasto = $row['Valor'];
					$data_gasto = $row['Data'];
					$tipo_gasto = $row['Tipo'];
					$descrição_gasto = $row['Descrição'];
	
					print "<tr>
					<td>$valor_gasto </td>
					<td>$data_gasto </td>
					<td>$tipo_gasto </td>
                    <td>$descrição_gasto</td>
					<td><a href='delete.php?id=$id_gasto'>Excluir</a> | 	
					<a href='edita.php?id=$id_gasto'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar registros!</p>';
			}

			$query = "SELECT * FROM entrada_usuario WHERE data_entrada LIKE '%$data%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$valor_entrada = $row['Valor'];
					$data_entrada = $row['Data'];
					$tipo_entrada = $row['Tipo'];
					$descrição_entrada = $row['Descrição'];
	
					print "<tr>
					<td>$valor_entrada</td>
					<td>$data_entrada</td>
					<td>$tipo_entrada</td>
                    <td>$descrição_entrada</td>
					<td><a href='delete.php?id=$id_entrada'>Excluir</a> | 	
					<a href='edita.php?id=$id_entrada'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar registros!</p>';
			}
		?>
		</table>
	</body>
</html>