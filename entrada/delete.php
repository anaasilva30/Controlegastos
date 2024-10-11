<?php

    # Recebe o ID
    $id_entrada = $_GET['id_entrada'];

    # Conecta com BD
    include_once "../db/db.php";

    # SQL remoção
    $sql = "DELETE FROM entrada_usuario WHERE id_entrada=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($id_entrada));

    if($stm){
        header("location:pesquisaentrada.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }

?>