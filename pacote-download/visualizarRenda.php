<?php
	//conexao ao banco de dados
    $conn = new mysqli("localhost","rafael","","corporativo");
	mysqli_set_charset( $conn,"utf8");
	// declaração dos variaveis
   $id_arquivos = $_GET["id_arquivos"];
   $acao        = $_GET['acao'];
	// Selecionando os dados no banco
   $result = $conn->query("SELECT id_arquivos,nome_arquivo,acoes FROM rendimentos WHERE id_arquivos=$id_arquivos");
	//guardando os arquivos na pasta
   $query = mysqli_fetch_object($result);
   $pasta = "renda/".$query->nome_arquivo;
   $dados = converte($query->conteudo);
	// download os arquivos
   if(mysqli_num_rows($result) > 0)
    {
        if($acao == "download")
        {
             if(file_exists($pasta))
            {

                 header('Content-Type: application/pdf');
                 header('Content-Disposition: attachment;filename='.$query->nome_arquivo);   
                 readfile($pasta);

             }else
            {

                 header('Pragma: public');
                 header('Expires: 0');
                 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                 header('Content-Type: application/pdf');
                 header('Content-Disposition: attachment;filename='.$query->nome_arquivo);   
                 header('Content-Transfer-Encoding: binary');
                 header('Content-Length: '.strlen($dados));

                 print($dados);

             } 
        }        
   }
   //converte em hxdec
   function converte($str){
   	$bin = "" ;
   	$i = 0;
   	do{
   		$bin .= chr(hexdec($str{$i}.$str{($i+1)}));
   		$i +=2;

   	}while ($i < strlen($str)); 
   		return $bin;

   }

