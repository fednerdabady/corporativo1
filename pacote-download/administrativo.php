<?php
// Iniciando a session e error
session_start();
ob_start();
error_reporting(0);
ini_set("display_errors", 0);
//incluindo o arquivo de conexao
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Fedner Dabady">
        <meta name="author" content="Fedner Dabady">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-simbolo.png">
        <title>ACESSO RESTRITO</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="css/style.css" rel="stylesheet">
		<link href="css/stylo.css" rel="stylesheet">
    </head>
<body>
				<!--configurando o banner-->
		<section class="main-slider hidden-xs visible-lg visible-md" data-start-height="500" data-slide-overlay="yes" style="position:absolute">
			<div class="tp-banner-container" style="margin-top:50px;position: absolute">
				<div class="tp-banner">
					<img src="imagens/slide1blue.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
				</div>
			</div>
		</section>
			<!--configurando o section-->
            <section id="wrapper">
			<!--configurando o navbar-->
				<nav class="navbar navbar-inverse navbar-radius">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
						  <li><a href="#">Logado!</a></li>
						  <li><a href="#">Funcionários</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
						    <li class="active"><a href="#" style="font-family: Montserrat;font-size:10px;font: 15px Verdana, Geneva, sans-serif;"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['nome']?></a></li>
						    <li><a href="sair.php" style='font-family: Montserrat;font-size:10px;font: 15px Verdana, Geneva, sans-serif;color: red'><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
						</ul>
					</div>
				</nav>
				<!-- Fim do navbar-->
				
                <div class="col-sm-6" style="background: #1a1a1a;padding-top: 50px;margin-top: 50px; margin-right:300px;margin-left: 300px;" >
					<!-- Restrição  da pagina de accesso -->
                <?php
                    if (empty($_SESSION['id'])) {
						$_SESSION['msg'] = " 
							<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>								
								Área restrita!
							</div>
							<script >
								$('.close').click(function(event){
								$('#alert').fadeOut();
								event.preventDefault();
								});
							</script>
								";
						
                        header("Location: index.php");
						
                        }
                 ?>
				<!--Visualizar os arquivos no banco  ou na pasta -->
                <div class="login-box card" id="log" style="font-family: Montserrat; color:whitesmoke;font: 12pt Verdana, Geneva, sans-serif;">
                    <div class="card-body ">
                   <table  class="table" style="margin-right: 70px;margin-top:10px">
                    <thead style="font-family: Montserrat; color:whitesmoke;font: 12pt Verdana, Geneva, sans-serif;">
                        <tr>
                            <th>Codigo</th>
                            <th>Hollerits</th>
                        </tr>
                    </thead>
                    <tbody id="hol" style="font-family: Montserrat; color:whitesmoke;font: 12pt Verdana, Geneva, sans-serif;">
                        <?php
							if ((!empty($_SESSION['cpf'])) AND (!empty($_SESSION['nascimento'])) ) 
							{

                                $query1 = "SELECT id,nome,cpf,nascimento,email,senha FROM cadastro WHERE cpf = '{$_SESSION['cpf']}'";
                                $result1 = mysqli_query($conn, $query1);
                                $row = mysqli_fetch_array($result1);
                                $cpf = $row['cpf'];
                                $result = $conn->query("SELECT id_arquivos,nome_arquivo,acoes FROM arquivos WHERE nome_arquivo LIKE '%$cpf%' ORDER BY id_arquivos DESC LIMIT 3 ");
                                while ($arquivo = mysqli_fetch_object($result)) {
                                    echo "
										<tr>
											<td>" . $arquivo->id_arquivos . "</td>
											<td>" . $arquivo->nome_arquivo . "</td>
											<td>" . $arquivo->acoes . "</td>
											<td>
												<a href='visualizar.php?acao=download&id_arquivos=" . $arquivo->id_arquivos . "' target='_blank'><img src= 'imagens/salvar.png' style='width:100px;heigth:200px;cursor:pointer;'></a>
											</td>
										</tr>
                                        ";
                                }
                           } 
                        ?>
                    </tbody>
					<!--Visualizar os arquivos no banco ou na pasta -->
					<thead style="font-family: Montserrat; color:whitesmoke;font: 12pt Verdana, Geneva, sans-serif;">
                        <tr>
                            <th>Codigo</th>
                            <th>Rendimentos</th>
                        </tr>
                    </thead>
					<tbody style="font-family: Montserrat; color:whitesmoke;font: 12pt Verdana, Geneva, sans-serif;">
						<?php
							if ((!empty($_SESSION['cpf'])) AND (!empty($_SESSION['nascimento'])) ) 
							{

                                $query1 = "SELECT id,nome,cpf,nascimento,email,senha FROM cadastro WHERE cpf = '{$_SESSION['cpf']}'";
                                $result1 = mysqli_query($conn, $query1);
                                $row = mysqli_fetch_array($result1);
                                $cpf = $row['cpf'];
                                $result = $conn->query("SELECT id_arquivos,nome_arquivo,acoes FROM rendimentos WHERE nome_arquivo LIKE '%$cpf%' ORDER BY id_arquivos DESC LIMIT 3 ");
                                while ($arquivo = mysqli_fetch_object($result))
								{
                                    echo "
										<tr>
											<td>" . $arquivo->id_arquivos . "</td>
												<td>" . $arquivo->nome_arquivo . "</td>
												<td>" . $arquivo->acoes . "</td>
												<td>
												<a href='visualizarRenda.php?acao=download&id_arquivos=" . $arquivo->id_arquivos . "' target='_blank'><img src= 'imagens/salvar.png' style='width:100px;heigth:200px;cursor:pointer;'></a>
												</td>
										</tr>
									";
                                }
                           } 
                        ?>
					</tbody>
                </table>
                    </div>
                </div>
            </div>
    </section>
    </body>
</html>




