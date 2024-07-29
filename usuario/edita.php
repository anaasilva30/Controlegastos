<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body>
<a href='index.php'>Inicio</a> 
|
<a href='pesquisa.php'>Pesquisa</a>
<h3>Cadastro de Usuário</h3>
<form method='POST' action='inserir.php'>
    <label>Nome: </label>
    <input name='nome_aluno'><br>
    <label>CPF: </label>
    <input name='cpf_aluno'><br>
    <label>Telefone: </label>
    <input name='telefone_aluno'><br>
    <label>E-mail: </label>
    <input name='email_aluno'><br>
    <button type='submit'>Salvar</button>
</form>
<h3>Listagem de Usuários</h3>
<table border>
    <tr>
        <th>CPF</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>E-mail</th>
    </tr>
<?php
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=usuario";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona todos os registros
    $sql = "SELECT * FROM cadastro_usuario";
    $stm = $con->prepare($sql);
    $stm->execute();

    # Percorre os registros
    foreach($stm as $row){
        $cpf = $row['nome_usuariocpf_usuario'];
        echo "<tr>";
        echo "<td>" . $cpf . "</td>";
        echo "<td>" . $row['cpf_usuario'] . "</td>";
        echo "<td>" . $row['nome_usuario'] . "</td>";
        echo "<td>" . $row['telefone_usuario'] . "</td>";
        echo "<td>" . $row['email_usuario'] . "</td>";
        echo "<td>
                <a href='delete.php?cpf_usuario=$cpf'>Deletar</a>
                |
                <a href='edita.php?cpf_usuario=$cpf'>Editar</a>
             </td>"; 
        echo "</tr>";
    }
?>
</table>
</body>
</html>