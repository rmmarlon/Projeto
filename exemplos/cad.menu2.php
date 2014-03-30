<?
	require_once("conADODBopen.php");
	require_once("tool/funcoes.php");
	require_once("classes/autoload.php");
	
	##DESCLARACOES DE VARIAVEIS
	if(! isset($_POST["act"])){
		echo "ERRO";
		exit();
	}
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	##FIM DECLARACOES
	if($_POST['acao'] == 'processar'){
		$obj = new Menu($_POST['idMenu'],
							 $_POST['idMenuPai'],
							 $_POST['descricao'],
							 $_POST['pagina'],
							 $_POST['inConsulta'],
							 $_POST['inAltera'],
							 $_POST['inAdiciona'],
							 $_POST['inPermissaoEspecial'],
							 isset($_POST['descricaoPermissao']) ? $_POST['descricaoPermissao'] : NULL);
		
		$dao = new MenuDAO();
		switch($_POST['act']){
			case 'add':
				if($dao->add($obj)){
					echo "Cadastro realizado com sucesso!!!";
				} else {
					echo "Erro ao cadastrar!!!<br>Query: ".$dao->getSQL();
				}
			break;
			
			case 'upd':
				if($dao->update($obj)){
					echo "Atualização realizada com sucesso!!!";
				} else {
					echo "Erro ao atualizar!!!<br>Query: ".$dao->getSQL();
				}
			break;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>
      	Sistema Marlon
      </title>
      <link rel="stylesheet" type="text/css" href="personalizado/dataTable.css"/>
	   <link rel="stylesheet" type="text/css" href="personalizado/estilo.css"/>
      <script src="tool/jquery.js" language="javascript"></script>
      <script src="tool/dataTable.js" language="javascript"></script>
		<script src="tool/script.js" language="javascript"></script>
      <script language="javascript">
			$(document).ready(function(e) {
				if($(".inPermissaoEspecial:checked").val() == 1){
					$("#descricaoPermissao").removeAttr("disabled");
				} else {
					$("#descricaoPermissao").attr("disabled","disabled");
				}
				$(".inPermissaoEspecial").click(function(e) {            
					if($(".inPermissaoEspecial:checked").val() == 1){
						$("#descricaoPermissao").removeAttr("disabled");
					} else {
						$("#descricaoPermissao").attr("disabled","disabled");
						$("#descricaoPermissao").val('');
					}
				});
				$("#btnVoltar").click(function(e) {
               $("form").attr("action", "areaAutenticada.php");
					$("form").submit();
            });
      		$("#btnSalvar").click(function(e) {
               if($("#descricao").val() == ""){
						jAlert("Favor preencher o campo descrição!!");
					}  else if($(".inPermissaoEspecial:checked").val() == 1
								  && $("#descricaoPermissao").val() == ""){
						jAlert("Favor preencher o campo descrição da permissao!!");	
					} else{
						$("form").submit();
					}
            });
				$(".inSeleciona").click(function(e) {
               var idCodigo = $(this).attr("idCodigo");
					var descricao = $(this).attr("descricao");
					$("#idMenuPai").val(idCodigo);
					$("#spnMenuPai").html(descricao);
					$(".close").trigger("click");
            });
         });
		</script>
      <style>
			.texto{
				width:300px;
				float:left;
			}
			.textoB{
				width:270px;
				padding-left:30px;
				float:left;
			}
			
			.textoC{
				width:240px;
				padding-left:60px;
				float:left;
			}
			.botao{
				width:30px;
				float:left;
				text-align:center;
			}
			#modalMenuPai{
				width:350px;	
			}
		</style>
	</head>
   <body>
   	<h1>
      	Cadastro de Menu
      </h1>
   	<form method="post">
         <input type="hidden" name="acao" id="acao" value="processar" />
         <input type="hidden" name="act" id="act" value="<? echo $_POST['act']; ?>" />
<?
			$action = "";
			switch($_POST['act']){
				case "add":
					$action = "Adicionar";
				break;
				
				case "upd":
					$action = "Atualizar";
				break;
			}
			if($_POST['act'] == "upd"){
				$dao = new MenuDAO();
				$obj = $dao->select(1, $_POST['idMenu']);
			}
?>
			<fieldset class="dados">
            <p class="cabecalhoForm">
               <? echo $action; ?>
            </p>
            <p>
               <label for="idMenu" class="labelForm">ID</label>
<?
					if($_POST['act'] == "upd"){
						echo $obj->getCodigo();
						$_POST['idMenu'] = $obj->getCodigo();
						$_POST['idMenuPai'] = is_null($obj->getIdMenuPai()) ? NULL : $obj->getIdMenuPai()->getCodigo();
						$_POST['descricao'] = $obj->getDescricao();
						$_POST['pagina'] = $obj->getPagina();
						$_POST['inConsulta'] = $obj->getInConsulta();
						$_POST['inAltera'] = $obj->getInAltera();
						$_POST['inAdiciona'] = $obj->getInAdiciona();
						$_POST['inPermissaoEspecial'] = $obj->getInPermissaoEspecial();
						$_POST['descricaoPermissao'] = $obj->getDescricaoPermissao();
					} else {
						echo "Novo Registro";
						$_POST['idMenu'] = NULL;
						$_POST['idMenuPai'] = NULL;
						$_POST['descricao'] = NULL;
						$_POST['pagina'] = NULL;
						$_POST['inConsulta'] = 0;
						$_POST['inAltera'] = 0;
						$_POST['inAdiciona'] = 0;
						$_POST['inPermissaoEspecial'] = 0;
						$_POST['descricaoPermissao'] = NULL;
					}
?>
					
		         <input type="hidden" name="idMenu" id="idMenu" value="<? echo $_POST['idMenu']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               <label for="idMenuPai" class="labelForm">MenuPai</label>
               <input type="text" name="idMenuPai" id="idMenuPai" size="1" value="<? echo $_POST['idMenuPai']; ?>" />
               <a href="#modalMenuPai" name="modal"><img src="img/pesquisar.png" alt="PESQUISAR" /></a>
               <span id="spnMenuPai"></span>
            </p>
            <div class="clear"></div>
            <p>
               <label for="descricao" class="labelForm">Descrição</label>
               <input type="text" name="descricao" id="descricao" value="<? echo $_POST['descricao']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               <label for="pagina" class="labelForm">Pagina</label>
               <input type="text" name="pagina" id="pagina" value="<? echo $_POST['pagina']; ?>" />
            </p>
            <div class="clear"></div>
            <p id="consulta">
               <label for="inConsulta" class="labelForm">Consulta</label>
               <input type="radio" name="inConsulta" class="inConsulta" value="0" <? if($_POST['inConsulta'] == 0){ echo "checked"; }?> />
               <label for="conSn">Não</label>
               <input type="radio" name="inConsulta" class="inConsulta" value="1" <? if($_POST['inConsulta'] == 1){ echo "checked"; }?> />
               <label for="conSn">Sim</label>
            </p>
            <div class="clear"></div>
            <p>
               <label for="inAltera" class="labelForm">Altera</label>
               <input type="radio" name="inAltera" class="inAltera" value="0" <? if($_POST['inAltera'] == 0){ echo "checked"; }?> />
               <label for="altSn">Não</label>
               <input type="radio" name="inAltera" class="inAltera" value="1" <? if($_POST['inAltera'] == 1){ echo "checked"; }?> />
               <label for="altSn">Sim</label>
            </p>
            <div class="clear"></div>
            <p>
               <label for="inAdiciona" class="labelForm">Adiciona</label>
               <input type="radio" name="inAdiciona" class="inAdiciona" value="0" <? if($_POST['inAdiciona'] == 0){ echo "checked"; }?> />
               <label for="adcSn">Não</label>
               <input type="radio" name="inAdiciona" class="inAdiciona" value="1" <? if($_POST['inAdiciona'] == 1){ echo "checked"; }?> />
               <label for="adcSn">Sim</label>
            </p>
            <div class="clear"></div>
            <p>
               <label for="permissaoEpecial" class="labelForm">Permissão especial</label>
               <input type="radio" name="inPermissaoEspecial" class="inPermissaoEspecial" value="0" <? if($_POST['inPermissaoEspecial'] == 0){ echo "checked"; }?> />
               <label for="pesSn">Não</label>
               <input type="radio" name="inPermissaoEspecial" class="inPermissaoEspecial" value="1" <? if($_POST['inPermissaoEspecial'] == 1){ echo "checked"; }?> />
               <label for="pesSn">Sim</label>
            </p>
            <div class="clear"></div>
            <p>
               <label for="descricaoPermissao" class="labelForm">Descrição permissão</label>
               <input type="text" name="descricaoPermissao" id="descricaoPermissao" value="<? echo $_POST['descricaoPermissao']; ?>" disabled="disabled" />
            </p>
            <div class="clear"></div>
            <div class="floatRight">
               <input type="button" value="Salvar" id="btnSalvar" />
               <input type="button" value="Voltar" id="btnVoltar" />
            </div>
            <div class="clear"></div>
         </fieldset>
      </form>
      <div id="modalMenuPai" class="window">
      	<h3>
         	Menu Pai
         </h3>
         <div style="height:300px; overflow-y:scroll">
<?
				$dao = new MenuDAO();
				$objLista = $dao->select(2, $_POST['idMenu']);
				
				if(! is_null($objLista)){
					foreach($objLista as $obj){
?>
                  <div class="texto">
                     <p>
                        <? echo $obj->getDescricao(); ?>
                     </p>
                  </div>
                  <div class="botao">
                     <a href="#" class="inSeleciona" idCodigo="<? echo $obj->getCodigo(); ?>" descricao="<? echo $obj->getDescricao(); ?>"><img src="img/selecionar.png" alt="SELECIONAR" /></a>
                  </div>
                  <div class="clear"></div>
<?
						$objListaB = $dao->select(3, $obj->getCodigo());
						if(! is_null($objListaB)){
							foreach($objListaB as $objB){
?>
                        <div class="textoB">
                           <p>
                              <? echo $objB->getDescricao(); ?>
                           </p>
                        </div>
                        <div class="botao">
                           <a href="#" class="inSeleciona" idCodigo="<? echo $objB->getCodigo(); ?>" descricao="<? echo $objB->getDescricao(); ?>"><img src="img/selecionar.png" alt="SELECIONAR" /></a>
                        </div>
                        <div class="clear"></div>
<?
								$objListaC = $dao->select(3, $objB->getCodigo());
								if(! is_null($objListaC)){
									foreach($objListaC as $objC){
?>
                              <div class="textoC">
                                 <p>
                                    <? echo $objC->getDescricao(); ?>
                                 </p>
                              </div>
                              <div class="botao">
                                 <a href="#" class="inSeleciona" idCodigo="<? echo $objC->getCodigo(); ?>" descricao="<? echo $objC->getDescricao(); ?>"><img src="img/selecionar.png" alt="SELECIONAR" /></a>
                              </div>
                              <div class="clear"></div>
<?
									}
								}
							}
						}
					}
				}
?>
			</div>
         <br />
			<div class="floatRight">
         	<input type="button" value="FECHAR" class="close" />
         </div>
      </div>
      <div id="mask"></div>
   </body>
</html>