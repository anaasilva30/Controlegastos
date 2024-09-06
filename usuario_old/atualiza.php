<?php
    #Rcebendo os dados 
    $cpf_usuario = $_POST['cpf_usuario'];
    $nome_usuario = $_POST['nome_usuario'];
    $telefone_usuario = $_POST['telefone_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    
     # Conecta com BD
     include_once "../db/db.php";

     #SQL para update 
     $sql = "UPDATE cadastro SET nome_usuario=?,telefone_usuario=?, email_usuario=?, senha_usuario=?, WHERE cpf_usuario=?";
     $stm = $con->prepare($sql);
     $stm->bindParam(1, $nome_usuario);
     $stm->bindParam(2, $telefone_usuario);
     $stm->bindParam(3, $email_usuario);
     $stm->bindParam(4, $senha_usuarioe);
     $stm->bindParam(5, $cpf_usuario);

     #Executa SQL
     if ($stm->execute()){
        header('location:index.php');
     }
     else{
        print"<p>Erro ao atualizar</p>";
     }

?>