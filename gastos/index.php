<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
<body>
    <div class="container">
    <nav id="menu">
        <div class="logo">
            <span>Controle de Gastos</span>
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="sobre.html">Sobre</a></li>
        </ul>
    </nav>
    </div>
    <a href='pesquisa.php'>Pesquisa</a>
    <h3>Cadastro de usuário</h3>
    <form method='POST' action='inserir.php'>
    <label>Id: </label>
    <input name='id_gasto'><br>
    <label>Valor do gasto: </label>
    <input name='valor_gasto '><br>
    <label>Data do gasto: </label>
    <input name='data_gasto'><br>
    <label>Descrição do gasto: </label>
    <input name='descricao_gasto'><br>
    <label>Tipo do gasto: </label>
    <input name='tipo_gasto'><br> 
    <label>CPF: </label>
    <input name='cpf_usuario'><br> 
    <button type='submit'>Salvar</button>
</form>
</body>
</html>