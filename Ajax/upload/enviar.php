<?
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
	if(!isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	if($_POST['acao'] == 'enviar'){
		uploadFoto($_FILES['arquivo'], $_POST['novoNome']);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>
			Uploads Simultaneos [ Webtutoriais ]
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script type="text/javascript" src="../../tool/jquery.js"></script>
        <script type="text/javascript" src="../../tool/script.js"></script>
        <script>
			$(document).ready(function(e) {
                $("#btnEnviar").click(function(e) {
                    $("#acao").val('enviar');
					$("form").submit();
                });
            });
		</script>
	</head> 
	<body>
		<p>
			<img src="../../img/naruto_vs_sasuke.png" width="300" height="300" id="fotoUpada"> 
			<br>
			Fazendo Uploads de Varios arquivos ao mesmo tempo. 
			<br>
		</p>
		<form  method="post" enctype="multipart/form-data" name="form1">
        	<input type="hidden" name="acao" id="acao" />
        	<p>
                <input name="arquivo" id="arquivo" type="file" onChange='visualizarFoto("arquivo", "fotoUpada");'><br>
                <input type="text" name="novoNome" placeholder="Insira o novo nome" />
            </p>
			<!--br>
			Arquivo 2: 
			<input name="arquivo2" type="file">
			<br>
			Arquivo 3: 
			<input name="arquivo3" type="file">
			<br>
			Arquivo 4: 
			<input name="arquivo4" type="file" >
			<br>
			Arquivo 5: 
			<input name="arquivo5" type="file">
			<br>
			Arquivo 6: 
			<input name="arquivo6" type="file">
			<br>
			Arquivo 7: 
			<input name="arquivo7" type="file"-->
			<br>
			<input type="button" name="btnEnviar" id="btnEnviar" value="Enviar">
		</form>
	</body>
</html>