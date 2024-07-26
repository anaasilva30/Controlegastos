<?php
    # Recebe dados do FORM
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    
   

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=controlegasto";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Insere no BD
    $sql = "INSERT INTO cpf_usuario (nome_usuario, cpf_usuario, senha_usuario, telefone_usuario, email_usuario) VALUES(?,?,?,?,?)";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($nome, $senha, $cpf, $telefone, $email));

    # Verificar inserção
    if($r){
        header("location:index.php");        
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());

    }
?>