<?php
//inicando a session
session_start();
ob_start();
//erro
error_reporting(0);
ini_set("display_errors", 0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Fedner Dabady">
        <meta name="author" content="Fedner Dabady">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-simbolo.png">
        <title>Cadastro</title>
        <!-- Bootstrap Core CSS -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
		<link href="css/stylo.css" rel="stylesheet">
        <link href="css/colors/blue.css" id="theme" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
       <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	   <!-- mascara  no campo de data -->
       <script language="javascript" type="text/javascript">
           function mascaraData( campo, e )
            {
				var kC = (document.all) ? event.keyCode : e.keyCode;
				var data = campo.value;

				if( kC!=8 && kC!=46 )
				{
					if( data.length==2 )
					{
							campo.value = data += '/';
					}
					else if( data.length==5 )
					{
							campo.value = data += '/';
					}
					else
								campo.value = data;
				}
            }
            <!-- validar o campo senha -->
            function validar(){
                var senha      = loginform.senha.value;
                var conf_senha = loginform.conf_senha.value;
                
                if(senha == "" || senha.length <= 5){
                    alert('Preencha o campo senha com minimo 6 caracteres');
                    loginform.senha.focus();
                    return false;
                }
                
                if(conf_senha == "" || conf_senha.length <= 5){
                    alert('Preencha o campo senha com minimo 6 caracteres');
                    loginform.conf_senha.focus();
                    return false;
                }
                
                if(senha != conf_senha ){
                    alert('Senhas diferentes');
                    loginform.senha.focus();
                    return false;
                }
            }
     </script>
    </head>
    
    <body>
			<!--configurando o banner-container-->
        <section class="main-slider hidden-xs visible-lg visible-md" data-start-height="500" data-slide-overlay="yes" style="position:absolute">
			<div class="tp-banner-container" style="margin-top:-2px;position: absolute">
				<div class="tp-banner">
						<img src="imagens/slide1blue.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
				</div>
			</div>
		</section>
        
        <div class="loginbox" style="margin-top: -40px;padding-top: 90px;width: 390px;height: 500px;position: absolute;background-color:#1a1a1a">  
			<!-- afichando os sessions -->
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msgcad'])) {
                echo $_SESSION['msgcad'];
                unset($_SESSION['msgcad']);
            } 
            ?>
					<!-- Caregando a image -->
            <img src="imagens/images.png" class="avatar" style="margin-top:20px; margin-left: 130px ;position: absolute" />
            <form class="form-horizontal form-material"  name="loginform" id="loginform"  method="POST" action="proc_cad.php" style="padding-top:-1px;margin-top:-2px">
                 
				 <!-- formulario de cadastro-->
                <div class="form-group">
                    <input class="form-control" type="text" name="nome" autocomplete="off" required="" style="font-family: Montserrat; margin: 
					;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;"  maxlength="50"autofocus="" placeholder=" Nome Completo"><br>
 
                    <input class="form-control" type="text" name="cpf"  required="" autocomplete="off" style="font-family: Montserrat; margin: 
					1px;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;" maxlength="11" placeholder=" CPF"><br>

                    <input type="text" class="form-control" name="nascimento"  
                        required=""  maxlength="10" placeholder=" Data Nascimento" autocomplete="off" maxlength="10" style="font-family: Montserrat; margin: 
                       1px;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;"
                           onkeypress="mascaraData(this, event)" /><br>
                    <input class="form-control" type="email" name="email" required="" autocomplete="off" maxlength="50"style="font-family: Montserrat; margin: 
						1px;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;" placeholder="E-mail"><br>

                    <input class="form-control" type="password" name="senha" required="" maxlength="11" style="font-family: Montserrat; margin: 
						1px;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;" placeholder="Senha"><br>

                    <input class="form-control" type="password"  name="conf_senha" maxlength="11" required="" style="font-family: Montserrat; margin: 
						1px;font-size:20px;color:whitesmoke;font: 15px Verdana, Geneva, sans-serif;" placeholder=" Confirme sua Senha">
                </div>
				<!--button-->
                <div class="form-group">
                    <input class="btn btn-block tx-tfm"  
                           style="font-family: Montserrat;font-size:16px;color:whitesmoke;background-color: #1e88e5;font: 15px Verdana, Geneva, sans-serif;" type="submit" name="btnCadUsuario" 
                           value="Cadastrar" onclick="return validar()">
                    <p class="text-center" style="font-family: Montserrat;font-size:20px ;font-weight:inherit; text-transform:none;"> <a href="index.php" style="color:#ef3e2e;font: 15px Verdana, Geneva, sans-serif;">Voltar </a></p>
                </div>
            </form>
        </div>
		<!--footer-->
        <div class="footer " style="color:#ef3e2e; padding:1px;font-weight:bold; text-transform:none; font: 15px Verdana, Geneva, sans-serif; font-family:Montserrat ; background-color: #1a1a1a"> 
            <img src="imagens/logo-simbolo.png" />
            IRMÃOS PASSAÚRA  © 2019 
        </div>
		
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <script src="js/sidebarmenu.js"></script>
        <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="js/custom.min.js"></script>

        <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    </body>

</html>
