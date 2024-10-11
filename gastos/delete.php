<?php

    # Recebe o ID
    $id_gasto = $_GET['id_gasto'];

    # Conecta com BD
    include_once "../db/db.php";

    # SQL remoção
    $sql = "DELETE FROM gastos_usuario WHERE id_gasto=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($id_gasto));

    if($stm){
        header("location:pesquisa.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }

?>