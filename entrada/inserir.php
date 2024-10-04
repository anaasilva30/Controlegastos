<?php
    session_start();
    # Recebe dados do FORM
    $valor_entrada = $_POST['valor_entrada'];
    $data_entrada = $_POST['data_entrada'];
    $descricao_entrada = $_POST['descricao_entrada'];
    $tipo_entrada = $_POST['tipo_entrada'];
    $cpf_usuario = $_SESSION['cpf_usuario'];

    
    # Conecta com BD
    include_once "../db/db.php";

    # Insere no BD
    $sql = "INSERT INTO entrada_usuario (valor_entrada, data_entrada, descricao_entrada, tipo_entrada, cpf_usuario) VALUES(?,?,?,?,?)";
    $stm = $con->prepare($sql);
    $r = $stm->execute(array($valor_entrada, $data_entrada, $descricao_entrada, $tipo_entrada, $cpf_usuario));

    # Verificar inserção
    if($r){
        header("location:index.php");        
    }
    else {
        print "<p>Erro ao inserir</p>";
        print_r($stm->errorInfo());
    }
?>