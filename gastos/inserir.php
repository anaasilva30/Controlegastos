<?php
    $cpf_usuario = "123";


    # Recebe dados do FORM
    $id_gasto= $_POST['id_gasto'];
    $valor_gasto = $_POST['valor_gasto'];
    $data_gasto = $_POST['data_gasto'];
    $descricao_gasto = $_POST['descricao_gasto'];
    $tipo_gasto = $_POST['tipo_gasto'];
    $cpf_usuario= $_POST['cpf_usuario'];
    
    # Conecta com BD
    include_once "../db/db.php";

    # Insere no BD
    $sql = "INSERT INTO gastos_usuario (id_gasto, valor_gasto, data_gasto, descricao_gasto, tipo_gasto, cpf_usuario) VALUES(?,?,?,?,?,?)";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($id_gasto, $valor_gasto, $data_gasto, $descricao_gasto, $tipo_gasto, $cpf_usuario));

    # Verificar inserção
    if($r){
        header("location:index.php");        
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());
    }
?>