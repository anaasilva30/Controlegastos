<?php

    # Recebe o ID
    $cpf_usuario = $_GET['cpf_usuario'];

    # Conecta com BD
    include_once "../db/db.php";

    # SQL remoção
    $sql = "DELETE FROM cadastro_usuario WHERE cpf_usuario=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($cpf_usuario));

    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }
?>