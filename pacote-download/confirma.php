<?php
//Iniciando a session e verificando a conexao
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=corporativo', 'rafael', '');
} catch (PDOException $e) {
    echo "Falha:" . $e->getMessage();
}
//Recebendo o ultimo ID via GET
$h = $_GET['h'];
if (!empty($h)) {
	
    $pdo->query("UPDATE cadastro SET status='1' WHERE MD5(id)='$h'");
	$_SESSION["msgcad"] = " 
		<div id='alert' class='alert alert-success' style='font-family:Montserrat; font: 10pt Verdana, Geneva, sans-serif;'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
			Confirmação E-mail registrado com successo!
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
		</script>
			";
	         header("Location: cadastrar.php");
        }

