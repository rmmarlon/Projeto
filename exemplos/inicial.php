<?
	require_once("controleSessao.php");
	require_once("conADODBopen.php");
	require_once("tool/funcoes.php");
	require_once("classes/autoload.php");
	
	#declarando variaveis
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	#inicando consulta 
	$dao = new CadastroDAO();
	$oC = $dao->select(1, $_SESSION['codigoAutenticado']);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
        Documento sem título
        </title>
         <link href="https://lh3.ggpht.com/LbSduUVnDLpt0ttZh6OuR8y0w8Bby8WaIdY-JrBJCwZh31b8N9eHRf9233q6y_JxY5dUIQ=s147" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="personalizado/chat.css"/>
		<link rel="stylesheet" type="text/css" href="personalizado/jquery.mCustomScrollbar.css"/>
        <script src="tool/jquery.js" language="javascript"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
        <script type="text/javascript" src="tool/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="tool/funcoes.js" language="javascript"></script>
	</head>
    <body>
    	<div id="conteudo"> 
            <div class="comentarios" id="menu1">     
            	<h3 align="center">
            		Comentários
            	</h3>
                <div style="float:right; margin-right:3%">
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" id="acao" name="acao" />
                        <p>
                            <input type="text" name="idCadastro" id="idCadastro" value="<? echo $_SESSION['codigoAutenticado']; ?>" style="display:none;" />							
                        </p>
                        <div class="clear"></div>
                        <p>
                            <textarea name="assunto" rows="2" cols="40"id="assunto"></textarea>
                        </p>
                        <div class="clear"></div>
                        <div class="floatLeft">
                            <input type="button" name="btnPublicar" id="btnPublicar" value="Publicar" />
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
                <div class="clear"></div>
                <p class="demo_functions2" style="margin-bottom:0.5%">
                	<a href="#" rel="scrollto-bottom2" class="btnScroll" title="role para o fim dos comentários"><img src="img/setaBaixo.png" width="7" height="7" /></a>
                    <a href="#" rel="scrollto-top2" class="btnScroll" title="role para o inicio dos comentários"><img src="img/setaCima.png" width="7" height="7" /></a>
                </p>
                <hr />
            	<div id="aguardeLoad"></div>
                <div style="height:75%;" id="scrollCom">
					<ul>
<?
						$dao = new ComentariosDAO();
						$oLCom = $dao->select(2); 
				
						if(! is_null($oLCom)){
							foreach($oLCom as $oCom){
?>
                                <li>
                                    <h4>
                                        <? echo $oCom->getIdCadastro()->getNome(); ?> 
                                    </h4>
                                    <p title="Publicado em :<? echo $oCom->getDataCadastro()->getDMYHMS(); ?>">
                                        <? echo $oCom->getAssunto(); ?> 
                                    </p>
                                </li>
                                <hr />
<?
							}
						}
?>
	                </ul>
				</div>
            </div>
            
        </div>
      	<div id="sons">
        	<audio class="audioEnvio" controls preload="auto">
            	<source src="audio/hf3.mp3" controls></source>
            	<source src="audio/hf3.ogg" controls></source>	
               	Seu navegador não possui suporte ao audio do sistema.
         	</audio>
	  	</div>
        <div id="janelas"></div>
        <div id="modalImage" class="window">
        	<input type="button" class="close" value="Fechar" />
        	<h3></h3>
            <div id="imgCarr" style="width:100%; height:90%;"></div>
        </div>
    </body>
</html>