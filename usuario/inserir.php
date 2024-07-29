<?php
    # Recebe dados do FORM
    $cpf_usuario = $_POST['cpf_usuario'];
    $nome_usuario = $_POST['nome_usuario'];
    $telefone_usuario = $_POST['telefone_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    
    # Conecta com BD
    include_once "../db/db.php";

    # Insere no BD
    $sql = "INSERT INTO cpf_usuario (cpf_usuario, nome_usuario, telefone_usuario, email_usuario, senha_usuario) VALUES(?,?,?,?,?)";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($cpf_usuario, $nome_usuario, $telefone_usuario,  $email_usuario, $senha_usuario));

    # Verificar inserção
    if($r){
        header("location:index.php");        
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());
    }
?>