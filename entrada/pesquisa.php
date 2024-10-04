<?php
// Inicia a sessao.
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="../images/favicon.png" type="">

  <title> Controle de Gastos </title>

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
            <span>
            SaldoPrático
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="team.php">Equipe</a>
              </li> 
   

              <?php
                if (isset($_SESSION['nome_usuario'])) {
                  $nome_usuario = $_SESSION['nome_usuario'];
                 
                  print "<li class='nav-item'><a class='nav-link login-user' href='gastos/index.php'><i class='fa fa-dollar'></i>Gastos</a></li>";
                  print "<li class='nav-item'><a class='nav-link login-user' href='entrada/index.php'><i class='fa fa-dollar'></i>Entrada</a></li>";
                  print "<li class='nav-item'><a class='nav-link login-user' href='usuario/perfil.php'><i class='fa fa-user'></i>$nome_usuario</a></li>";
                  print "<li class='nav-item'><a class='nav-link' href='usuario/logout.php'><i class='fa fa-sign-out'></i>Sair</a></li>";
                 
                } else {
                  ?>
                    <li class="nav-item"><a class="nav-link" href="usuario/indexg.php"> <i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
                  <?php                 
                }
              ?> 
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </ul>
          </div>
        </nav>
			</div>
			</header>
   
			<section class="about_section layout_padding">
    <div class="container  ">
      <div class="heading_container heading_center">
		
		<h2>Pesquisa de registros</h2>
		<form method="post" action="pesquisa.php">
			<label>Data Inicial: </label>
			<input type="date" name="data1" />
			<label>Data Final: </label>
			<input type="date" name="data2" />
			<button type="submit">Pesquisar</button>
		</form>
		<h2>Listagem de Registros</h2>
		<table border>
			<tr>
				<th>Valor: </th>
				<th>Data: </th>
				<th>Tipo: </th>
				<th>Setor: </th>
        <th>Descrição: </th>
			</tr>
		<?php
			$data1 = '';
			$data2 = '';
			if (isset($_POST['data1'])){
				$data1 = $_POST['data1'];
			}
			if (isset($_POST['data2'])){
				$data2 = $_POST['data2'];
			}
				
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=controlegastos';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM entrada_usuario WHERE data_entrada BETWEEN ? AND ?";
			$stm = $db -> prepare($query);
			$stm->bindParam(1, $data1);
			$stm->bindParam(2, $data2);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$valor_entrada = $row['Valor'];
					$data_entrada = $row['Data'];
					$tipo_entrada = $row['Tipo'];
					$setor_entrada = $row['Setor'];
					$descricao_entrada = $row['Descrição'];
	
					print "<tr>
					<td>$valor_entrada</td>
					<td>$data_entrada</td>
					<td>$tipo_entrada</td>
					<td>$setor_entrada</td>
                    <td>$descricao_entrada</td>
					<td><a href='delete.php?id=$data_entrada'>Excluir</a> | 	
					<a href='edita.php?id=$data_entrada'>Editar</a></td>
					</tr>";								
				}				
			} else {
				print '<p>Erro ao listar registros!</p>';
			}
			
		?>
		</table>
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
        &copy; <span id="displayYear">2024</span>
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