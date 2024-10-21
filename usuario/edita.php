<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de usuários</title>
</head>
<body>
<a href='index.php'>Inicio</a> 

<h3>Cadastro de usuário</h3>
<form method='POST' action='salva.php'>
    <label>Nome: </label>
    <input name='nome_usuario'><br>
    <label>CPF: </label>
    <input name='cpf_usuario'><br>
    <label>Telefone: </label>
    <input name='telefone_usuario'><br>
    <label>E-mail: </label>
    <input name='email_usuario'><br>
    <label>Senha: </label>
    <input name='senha_usuario'><br>
    <button type='submit'>Salvar</button>
</form>
<br>
<h3>Listagem de Contatos</h3>
<table border>
    <tr>
        <th>CPF</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>Senha</th>
    </tr>
<?php
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=controledegastos";
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
        echo "<td>" . $row['senha_usuario'] . "</td>";
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