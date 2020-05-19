<?php
// inicializando a session e incluir a conexao
session_start();
error_reporting(0);
ini_set("display_errors", 0);
include_once("conexao.php");
// recebendo os dados do formulario
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if ($btnLogin) {
	
	// declaração dos variavels 
    $usuario = mysqli_escape_string($conn, $_POST['usuario']);
    $senha = mysqli_escape_string($conn, $_POST['senha']);
	$status =0;
	
	//verifique si o usuario foi confirma seu email de cadastro
	$result_usuario = "SELECT * FROM cadastro WHERE status = '$status' AND email ='$usuario'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
	
    if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
		
			$_SESSION['msg'] = " 
			<div id='alert' class='alert alert-danger' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				   <span aria-hidden='true'>&times;</span>
				</button>
				Por Favor confirme seu email! 
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
    }
		//verifique se o usuario existe !
        $result_usuario = "SELECT id,cpf, nome,nascimento,senha,status FROM cadastro WHERE email='$usuario' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if ($resultado_usuario)
		{
            $row_usuario = mysqli_fetch_assoc($resultado_usuario);
            if (password_verify($senha, $row_usuario['senha'])) {
                $_SESSION['id']         = $row_usuario['id'];
                $_SESSION['nome']       = $row_usuario['nome'];
                $_SESSION['cpf']        = $row_usuario['cpf'];
                $_SESSION['nascimento'] = $row_usuario['nascimento'];
                $_SESSION['status']     = $row_usuario['status'];
                header("Location: administrativo.php");
            } else {
				
				$_SESSION['msg'] = " 
				<div id='alert' class='alert alert-danger' style='font-family:Montserrat;font: 10pt Verdana, Geneva, sans-serif;'> 
				    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                    </button>
					Usuario ou senha incorreto
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
        }
} else {
	
		$_SESSION['msg'] = " 
				<div id='alert' class='alert alert-danger' style='font-family:Montserrat;font: 10pt Verdana, Geneva, sans-serif;'>
				    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                       <span aria-hidden='true'>&times;</span>
                    </button>
					Página não encontrada 
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