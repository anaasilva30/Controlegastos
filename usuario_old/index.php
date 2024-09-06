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
    <label>CPF: </label>
    <input name='cpf_usuario'><br>
    <label>Nome: </label>
    <input name='nome_usuario'><br>
    <label>Telefone </label>
    <input name='telefone_usuario'><br>
    <label>E-mail: </label>
    <input name='email_usuario'><br>
    <label>Senha: </label>
    <input name='senha_usuario'><br> 
    <button type='submit'>Salvar</button>
</form>
</body>
</html>