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

     if ($_FILES['foto_perfil']['name']) {
      // Se uma nova imagem foi enviada
      $foto_perfil = $_FILES['foto_perfil']['name'];
      $extensao = pathinfo($foto_perfil, PATHINFO_EXTENSION);
      $extensao = strtolower($extensao);
  
      // Verifica a extensão do arquivo
      if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
          $novoNome = uniqid(time()) . '.' . $extensao;
          $destino = 'imagens/' . $novoNome;
          
          if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $destino)) {
              $query .= ", foto_perfil = :foto_perfil";
          } else {
              echo "Erro ao enviar a imagem.";
              exit;
          }
      } else {
          echo "Tipo de arquivo não permitido.";
          exit;
      }
  }

  if (isset($novoNome)) {
   $stm->bindParam(':foto_perfil', $novoNome);
}

if ($stm->execute()) {
   header("Location: perfil.php");
} else {
   echo "<p>Erro ao atualizar</p>";
   print_r($stm->errorInfo());
}

     #Executa SQL
     if ($stm->execute()){
        header('location:perfil.php');
     }
     else{
        print"<p>Erro ao atualizar</p>";
     }

?>