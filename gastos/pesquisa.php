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
					$data = $row['Data'];
					$tipo = $row['Tipo'];
					$descrição= $row['Descrição'];
	
					print "<tr>
					<td>$valor</td>
					<td>$data</td>
					<td>$tipo</td>
                    <td>$descrição</td>
					<td><a href='delete.php?id=$cpf_usuario'>Excluir</a> | 	
					<a href='edita.php?id=$cpf_usuario'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar registros!</p>';
			}
		?>
		</table>
	</body>
</html>