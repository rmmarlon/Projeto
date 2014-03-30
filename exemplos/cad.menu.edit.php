<?
	#require_once "personalizado/controleSessao.php";
	/*
		Autor : Leandro Ferreira Marcelli
		Data : 14/12/2012
		
		Arquivo: cad.menu.edit.php
		Descrição: Tela principal do cadastro da tabela menu
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		14/12/2012  Leandro F Marcelli  Definicão inicial
	*/
	#require_once "personalizado/config.php";
	require_once "tool/funcoes.php";
	require_once "conADODBopen.php";
	require_once "classes/autoload.php";
	##DESCLARACOES DE VARIAVEIS
	if(! isset($_POST["act"])){
		$_POST["act"] = NULL;
	}
	if(! isset($_POST["descricaoPermissaoEspecial"])){
		$_POST["descricaoPermissaoEspecial"] = NULL;
	}
	if($_POST["act"] == ""){
		require_once("adm.validaAutenticacao.edit.php");	
	}
	if(! isset($_POST['processamento'])){
		$_POST['processamento'] = NULL;	
	}
	##FIM DECLARACOES
	if ($_POST['processamento'] == "ok"){

		$obj = new Menu($_POST['idMenu'],
							 $_POST['idMenuPai'],
							 $_POST['descricao'],
							 $_POST['pagina'],
							 $_POST['inConsulta'],
							 $_POST['inAltera'],
							 $_POST['inAdiciona'],
							 $_POST['inVisualiza'],
							 $_POST['inPermissaoEspecial'],
							 $_POST['descricaoPermissaoEspecial']);
		
		$dao = new MenuDAO();
		require_once "personalizado/inc.cud.php";
		require_once "personalizado/alert.php";
		if($_POST['act'] == 'add'){
			$_POST['idMenu'] = $obj->getCodigo();
			$retornaPagina = false;
		}
		unset($obj);
		unset($dao);
		if($retornaPagina){
			header("Location: cad.menu.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			<? echo TITULO; ?>
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="personalizado/estilo.css" rel="stylesheet" type="text/css" />
		<link href="personalizado/dataTable.css" rel="stylesheet" type="text/css" />
      <style>
			#modalMF{
				background-color:#FFF;
				width:300px;
				height:250px;	
			}
			#modalMP{
				background-color:#FFF;
				width:400px;
				height:350px;
			}
			a{
				text-decoration:none;
			}
			.texto{
				width:250px;
				font-family:Calibri;
				font-size:14px;
				font-weight:bold;
				color:#234725;
				float:left;
			}
			.textoB{
				width:240px;
				font-family:Calibri;
				font-size:14px;
				font-weight:bold;
				padding-left:10px;
				color:#234725;
				float:left;
			}
			.textoC{
				width:230px;
				font-family:Calibri;
				font-size:14px;
				font-weight:bold;
				padding-left:20px;
				color:#234725;
				float:left;
			}
			.textoD{
				width:220px;
				font-family:Calibri;
				font-size:14px;
				font-weight:bold;
				padding-left:30px;
				color:#234725;
				float:left;
			}
			.botao{
				width:60px;
				text-align:left;
				float:left;
			}
			#idMenuPai{
				background-color:#EEE;
				border:none;
			}
		</style>
		<script charset="UTF-8" language="javascript" src="tool/jquery.js"></script>
      <script charset="UTF-8" language="javascript" src="tool/dataTable.js"></script>
		<script charset="UTF-8" language="javascript" src="tool/script.js"></script>
		<script charset="UTF-8" language="javascript">
			<!--
			$(document).ready(function(e) {
				if($(".inPermissaoEspecial:checked").val() == 0){
					$("#descricaoPermissaoEspecial").attr("disabled","disabled");
				} else {
					$("#descricaoPermissaoEspecial").removeAttr("disabled");
				}
				$(".inPermissaoEspecial").click(function(e) {
               if($(".inPermissaoEspecial:checked").val() == 0){
						$("#descricaoPermissaoEspecial").attr("disabled","disabled");
					} else {
						$("#descricaoPermissaoEspecial").removeAttr("disabled");
					}
            });
				$("#btnVoltar").click(function(e) {
               var novaURL = "cad.menu.php";
					$(window.document.location).attr('href',novaURL);
            });
				
				$("#btn").click(function(e) {
					if($("#act").val() != "del"){
						if ($("#descricao").val() == ""){
							jAlert("Você deve informar um(a) descricao!!!");
						} else {
							$("form").submit();	
						}
					}
				});
				
				$("#menuFilho").DataTable({
					"bAutoWidth": false,
					"bProcessing": false,
					"aoColumnDefs" : [
						{ "sWidth": "40px", "aTargets": [0]},
						{ "sWidth": "200px", "aTargets": [1]},
						{ "sWidth": "50px", "aTargets": [2]}
					],
					/*Tamanho da altura so scroll*/
					"sScrollY": "235px",
					/*Auto ajusta a altura da tabela no caso de ser menor*/
					"bScrollCollapse": true,
					"bSort" : false,
					"bPaginate" : false,
					"bLengthChange" : false,
					"bFilter" : true,
					"bInfo" : false,
					"bDestroy" : true,
					"sAjaxSource": "/json/jsonMenuFilho.php?idMenu="+ $(".idMenu").val()
				});
				
				$(".inExcluir").live("click",function(){
					$.ajax({
						method: "post",
						url:"xml/xmlMenuFilho.excluir.php",
						data: {idMenuFilho: $(this).attr("idCodigo")},
						success: function(xml){
							if($(xml).find('Codigo').text() == ''){
								jAlert("Falha ao excluir o menu filho!!!");
							}
							$("#menuFilho").DataTable({
								"bAutoWidth": false,
								"bProcessing": false,
								"aoColumnDefs" : [
									{ "sWidth": "40px", "aTargets": [0]},
									{ "sWidth": "200px", "aTargets": [1]},
									{ "sWidth": "50px", "aTargets": [2]}
								],
								/*Tamanho da altura so scroll*/
								"sScrollY": "235px",
								/*Auto ajusta a altura da tabela no caso de ser menor*/
								"bScrollCollapse": true,
								"bSort" : false,
								"bPaginate" : false,
								"bLengthChange" : false,
								"bFilter" : true,
								"bInfo" : false,
								"bDestroy" : true,
								"sAjaxSource": "/json/jsonMenuFilho.php?idMenu="+ $(".idMenu").val()
							});
						},
						error: function(){
							alert("Ocorreu um erro inesperado durante o processamento!!!");
						}
					});
				});
				$(".cadastrarMenuFilho").live("click",function(){
					$.ajax({
						method: "post",
						url:"xml/xmlMenuFilho.add.php",
						data: {descricaoMenuFilho: $("#descricaoMenuFilho").val(), idMenu: $(".idMenu").val()},
						success: function(xml){
							if($(xml).find('Codigo').text() == ''){
								jAlert("Falha ao cadastrar o menu filho!!!");
							} else {
								$("#descricaoMenuFilho").val();
							}
							
							$("#menuFilho").DataTable({
								"bAutoWidth": false,
								"bProcessing": false,
								"aoColumnDefs" : [
									{ "sWidth": "40px", "aTargets": [0]},
									{ "sWidth": "200px", "aTargets": [1]},
									{ "sWidth": "50px", "aTargets": [2]}
								],
								/*Tamanho da altura so scroll*/
								"sScrollY": "235px",
								/*Auto ajusta a altura da tabela no caso de ser menor*/
								"bScrollCollapse": true,
								"bSort" : false,
								"bPaginate" : false,
								"bLengthChange" : false,
								"bFilter" : true,
								"bInfo" : false,
								"bDestroy" : true,
								"sAjaxSource": "/json/jsonMenuFilho.php?idMenu="+ $(".idMenu").val()
							});
						},
						error: function(){
							alert("Ocorreu um erro inesperado durante o processamento!!!");
						}
					});
				});
				$(".selecionaConta").click(function(e) {
               $("#idMenuPai").val($(this).attr("idCodigo"));
					$("#spanMenuPai").html($(this).attr("descricao"));
					$(".close").trigger("click");
            });
			});
			-->
		</script>
	</head>
	<body>
		<h1>
			Cadastro de Menu
