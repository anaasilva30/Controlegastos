<?php
// Inicia a sessao.
session_start();


			$mes = '';
			$ano = '';
			if (isset($_POST['mes'])){
				$mes = $_POST['mes'];
			}
			if (isset($_POST['ano'])){
				$ano = $_POST['ano'];
			}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" href="../images/favicon.png" type="">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

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
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../team.php">Equipe</a>
              </li>
              <?php
                if (isset($_SESSION['nome_usuario'])) {
                  $nome_usuario = $_SESSION['nome_usuario'];
                 
                  print "<li class='nav-item'><a class='nav-link login-user' href='../gastos/index.php'><i class='fa fa-dollar'></i>Gastos</a></li>";
                  print "<li class='nav-item'><a class='nav-link login-user' href='../entrada/index.php'><i class='fa fa-dollar'></i>Entrada</a></li>";
                  print "<li class='nav-item'><a class='nav-link login-user' href='../usuario/perfil.php'><i class='fa fa-user'></i>$nome_usuario</a></li>";
                  print "<li class='nav-item'><a class='nav-link' href='../usuario/logout.php'><i class='fa fa-sign-out'></i>Sair</a></li>";
                 
                } else {
                  ?>
                    <li class="nav-item"><a class="nav-link" href="usuario/indexg.php"> <i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
                  <?php                 
                }
              ?> 
            </ul>
          </div>
        </nav>
      </div>
    </header>
  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Gráfico dos <span>Gastos</span> de <?php print "$mes/$ano" ?>
        </h2>
        <p>
          Centralize suas despesas e recebimentos e facilite gestão financeira.
        </p>
        
      </div>
      <form method="post" action="graficogastos.php">
          <label>Mês: </label>
          <select name="mes">
              <option value="1">Janeiro</option>
              <option value="2">Fevereiro</option>
              <option value="3">Março</option>
              <option value="4">Abril</option>
              <option value="5">Maio</option>
              <option value="6">Junho</option>
              <option value="7">Julho</option>
              <option value="8">Agosto</option>
              <option value="9">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
          </select>
          <label>   Ano: </label>
          <select name="ano">
              <?php
              // Obter o ano atual
              $anoAtual = date('Y');

              // Loop para gerar os últimos 10 anos
              for ($i = 0; $i < 10; $i++) {
                  $ano = $anoAtual - $i;  // Subtrai i do ano atual para obter os anos anteriores
                  echo "<option value='$ano'>$ano</option>";
              }
              ?>
          </select>
          <button type="submit">  Gerar</button><br><br>
        </form>
        <div class="graficoWrap">
        <div class="heading_container heading_center">          
          <h2>
            Setor <span> Gastos</span>
          </h2>
        </div>
        <section class="about_section layout_padding">
          <div class='grafBloco1'>
    <div class="containerBarra">
      
    <div id="myPlot" style="width:400px;"></div>
        <script>
        let x = [];
      let y = [];
      for (let i = 1; i <= 31; i++) {
          x.push(i);
          y.push(0);
      }
        <?php
			
      $primeiroDiaDoMes = new DateTime("$ano-$mes-01");
      $dataInicial = $primeiroDiaDoMes->format('Y-m-d');  // Formato: YYYY-MM-DD
  
      $ultimoDiaDoMes = new DateTime("$ano-$mes-31");
      $dataFinal = $ultimoDiaDoMes->format('Y-m-d');  // Formato: YYYY-MM-DD
      				
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=controlegastos';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT 
                    *, DAY(data_gasto) AS dia
                FROM 
                    gastos_usuario
                WHERE 
                    data_gasto BETWEEN ? AND ?";
			$stm = $db -> prepare($query);
			$stm->bindParam(1, $dataInicial);
			$stm->bindParam(2, $dataFinal);

      print_r($stm);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
          $valor = $row['valor_gasto'];
					$dia = $row['dia'];	
					
          print "y[$dia] = $valor;";
				}				
			} else {
				print '<p>Erro ao listar registros!</p>';
        print_r ($stm->errorInfo());
			}
?>
        

      // Dados para o gráfico de linhas
      var dados = [{
            x: x,  // Eixo X (Mês)
            y: y,             // Eixo Y (Vendas)
            type: 'scatter',                         // Tipo de gráfico (scatter = gráfico de linhas)
            mode: 'lines+markers',                   // Mostrar linhas e marcadores (pontos)
            name: 'Gastos'                           // Nome da série
        }];

        // Layout do gráfico (título, labels dos eixos, etc.)
        var layout = {
            title: 'Gastos do Mês',       // Título do gráfico
            xaxis: {
                title: 'Dias'                        // Título do eixo X
            },
            yaxis: {
                title: 'Valores'                     // Título do eixo Y
            }
        };

        // Criar o gráfico em um elemento com id 'grafico'
        Plotly.newPlot('myPlot', dados, layout);
   
        
        
    </script>
    </div>
    <div class="graficopizza">
    <div id="myPlot2" style="width:400px;"></div>

    
    </div>
       
    </div>
    
    </div>
    
        </div>
        
      </div>
        <div class='grafBloco2'>


      </div>
  </section>

  <!-- end about section -->

  <section class="info_section layout_padding2">
    <div class="containergastos">
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
                  saldopraticoficial@gmail.com
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
              <a class="active" href="index.php">
                Home
              </a>
              <a class="" href="team.php">
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
</html>
