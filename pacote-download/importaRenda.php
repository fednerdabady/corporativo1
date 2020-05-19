<?php 
	//Salvando os arquivos de renda na pasta e no banco de dados
	$conn = new mysqli("localhost","rafael","","corporativo");
	mysqli_set_charset( $conn,"utf8");
	$arquivo    = $_FILES["file"]["tmp_name"];
	$nome       = $_FILES["file"]["name"];
	$tamanho    = $_FILES["file"]["size"];
	$fp = fopen($arquivo, "rb"); //Abro o arquivo que esta no $tmp
	$documento = fread($fp,$tamanho); // Lei o binario do arquivo
				fclose($fp); // fecho o arquivo
	$dados = bin2hex($documento);
	$caminho = "renda/".$nome;
	move_uploaded_file($arquivo, $caminho);
	$sql = "INSERT INTO rendimentos (nome_arquivo,tamanho,conteudo,data) VALUES ('$nome','$tamanho','$dados',now())";
	$result = $conn->query($sql)or die(mysqli_errno());

 