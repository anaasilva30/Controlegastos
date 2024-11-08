<?php
    #Rcebendo os dados 
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

     # Conecta com BD
     $ds = "mysql:host=localhost;dbname=agenda";
     $con = new PDO($ds, 'root', 'vertrigo');

     #SQL para update 
     $sql = "UPDATE contato SET nome=?, email=?, telefone=? WHERE contatoid=?";
     $stm = $con->prepare($sql);
     $stm->bindParam(1, $nome);
     $stm->bindParam(2, $email);
     $stm->bindParam(3, $telefone);
     $stm->bindParam(4, $id);

     #Executa SQL
     if ($stm->execute()){
        header('location:perfil.php');
     }
     else{
        print"<p>Erro ao atualizar</p>";
     }

?>