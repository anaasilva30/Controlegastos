<?php
// Inicia a sessao.
session_start();

$cpf_usuario = $_SESSION['cpf_usuario'];

/* Conectando com o banco de dados para listar registros */
$datasource = 'mysql:host=localhost;dbname=controlegastos';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);

$query = "SELECT * FROM cadastro_usuario WHERE cpf_usuario = ? ";
$stm = $db -> prepare($query);
$stm->bindParam(1, $cpf_usuario);

if ($stm -> execute()) {
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $row) {
    $cpf_usuario = $row['cpf_usuario'];
    $nome_usuario = $row['nome_usuario'];
    $telefone_usuario = $row['telefone_usuario'];
    $email_usuario = $row['email_usuario'];  
    		
  }				
} else {
  print '<p>Erro ao listar registros!</p>';
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="../images/favicon.png" type="">

  <title> Saldo Prático </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="../https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="../https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="../css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />

  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="../images/hero-bg.png" alt="">
      </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <div class='logo'>
              <img src="../images/imagemsemfundo.png" alt = "logo">
              <span>
            SaldoPrático
            </span>
            </div>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="perfil.php">Perfil <span class="sr-only">(current)</span></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
   

  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="heading_container heading_center">
      <?php
            if(isset($_GET['cadastro'])){
            ?>
                <span style='color:red; border: 1px solid red; padding: 5px;border-radius:3px; margin-bottom: 10px;'>Erro ao cadastrar! CPF duplicado. <i class="fa fa-solid fa-exclamation-triangle" aria-hidden="true"></i></span>
            <?php            
            }
        ?>
        <h2>
          Edite seus dados <span>aqui!</span>
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6 ">
        <div class="img-box">
            <img src="../images/slider-img.png" alt="ceular">
        </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
<<<<<<< HEAD
            
        <h3>Editar cadastro de usuário</h3><br>
        <div class="edita">
        <form method='POST' action='atualiza.php'>
          <label>CPF: </label>
          <input name='cpf_usuario' value='<?php print $cpf_usuario ?>' readonly><br>
          <label>Nome: </label>
          <input name='nome_usuario' value='<?php print $nome_usuario ?>'><br>
          <label>Telefone: </label>
          <input name='telefone_usuario' value='<?php print $telefone_usuario ?>'><br>
          <label>E-mail: </label>
          <input name='email_usuario' value='<?php print $email_usuario ?>'><br>
          <label>Senha: </label>
          <input type='password' name='senha_usuario'><br><br></div>
          <button type='button' onclick="window.open('perfil.php', '_self')">Cancelar</button> 
          <button type='submit'>Atualizar</button>
=======
            <h3>Editar cadastro de usuário</h3><br><br>
        <form method='POST' action='salva.php'>
        <label>Nome: </label>
        <input name='nome_usuario'><br>
        <label>CPF: </label>
        <input name='cpf_usuario'><br>
        <label>Telefone: </label>
        <input name='telefone_usuario'><br>
        <label>E-mail: </label>
        <input name='email_usuario'><br>
        <label>Senha: </label>
        <input type='password' name='senha_usuario'><br><br>
        <button type='submit'>Salvar  </button> 
        <button type='submit'>Atualizar</button>
>>>>>>> 0514b4e17705dfddba6f77ecd14ad568548aee65
</form>
<br>

<?php
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=controlegastos";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona todos os registros
    $sql = "SELECT * FROM cadastro_usuario";
    $stm = $con->prepare($sql);
    $stm->execute();

    # Percorre os registros
    foreach($stm as $row){
        $cpf = $row['cpf_usuario'];
        echo "<tr>";
        echo "<td>" . $cpf . "</td>";
        echo "<td>" . $row['cpf_usuario'] . "</td>";
        echo "<td>" . $row['nome_usuario'] . "</td>";
        echo "<td>" . $row['telefone_usuario'] . "</td>";
        echo "<td>" . $row['email_usuario'] . "</td>";
        echo "<td>" . $row['senha_usuario'] . "</td>";
        echo "<td>
                <a href='edita.php?cpf_usuario=$cpf'>Editar</a>
             </td>"; 
        echo "</tr>";
    }
?>
</table>

        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              Contato
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  saldopraticooficial@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            <p>
              Aqui você organiza sua vida financeira de maneira fácil e prática!
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto info_col">
          <div class="info_link_box">
            <h4>
              Links
            </h4>
            <div class="info_links">
              <a class="active" href="index.html">
                Home
              </a>
              <a class="" href="team.html">
                Equipe
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col ">
          <h4>
            Envie seu feedback
          </h4>
          <form action="#">
            <input type="text" placeholder="Enter email" />
            <button type="submit">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->

  <!-- footer section -->
  <section class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span>
        <a>Equipe SaldoPrático</a>
      </p>
    </div>
  </section>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>
</html>