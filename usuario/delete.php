<?php

    # Recebe o ID
    $cpf = $_GET['cpf'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=controlegastos";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL remoção
    $sql = "DELETE FROM cadastro_usuario WHERE cpf=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($cpf));

    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }
?>