<?	
			$action = "";
			switch($_POST['act']){
				case 'add':				
					$action = "Adicionar";
				break;

				case 'upd':			
					$action = "Atualizar";
				break;
	
				case 'del':			
					$action = "Remover";
				break;
			}
			
			# caso não seja inclusão recuperar o objeto do banco de dados
			if ($_POST['act'] != "add"){
				$dao = new MenuDAO();
				$obj = $dao->select(1, $_POST['idMenu']);
				
				unset ($dao);	
			}
?>
		</h1>
		<br />
		<form name="frmCadastro" method="post">
			<input type="hidden" name="act" id="act" value="<? echo $_POST['act']; ?>" />			
			<input type="hidden" name="processamento" id="processamento" value="ok" />
			<fieldset class="dados">
				<p class="cabecalhoForm">	
					<? echo $action; ?>
				</p>	
				<p>
					<label class="labelForm" for="id">ID</label>
<?	
					if ($_POST['act'] != 'add' && $_POST['processamento'] != 'ok'){
						$_POST['idMenu'] = $obj->getCodigo();
						echo $_POST['idMenu'];
						$_POST['idMenuPai'] = is_null($obj->getIdMenuPai()) ? NULL : $obj->getIdMenuPai()->getCodigo();
						$idMenuPaiDescricao = is_null($obj->getIdMenuPai()) ? "Não possui" : $obj->getIdMenuPai()->getDescricao();
						$_POST['descricao'] =$obj->getDescricao();
						$_POST['pagina'] = is_null($obj->getPagina()) ? NULL : $obj->getPagina();
						$_POST['inConsulta'] = is_null($obj->getInConsulta()) ? NULL : $obj->getInConsulta();
						$_POST['inAltera'] = is_null($obj->getInAltera()) ? NULL : $obj->getInAltera();
						$_POST['inAdiciona'] = is_null($obj->getInAdiciona()) ? NULL : $obj->getInAdiciona();
						$_POST['inVisualiza'] = is_null($obj->getInVisualiza()) ? NULL : $obj->getInVisualiza();
						$_POST['inPermissaoEspecial'] = is_null($obj->getInPermissaoEspecial()) ? NULL : $obj->getInPermissaoEspecial();
						$_POST['descricaoPermissaoEspecial'] = is_null($obj->getDescricaoPermissaoEspecial()) ? NULL : $obj->getDescricaoPermissaoEspecial();
					} else {
						echo 'Novo registro';
						$_POST['idMenu'] = NULL;
						$_POST['idMenuPai'] = NULL;
						$idMenuPaiDescricao = NULL;
						$_POST['descricao'] = NULL;
						$_POST['pagina'] = NULL;
						$_POST['inConsulta'] = NULL;
						$_POST['inAltera'] = NULL;
						$_POST['inAdiciona'] = NULL;
						$_POST['inVisualiza'] = NULL;
						$_POST['inPermissaoEspecial'] = NULL;
						$_POST['descricaoPermissaoEspecial'] = NULL;
					}
