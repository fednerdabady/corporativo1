<?php
//Destruir os variaveis global
session_start();
unset($_SESSION['id'], $_SESSION['nome'],$_SESSION['cpf'],$_SESSION['nascimento'],$_SESSION['email'],$_SESSION['senha'],$_SESSION['status']);
// Affichando messagem
$_SESSION["msgcad"] = " 
		<div id='alert' class='alert alert-success' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
			Deslogado com sucesso!
		</div>
		<script>
			$('.close').click(function(event){
			$('#alert').fadeOut();
			event.preventDefault();
			});
		</script>
			";
header("Location: index.php");

?>