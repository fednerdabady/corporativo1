<?php
//Iniciando as sessions e os errors
session_start();
error_reporting(0);
ini_set("display_errors", 0);
//incluindo o arquivo de conexao
include_once 'conexao.php';
//conexao ao banco com PDO
try {

    $pdo = new PDO('mysql:host=localhost;dbname=corporativo', 'rafael', '');
} catch (PDOException $e) {
    echo "Falha:" . $e->getMessage();
}
// declaraçao dos variavels
$nome       = addslashes($_POST['nome']);
$cpf        = addslashes($_POST['cpf']);
$nascimento = addslashes($_POST['nascimento']);
$email      = addslashes($_POST['email']);
$senha      = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$status 	=0;
//Tratar caractéres espeçias no campo de senha
if (stristr($_POST['senha'], "'")) {
	$_SESSION['msg'] = " 
		<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
			Caracter(') utilizado na senha é invalido!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
    header("location: cadastrar.php");
    exit();
}
//verifique si  o campo de cpf tem 11 digitos
elseif ((strlen($_POST['cpf']) < 11)) {
		$_SESSION['msg'] = " 
		<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
			CPF invalido!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
    header("location: cadastrar.php");
    exit();
	
	
}
	//campo CPF sem os pontos
	elseif (stristr($_POST['cpf'], ".")) {
		$_SESSION['msg'] = " 
		<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
			Digite  CPF  sem os pontos!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
	
    header("location: cadastrar.php");
} 
// Verifique si este CPF já existe
else {
    $result_usuario = "SELECT id FROM cadastro WHERE cpf ='$cpf' ";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
			$_SESSION['msg'] = " 
					<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
						Este CPF já esta  sendo utilizado!
					</div>
					<script >
						$('.close').click(function(event){
						$('#alert').fadeOut();
						event.preventDefault();
						});
					</script>
					";
        header("location: cadastrar.php"); 
        exit();
    }
	// Verifique si esta data de nascimento já existe
    $result_usuario = "SELECT id FROM cadastro WHERE nascimento ='$nascimento' ";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
			$_SESSION['msg'] = " 
				<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					Data de nascimento já esta  sendo utilizado!
				</div>
				<script >
					$('.close').click(function(event){
					$('#alert').fadeOut();
					event.preventDefault();
					});
				</script>
					";
        header("location: cadastrar.php");
        exit();
    }
		// Verifique si este email já existe
    $result_usuario = "SELECT id FROM cadastro WHERE email ='$email' ";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
			$_SESSION['msg'] = " 
				<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					 E-mail já esta  sendo utilizado!
				</div>
				<script >
					$('.close').click(function(event){
					$('#alert').fadeOut();
					event.preventDefault();
					});
				</script>
					";
        header("location: cadastrar.php");
        exit();
    }
}
	// Inserir dados com PDO
$pdo->query("INSERT INTO cadastro SET nome ='$nome',cpf='$cpf',nascimento='$nascimento' ,email='$email', senha='$senha',status='$status', data_cadastro=now()");
if ($pdo) {
	$_SESSION["msgcad"] = " 
		<div id='alert' class='alert alert-success' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>			
			Cadastro realizado com successo...
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
} else {
    $_SESSION["msg"] = "Erro ao cadastro ";
}
//Ultimo registro
$id = $pdo->lastInsertId();
// Ultimo registro  Criptografado 
$md5 = md5($id);
$assunto = "Confirme seu cadastro";
// Link de confirmacao de e-mail de cadastro
$link = "http://10.1.1.130/corporativo1/confirma.php?h=" . $md5;
//API  de envio e-MAIL
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.passaura.com.br';
$mail->Port = 587;
$mail->SMTPSecure = false;
$mail->SMTPAuth =true;
$mail->SMTPAutoTLS = false;
$mail->Username = 'suporte.go@passaura.com.br';
$mail->Password = 'IP#FD!0958';
$mail->setFrom('suporte.go@passaura.com.br');
$mail->addAddress($email);
$mail->Subject = "Email DP suporte";
$mensagem  = "<div style='font-family:Montserrat ;font: 10pt Verdana, Geneva, sans-serif;'>Volte para pode ter Acesso apos <strong>confirma o seu e-mail no link abaixo</strong> !</div><br/> ";
$mensagem .= "<div style='font-family:Montserrat ;font: 10pt Verdana, Geneva, sans-serif;'>Confirme seu email...</div><br/>";
$mensagem .= "<div><a href= " . $link . " style='font-family:Montserrat ;font: 10pt Verdana, Geneva, sans-serif; color:red'>clique aqui para confirma seu email</a></div><br/>";
$mensagem .= "<div style='font: 10pt Verdana, Geneva, sans-serif;'>Se voce recebeu este e-mail por engano clique excluir!</div><br/> ";
$mail->msgHTML("<html> BEM-VINDO   : {$nome} <br/> Mensagem:  {$mensagem}</html>");
$mail->AltBody = "De: {$nome}\nemail :{$email}\nMensagem : {$mensagem}";
//Session de erro ou sucesso de envio e-mail !
if ($mail->send()) {
	$_SESSION["msgcad"] = " 
		<div id='alert' class='alert alert-success' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>			
			Cadastro e Confirmação E-mail realizado com successo!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
    header("Location: index.php");
} else {
	
		$_SESSION['msg'] = " 
		<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button>
			Erro ao enviar mensagem!
		</div>
		<script >
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
}
die();