?>
					<input type="hidden" name="idMenu" class="idMenu" value="<? echo $_POST['idMenu']; ?>">
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="idMenuPai">Menu Pai</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $idMenuPaiDescricao;
					} else {
?>
						<input type="text" size="2" name="idMenuPai" id="idMenuPai" value="<? echo $_POST['idMenuPai']; ?>" readonly="readonly" />
                  <a href="#modalMP" name="modal"><img src="img/pesquisar.png" /></a>
                  <span id="spanMenuPai">
                  	<? echo $idMenuPaiDescricao; ?>
                  </span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="descricao">Descrição</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $descricao;
?>	
						<input type="hidden" name="descricao" />
<?
					} else {								
?>
						<input type="text"  name="descricao" id="descricao" size="24" maxlength="64" value="<? echo $_POST['descricao']; ?>" />
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="pagina">Página</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $pagina;
?>	
						<input type="hidden" name="pagina" />
<?
					} else {								
?>
						<input type="text"  name="pagina" id="pagina" size="24" maxlength="64" value="<? echo $_POST['pagina']; ?>" />
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="inConsulta">Consulta</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $inConsulta == 0 ? 'Não' : 'Sim';
					} else {
?>	
						<input type="radio" name="inConsulta" class="inConsulta" value="0" <? echo $_POST['inConsulta'] == 0 ? "checked" : ""; ?> /><span>Não</span>
						<input type="radio" name="inConsulta" class="inConsulta" value="1" <? echo $_POST['inConsulta'] == 1 ? "checked" : ""; ?> /><span>Sim</span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="inAltera">Altera</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $inAltera == 0 ? 'Não' : 'Sim';
					} else {
?>	
						<input type="radio" name="inAltera" class="inAltera" value="0" <? echo $_POST['inAltera'] == 0 ? "checked" : ""; ?> /><span>Não</span>
						<input type="radio" name="inAltera" class="inAltera" value="1" <? echo $_POST['inAltera'] == 1 ? "checked" : ""; ?> /><span>Sim</span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="inAdiciona">Adiciona</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $inAdiciona == 0 ? 'Não' : 'Sim';
					} else {
?>	
						<input type="radio" name="inAdiciona" class="inAdiciona" value="0" <? echo $_POST['inAdiciona'] == 0 ? "checked" : ""; ?> /><span>Não</span>
						<input type="radio" name="inAdiciona" class="inAdiciona" value="1" <? echo $_POST['inAdiciona'] == 1 ? "checked" : ""; ?> /><span>Sim</span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="inVisualiza">Visualiza</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $inVisualiza == 0 ? 'Não' : 'Sim';
					} else {
?>	
						<input type="radio" name="inVisualiza" class="inVisualiza" value="0" <? echo $_POST['inVisualiza'] == 0 ? "checked" : ""; ?> /><span>Não</span>
						<input type="radio" name="inVisualiza" class="inVisualiza" value="1" <? echo $_POST['inVisualiza'] == 1 ? "checked" : ""; ?> /><span>Sim</span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="inPermissaoEspecial">Permissão Especial</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $inPermissaoEspecial == 0 ? 'Não' : 'Sim';
					} else {
?>	
						<input type="radio" name="inPermissaoEspecial" class="inPermissaoEspecial" value="0" <? echo $_POST['inPermissaoEspecial'] == 0 ? "checked" : ""; ?> /><span>Não</span>
						<input type="radio" name="inPermissaoEspecial" class="inPermissaoEspecial" value="1" <? echo $_POST['inPermissaoEspecial'] == 1 ? "checked" : ""; ?> /><span>Sim</span>
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<p>
					<label class="labelForm" for="descricaoPermissaoEspecial">Descricão da Permissão</label>
<?
					if($_POST['act'] == 'del' && $_POST['processamento'] != 'ok'){
						echo $descricaoPermissaoEspecial;
?>	
						<input type="hidden" name="descricaoPermissaoEspecial" />
<?
					} else {								
?>
						<input type="text"  name="descricaoPermissaoEspecial" id="descricaoPermissaoEspecial" size="24"  maxlength="80" value="<? echo $_POST['descricaoPermissaoEspecial']; ?>" />
<?
					}	
?>
				</p>
				<div class="clear"></div>
				<div class="floatRight">
<?
					if ($_POST['act'] != 'del'){
?>
						<input type="button" value="Salvar" id="btn">
<?
					} else {	
?>	
						<input type="button" value="Remover" id="btn">
<?	
					}
?>	
					<input type="button" value="Voltar" id="btnVoltar">
				</div>
			</fieldset>
		</form>
<?
		if ($_POST['act'] == 'upd'){
?>
         <br />
         <br /><br />
         <div class="dados">
            <a href="#modalMF" name="modal"><input type="button" class="cadastrar floatRight" value="CADASTRAR" /></a>
            <div class="clear"></div>
            <p class="cabecalhoForm">
               Autorização Menus
            </p>
            <div class="clear"></div>
            <table id="menuFilho">
               <thead>
                  <tr>
                     <th>
                        ID
                     </th>
                     <th>
                        Descrição
                     </th>
                     <th>
                        Opção
                     </th>
                     <th>
                     </th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
<?
		}
		require_once("modal/menuPai.php");
		require_once("modal/menuFilho.php");
?>
      <div id="mask"></div>
	</body>
</html>
<?
   require_once "conADODBclose.php";
?>