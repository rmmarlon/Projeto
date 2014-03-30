<?
    echo '<a href="enviar.php">Voltar</a><br>';
	function uploadFoto($arquivo,$novoNome){
		#$arquivo = $_FILES['arquivo'];
		#$nomeFinal = $_POST['novoNome'];
		define('MAX_UPLOAD_SIZE','3000');
		
		$_UP['pasta'] = 'Arquivos/';
		$_UP['tamanho'] = MAX_UPLOAD_SIZE*1024;
		$_UP['extencoes'] = array('jpg', 'png','gif', 'jpeg');
		$_UP['renomeia'] = false;
		
		$_UP['erros'] [0] = 'não houve erros';
		$_UP['erros'] [1] = 'o arquivo no upload é maior do que o tamanho limite do php';
		$_UP['erros'] [2] = 'O arquivo ultrapasso o tamanho limite';
		$_UP['erros'] [3] = 'o upload foi feito parcialmente';
		$_UP['erros'] [4] = 'Não foi possível upar o arquivo';
		
		$extensao = strtolower(end(explode('.', $arquivo['name'])));
		$nomeFinal = $novoNome.'.'.$extensao;
		if(!preg_match('/^[gif|png|jpg|jpeg]{3,4}$/', $extensao)){
			echo "favor envie arquivos jpg, jpeg, png, gif";
		}
		elseif($_UP['tamanho'] < $arquivo['size']){
			echo "o arquivo enviado é muito grande";
		}
		else{
			if(move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'] . $nomeFinal)){
				echo "upload efetuado com sucesso!";
				echo '<br> <a href="'.$_UP['pasta'] . $nomeFinal.'">'. $_UP['pasta'] . $nomeFinal . '</a><br>'; 
			}
			else{
				echo 'ERRO! ' . $_UP['erros'][$arquivo['error']];
			}
		}
		$nome = $nomeFinal;
	}
?>