<?php
// Iniciando as sessions e error
session_start();
error_reporting(0);
ini_set("display_errors", 0);
// Recebendo o dado do formulario 
if(isset($_POST['ok'])){
	//incluindo a conexao
	include_once("conexao.php");
try {
    $pdo = new PDO('mysql:host=localhost;dbname=corporativo', 'rafael', '');
} catch (PDOException $e) {
    echo "Falha:" . $e->getMessage();
}
	// Declaração de Variaveis
    $email      = addslashes($_POST['email']);
	// verifique se este email existe !
    $result_usuario = "SELECT * FROM cadastro WHERE email ='$email' ";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
     $row_usuario = mysqli_fetch_assoc($resultado_usuario);
    if (($row_usuario==0) &&($row_usuario->num_rows == 0) ) {
		$_SESSION['msg'] = " 
			<div id='alert' class='alert alert-danger' style='font-family:Montserrat;font: 10pt Verdana, Geneva, sans-serif;'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				O e-mail informado não existe!
			</div>
			<script >
				$('.close').click(function(event){
				$('#alert').fadeOut();
				event.preventDefault();
				});
			</script>";
			header("location: recuperar_senha.php");
			exit();
    }
	// Criaçao da nova senha e cripto
	 $novasenha = substr(md5(time()),0, 6);
	 $nscripto = password_hash($novasenha, PASSWORD_DEFAULT);;
 // Realizando o update no banco
$pdo->query("UPDATE cadastro SET  senha='$nscripto'  WHERE email = '$email'");
if ($pdo) {
    $_SESSION["msgcad"] = "<p style='color:red;'>senha alterado com successo...</p>";
} else {
    $_SESSION["msg"] = "Erro ao cadastro ";
}
//Enviando o email para o usuario com a sua nova senha
$assunto = " <p style='color:red;'>Sua nova senha : </p>".$novasenha;
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.passaura.com.br';
$mail->Port = 587;
$mail->SMTPSecure = false;
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = false;
$mail->Username = "suporte.go@passaura.com.br";
$mail->Password = "IP#FD!0958";
$mail->setFrom('suporte.go@passaura.com.br');
$mail->addAddress($email);
$mail->Subject = "Email DP suporte";
$mensagem = "<div style='font-family:Montserrat ;font-size:15px;'>Voltar para realizar o seu login!</div> ";
$mail->msgHTML("<html>Mensagem: {$mensagem} <br> {$assunto}</html>");
$mail->AltBody = "email:{$email}<br>Mensagem: {$mensagem}";
//Verifique sucesso ou error de envio do email
if ($mail->send()) {
		$_SESSION["msgcad"] = " 
		<div id='alert' class='alert alert-success' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>	
			 Nova senha foi gerado com successo verifique seu E-mail!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
    header("Location: index.php");
    exit();
} else {
    $_SESSION["msg"] = "Erro ao enviar mensagem. " . $mail->ErrorInfo;
}
die();

}

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
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-simbolo.png">
        <title>ACESSO RESTRITO</title>
        <!-- Bootstrap Core CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
	    <link href="css/stylo.css" rel="stylesheet">
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
         <!--Main Slider-->
        <section class="main-slider hidden-xs visible-lg visible-md" data-start-height="500" data-slide-overlay="yes" style="position:absolute">
			<div class="tp-banner-container" style="margin-top:-2px;position: absolute">
				<div class="tp-banner">
					<img src="imagens/slide1blue.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 
				</div>
			</div>
		</section> 
				<!--Formulario-->
        <div class="loginbox" style="margin-top: -40px;padding-top: 90px;width: 350px;height: 450px;position: absolute;background-color:#1a1a1a">  
                <!--Afichando messagem -->
                <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset( $_SESSION['msg']);
                    }
                    if(isset($_SESSION['msgcad'])){
                    echo $_SESSION['msgcad'];
                    unset($_SESSION['msgcad']);
                   }
                ?>
                <img src="imagens/images.png" class="avatar" style="margin-top:20px; margin-left: 110px ;position: absolute" />
					<div class="logo mb-3">
						<div class="col-md-12 text-center">
							<h3 style="font-family: Montserrat; color: whitesmoke;font: 15px Verdana, Geneva, sans-serif;">Informe seu e-mail</h3>
						</div>
					</div>
					<form  class="form-horizontal form-material" method="POST" action="" >
					
						<div class=" form-group inputWithIcon ">
							<input type="text" name="email"  class="form-control" autocomplete="off" required autofocus style="font-family: Montserrat;font-size:20px; font: 15px Verdana, Geneva, sans-serif" size="50" maxlength="50" placeholder="Email">
							<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
						</div>
						<div class="form-group text-center ">
							<input type="submit" class="btn btn-block tx-tfm" name="ok" style="font-family: Montserrat;font-size:16px;color: whitesmoke;background-color:#1e88e5 ;font: 15px Verdana, Geneva, sans-serif;" value="Ok"><br>
							<p class="text-center" style="font-family: Montserrat;font-size:15px"> <a href="index.php" id="signup" style="font-family: Montserrat;font-size:20px; color: #ef3e2e;font: 15px Verdana, Geneva, sans-serif;"> Voltar</a> </p>
						</div>
					</form>
        </div>
		
	   <div class="footer " style="color:#ef3e2e;padding:1px;font-weight:bold; text-transform:none; font: 15px Verdana, Geneva, sans-serif; font-family:Montserrat ; background-color:#1a1a1a"> 
		   <img src="imagens/logo-simbolo.png" />
		   IRMÃOS PASSAÚRA<span class="flaticon-telephone-1"></span> <span class="flaticon-email-filled-closed-envelope">  © 2019 </span>
		</div>
    </body>
</html>
