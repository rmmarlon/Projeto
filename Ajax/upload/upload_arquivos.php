<? 
	/*array(5) { 
		["name"]=> string(9) "59xcz.png" 
		["type"]=> string(9) "image/png" 
		["tmp_name"]=> string(27) "C:\Windows\Temp\phpD681.tmp" 
		["error"]=> int(0) 
		["size"]=> int(358154)
	}*/
	echo "<a href='enviar.php'><input type='button' value='Voltar'></a><br>";
	//Elimita o limite de tempo do php_timeout();
	set_time_limit(0);
	//Pasta para aonde deve ir os arquivos sem barra do inicio nem final
	$caminho_dos_arquivos = "Arquivos";
	$arquivo = $_FILES['arquivo1'];
	$extensao = explode('.', $arquivo['name']);
	$extensao = strtolower(end($extensao));
	echo $extensao;
	#for($i=1; $i<=7; $i++){
		//pega os nomes dos campos files (prefixo + numero crescente)
		#$id_arquivo = "arquivo".$i;
		$nome_arquivo = $arquivo['name'];
		$arq_temporario = $arquivo['tmp_name'];
		// faz o upload dos arquivos
		if(move_uploaded_file($arq_temporario, "$caminho_dos_arquivos/$nome_arquivo")){
			echo "O Arquivo <b>$nome_arquivo</b> foi concluido com sucesso<BR>";
		} else{
			echo "Erro no arquivo <b>$nome_arquivo</b><BR>";
		}
	#}
?>