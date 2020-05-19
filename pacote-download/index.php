<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Fedner Dabady">
        <meta name="author" content="Fedner Dabady">
        <title>Acesso Restrito</title>
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-simbolo.png">
        <link href="css/stylo.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom CSS --> 
        <link href="css/style.css" rel="stylesheet">
		 <!-- Campo input com icon --> 
        <style>
            .inputWithIcon  input[type=text]{
                padding-left: 40px;
            }
            .inputWithIcon{
                position: relative;
            }
            .inputWithIcon i{
                position: absolute;
                left: 0;
                top: 8px;
            }
            .inputWithIcon  input[type=password]{
                padding-left: 40px;
            }
			
		</style>
		
    </head>
    <body>
         <!--Configurando o Banner -->
		<section class="main-slider hidden-xs visible-lg visible-md" data-start-height="500" data-slide-overlay="yes" style="position:absolute">
			<div class="tp-banner-container" style="margin-top:-2px;position: absolute">
				<div class="tp-banner">
					<img src="imagens/slide1blue.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
				</div>
			</div>
		</section>
        <div class="loginbox" style="margin-top: -40px;padding-top: 90px;width: 350px;height: 450px;position: absolute ;background-color: #1a1a1a">  
                <!--afichando  os mensagems dos sessions-->
			<?php
				
				if (isset($_SESSION['msg'])) {
				   echo $_SESSION['msg'];
					unset( $_SESSION['msg']);
					session_destroy();
				}
				
				if(isset($_SESSION['msgcad'])){
				echo $_SESSION['msgcad'];
				unset($_SESSION['msgcad']);
			   }
			   
			?>
				<!--configurando o formulario-->
                <img src="imagens/images.png" class="avatar" style="margin-top:20px; margin-left: 110px ;position: absolute" />
                <form class="form-horizontal form-material" method="POST" action="login.php"  style="font-family: Montserrat;font-size:20px; color:whitesmoke">
				  
                    <div class=" form-group inputWithIcon ">
                        <input type="text" name="usuario" autocomplete="off" id="usuario" class="form-control"  style="font-family: Montserrat ;font: 15px Verdana, Geneva, sans-serif; color:whitesmoke"required autofocus size="30" maxlength="30" placeholder="Email">
                         <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                    <div class="form-group inputWithIcon">
                        <input type="password" name="senha" class="form-control" required="" style="font-family: Montserrat ;font: 15px Verdana, Geneva, sans-serif;color:whitesmoke"  size="30" maxlength="30"placeholder="Senha">
                         <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-block tx-tfm" name="btnLogin" style="font-family: Montserrat;font-size:16px;color: whitesmoke;background-color: #1e88e5;font: 15px Verdana, Geneva, sans-serif " value="Acessar"><hr>
                        <p class="text-center" style="font-family: Montserrat;font-size:20px;color:#1e88e5;font: 15px Verdana, Geneva, sans-serif">Esqueceu sua senha? <a href="recuperar_senha.php" id="signup" style='font-family: Montserrat;font-size:10px;font: 15px Verdana, Geneva, sans-serif;color: #ef3e2e'>Clique aqui </a> </p>
                        <p class="text-center" style="font-family: Montserrat;font-size:15px"> <a href="cadastrar.php" id="signup" style='font-family: Montserrat;font-size:10px;font: 15px Verdana, Geneva, sans-serif;color: #ef3e2e'>Cadastre-se </a> </p>
                    </div>
                </form>
            </div>
			<!--configurando o footer-->
           <div class="footer " style="color:#ef3e2e; padding:1px;font-weight:bold; text-transform:none; font: 15px Verdana, Geneva, sans-serif; font-family:Montserrat ; background-color: #1a1a1a"> 
               <img src="imagens/logo-simbolo.png" />
               IRMÃOS PASSAÚRA<span class="flaticon-telephone-1"></span> <span class="flaticon-email-filled-closed-envelope">  © 2019 </span>
            </div>
    </body>
</html>

