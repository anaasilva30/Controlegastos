<?php
    #Rcebendo os dados 
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

     # Conecta com BD
     $ds = "mysql:host=localhost;dbname=controlegastos";
     $con = new PDO($ds, 'root', 'vertrigo');

     #SQL para update 
     $sql = "UPDATE cadastro SET nome=?, email=?, telefone=?, senha=?, WHERE cadastroid=?";
     $stm = $con->prepare($sql);
     $stm->bindParam(1, $nome);
     $stm->bindParam(2, $senha);
     $stm->bindParam(3, $email);
     $stm->bindParam(4, $telefone);
     $stm->bindParam(5, $cpf);

     #Executa SQL
     if ($stm->execute()){
        header('location:index.php');
     }
     else{
        print"<p>Erro ao atualizar</p>";
     }

?>