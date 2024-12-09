<?php
   session_start();
    /* Recebendo os dados do formulário */
    $cpf_usuario = $_SESSION['cpf_usuario'];
	$nome_usario = $_POST['nome_usuario'];
	$telefone_usario = $_POST['telefone_usuario'];
	$email_usario = $_POST['email_usuario'];
	$senha_usario = $_POST['senha_usuario'];

	/* Conectando com o banco de dados para cadastrar registros */
	$datasource = 'mysql:host=localhost;dbname=controlegastos';
	$user = 'root';
	$pass = 'vertrigo';
	$db = new PDO($datasource, $user, $pass);
	
	// Variável para armazenar o nome do arquivo da foto de perfil
	$foto_perfil = null;

	// Verifica se um arquivo foi enviado
	if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
    $foto_perfil = $_FILES['foto_perfil']['name'];
    $extensao = pathinfo($foto_perfil, PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

    // Verifica a extensão do arquivo
    if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
        $novoNome = uniqid(time()) . '.' . $extensao;
        $destino = 'imagens/' . $novoNome;
        
        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
            $foto_perfil = $novoNome;
        } else {
            echo "Erro ao enviar a imagem.";
            exit;
        }
    } else {
        echo "Tipo de arquivo não permitido.";
        exit;
    }
} else {
    // Define uma foto padrão se nenhuma foto for enviada
    $foto_perfil = 'perfil.png';
}


	$query = "UPDATE cadastro_usuario SET  nome_usuario=?, telefone_usuario=?, email_usuario=?, senha_usuario=?, foto_perfil=? 
                WHERE cpf_usuario=?";			
	$stm = $db->prepare($query);
	
	$stm->bindParam(1, $nome_usario);
	$stm->bindParam(2, $telefone_usario);
	$stm->bindParam(3, $email_usario);
	$stm->bindParam(4, $senha_usario);
	$stm->bindParam(5, $foto_perfil);
    $stm->bindParam(6, $cpf_usuario);


	
	$url = "";	
	if($stm->execute()) {
		/*$mensagem1 = "Cadastro efetuado com sucesso! Faça seu login!";
		echo "<script>alert('$mensagem1');</script>";
		echo "<a href='indexg.php'>Login</a><br><br>"; 
		echo "<a href='index.php'>Voltar</a>";*/
		$url = "location: perfil.php?cadastro=true";
	}
	else {
		/*$mensagem2 = "Erro ao cadastrar usuário!";
		echo "<script>alert('$mensagem2');</script>";
		echo "<a href='index.php'>Voltar</a>";*/
		print "Erro ao cadastrar";
		$erroInfo = $stm->errorInfo();
		if (strpos($erroInfo[2], "Duplicate")!== false){
			$url = "location: cadastra.php?cadastro=false";
		}
		else {
			print "Erro ao cadastrar";
			print_r($stm->errorInfo());
		}
	}
	if (!empty($url)){
		header($url);
	}	

?>