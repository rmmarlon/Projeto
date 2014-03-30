<?
	require_once ("classes/autoload.php");	
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	#declarando variaveis
	if(! isset($_POST['act'])){
		$_POST['act'] = NULL;
	}
	if(! isset($_POST['inSexo'])){
		$_POST['inSexo'] = NULL;
	}
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	if($_POST['acao'] == 'cadastrar'){
		$obj = new Cadastro($_POST['idCadastro'],
								  $_POST['nome'],
								  $_POST['cpf'],
								  $_POST['cnpj'],
								  $_POST['responsavel'],
								  $_POST['cep'],
								  $_POST['telefone'],
								  $_POST['celular'],
								  NULL,
								  $_POST['dataNascimento'] == "" ? NULL : corrigeData($_POST['dataNascimento']),
								  $_POST['fundacao'] == "" ? NULL : corrigeData($_POST['fundacao']),
								  $_POST['inSexo'], 
								  $_POST['inTipo'],
								  $_POST['inPessoa'],
								  $_POST['inPorte']);
								 
		$dao = new CadastroDAO();
		switch($_POST['act']){
			case 'add':
				if($dao->add($obj)){
					$_SESSION['msg'] = "Cadastro realizado com sucesso";					
					//echo "<meta http-equiv='refresh' content='2; URL=cad.cadastro.php'>"; 
				} else{
					$_SESSION['msg'] = "Não foi possível cadastrar!!!";	
				}
			break;
			
			case 'upd':
				if($dao->update($obj)){
					$_SESSION['msg'] = "Atualização realizado com sucesso";
				} else{
					$_SESSION['msg'] = "Não foi possível atualizar!!!";	
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
	        Area Inicio
        </title>
        <link rel="stylesheet" type="text/css" href="personalizado/projeto.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css"/>
        <script type="text/javascript" src="tool/jquery.js"></script>
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootbox.min.js"></script>
        <script type="text/javascript" src="tool/script.js"></script>
        <script type="text/javascript">
			$(document).ready(function(e) {
				<? if($_POST['act'] == "add"){ ?>$("#inTipo").val(''); <? } ?>			
				if($(".inPessoa:checked").val() == 1){
					$(".hidJur").show();
					$(".hidFis").hide();
				} else{
					$(".hidJur").hide();
					$(".hidFis").show();
				}
				if($(".inPessoa:checked").val() == 0){
					$("#inPorte").val('');
 				}
				$(".btnCancelar").click(function(e) {
					$("form").attr("action", "cad.cadastro.php");
					$("form").submit();
				});
				$(".inPessoa").click(function(e) {					
               		if($(".inPessoa:checked").val() == 1){
						var sx = $(".inSexo").val();
						$(".hidJur").show(500);
						$(".hidFis").hide(500);
						$(".inSexo").each(function(index, element) {
							if(index == 1){	
								$(".inSexo").removeAttr("checked");
							}
						});
					} else{
						$(".hidJur").hide(500);
						$(".hidFis").show(500);
						$(".inSexo").each(function(index, element) {
							if(! index == 1){	
								$(".inSexo").attr("checked", "checked");
							}
						});
					}
				});
				$(".inPessoa").click(function(e) {
					/*Jurídica*/
               		if($(".inPessoa:checked").val() == 1 && ($("#cpf").val() != "" || $("#dataNascimento").val() != "")){	
						var descricaoConfirmacao = 'Você realmente deseja mudar de pessoa fisica pra juridica?<br> Se você continuar essas informações serão perdidas:<br><br>';
						
						if($("#cpf").val() != ""){
							descricaoConfirmacao += '<p><label class="labelForm">CPF: </label>'
													+$("#cpf").val() +'</p><div class="clear"></div>';
						}
					
						if($("#dataNascimento").val() != ""){
							descricaoConfirmacao += '<p><label class="labelForm">Data de Nascimento: </label>'+ $("#dataNascimento").val() +'</p><div class="clear"></div>';
						}
						
						bootbox.confirm(descricaoConfirmacao, function(valida){
							if(valida){
								$("#cpf").val('');				
								$("#dataNascimento").val('');
							} else{
								$(".inPessoa").each(function(index, element) {
									if(index == 0){
										$(this).attr("checked", "checked");
									}
								});
								$(".hidJur").hide(500);
								$(".hidFis").show(500);
							}
						});
					} else if($(".inPessoa:checked").val() == 0
					&& ($("#responsavel").val() != ""
					|| $("#cnpj").val() != ""
					|| $("#fundacao").val() != ""
					|| $("#inPorte").val() != "")){
						var descricaoConfirmacao = 'Você realmente deseja mudar de pessoa Jurídica pra física?<br> se você continuar essas informações serão perdidas<br><br><p>';
						if($("#responsavel").val() != ""){
						 	descricaoConfirmacao += '<p><label class="labelForm">Responsável: </label>'
													+$("#responsavel").val() +'</p><div class="clear"></div>'
						}
						if($("#cnpj").val() != ""){
							descricaoConfirmacao += '<p><label class="labelForm">CNPJ: </label>'
													+ $("#cnpj").val() +'</p><div class="clear"></div>'
						}
						if($("#fundacao").val() != ""){
							descricaoConfirmacao += '<p><label class="labelForm">Fundação: </label>'
													+ $("#fundacao").val() +'</p><div class="clear"></div>'
						}
						if($("#inPorte").val() != ""){
							descricaoConfirmacao += '<p><label class="labelForm">Porte: </label>'
													+ $("#inPorte").val() +'</p><div class="clear"></div>';
						}
						bootbox.confirm(descricaoConfirmacao, function(validaB){
							if(validaB){
								$("#responsavel").val('');
								$("#cnpj").val('');
								$("#fundacao").val('');
								$("#inPorte").val('');
							} else{
								$(".inPessoa").each(function(index, element) {
                           			if(index == 1){
										$(this).attr("checked", "checked");
									}
                        		});
								$(".hidJur").show(500);
								$(".hidFis").hide(500);
							}
						});
					}
            	});
				$(".btnCadastrar").click(function(e) {
               	if($("#nome").val() == ""){
						bootbox.alert("Favor preencher o campo nome");
					} else if($(".inPessoa:checked").val() == 0 && $("#cpf").val().length < 14){
						bootbox.alert("Favor preencher o campo CPF corretamente 999.999.999-99");
					} else if($(".inPessoa:checked").val() == 1 && $("#responsavel").val() ==""){
						bootbox.alert("Favor preencher o campo responsável");
					} else if($(".inPessoa:checked").val() == 1 && $("#cnpj").val().length < 18){ 
						bottbox.alert("Favor preencher o campo CNPJ corretamente 99.999.999/9999-99");
					} else if($("#cep").val().length < 9){
						bootbox.alert("Favor preencher o campo CEP corretamente 99999-999");
					} else if($("#telefone").val().length < 13){
						bootbox.alert("Favor preencher o campo telefone corretamente (99) 9999-9999");
					} else if($("#celular").val().length < 14){
						bootbox.alert("Favor preencher o campo celular corretamente (99) 9999-9999");
					} else if($(".inPessoa:checked").val() == 0 && $("#dataNascimento").val().length < 10){
						bootbox.alert("Favor preencher o campo data de Nascimento corretamente 99/99/9999");
					} else if($(".inPessoa:checked").val() == 1 && $("#fundacao").val().length < 10){
						bootbox.alert("Favor preencher o campo fundacao corretamente 99/99/9999");
					} else if($(".inPessoa:checked").val() == 1 && $("#inPorte").val() == 0){
						bootbox.alert("Favor selecione uma opção no campo Porte");
					} else if($("#inTipo").val() == ""){
						bootbox.alert("Favor selecione uma opção no campo tipo");
					} else{
						/*var descricaoCadastrao = 'Você deseja cadastrar?<br><br><p><label class="labelForm">Nome: </label>'
														+$("#nome").val() +'</p><div class="clear"></div>'
														+'<p><label class="labelForm">CPF: </label>'
														+$("#cpf").val() +'</p><div class="clear"></div>'
														+'<p><label class="labelForm">CEP: </label>'
														+$("#cep").val() +'</p><div class="clear"></div>'
														+'<p><label class="labelForm">Telefone: </label>'
														+$("#telefone").val() +'</p><div class="clear"></div>'
														+'<p><label class="labelForm">Celular: </label>'
														+$("#celular").val() +'</p><div class="clear"></div>'*/
						bootbox.confirm(<? if($_POST['act'] == 'upd'){ ?>'Você realmente quer altarar?' <? } else{?>'Você realmente quer cadastrar?'<? } ?>, function(valida){
							if(valida){
								$("#acao").val('cadastrar');
								$("form").submit();
							}
						});
					}
            	});
				<? if($_POST['act'] == 'add'){ ?> $("#adUp").hide(); <? } ?>
				<? if($_POST['act'] == 'upd'){?> $(".btnCadastrar").val('Atualizar'); <? } ?>
         });
		</script>
      <style type="text/css">		
			#cadastros{
				background:#aaa;
				margin:auto;
				width:30%;
				margin-top:1%;
				padding:1%;
			}
			.hidJur{
				display:none;
			}

		</style>
   </head>
   <body>
<?
      $action = "";
      switch($_POST['act']){
         case "add":
            $action = "Adicionar - Novo registro";
         break;
         
         case "upd":
            $action = "Atualizar";
         break;
      }
      if($_POST['act'] == "upd"){
				$dao = new CadastroDAO();
				$obj = $dao->select(1, $_POST['idCadastro']);				
      }
?>	
		<form method="post">
         <input type="hidden" name="acao" id="acao" />
         <input type="hidden" name="act" id="act" value="<? echo $_POST['act']; ?>" />
         <fieldset class="dados">
            <h3>
            
               <? echo $action; ?>
            </h3>
            <p>
               <label class="labelForm" for="idCadastro" id="adUp">Código:</label>
<?
					if($_POST['act'] == 'upd'){
						echo $obj->getCodigo();
						$_POST['idCadastro'] = $obj->getCodigo();
						$_POST['nome'] = $obj->getNome();
						$_POST['cpf'] = $obj->getCPF();
						$_POST['cnpj'] = $obj->getCNPJ();
						$_POST['responsavel'] = $obj->getResponsavel();
						$_POST['cep'] = $obj->getCEP();
						$_POST['telefone'] = $obj->getTelefone();
						$_POST['celular'] = $obj->getCelular();
						NULL;
						$_POST['dataNascimento'] = is_null($obj->getDataNascimento()) ? NULL : $obj->getDataNascimento()->getDMY(); 
						$_POST['fundacao'] = is_null($obj->getFundacao()) ? NULL : $obj->getFundacao()->getDMY();
						$_POST['inSexo'] = $obj->getInSexo();
						$_POST['inTipo'] = $obj->getInTipo();
						$_POST['inPessoa'] = $obj->getInPessoa();
						$_POST['inPorte'] = $obj->getInPorte();
					} else{
						$_POST['idCadastro'] = NULL;
						$_POST['nome'] = NULL;
						$_POST['cpf'] = NULL;
						$_POST['cnpj'] = NULL;
						$_POST['responsavel'] = NULL;
						$_POST['cep'] = NULL;
						$_POST['telefone'] = NULL;
						$_POST['celular'] = NULL;
						$_POST['mae'] = NULL;
						$_POST['dataNascimento'] = NULL;
						$_POST['fundacao'] = NULL;
						$_POST['inSexo'] = 2;
						$_POST['inTipo'] = NULL;
						$_POST['inPessoa'] = 0;
						$_POST['inPorte'] = NULL;
					}
?>               
               <input type="hidden" name="idCadastro" id="idCadastro" value="<? echo $_POST['idCadastro']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               	<label class="labelForm">
                	Pessoa:
               	</label>
               	<input type="radio" name="inPessoa" class="inPessoa" value="0" <? if($_POST['inPessoa'] == 0){ echo "checked"; }?> />
               	Física
               	<input type="radio" name="inPessoa" class="inPessoa" value="1" <? if($_POST['inPessoa'] == 1){ echo "checked"; }?> />              
               	Juridica
            </p>
            <div class="clear"></div>
            <p class="hidFis">
				<label class="labelForm">
					Sexo:
				</label>
				<input type="radio" name="inSexo" class="inSexo" value="1" <? if($_POST['inSexo'] == 1){ echo "checked"; }?> />
               		Feminino
                <input type="radio" name="inSexo" class="inSexo" value="2" <? if($_POST['inSexo'] == 2){ echo "checked"; }?> />
               		Masculino
            </p>
            <div class="clear"></div>
            <p>
				<label class="labelForm">
					<span id="nomeEmpresa">Nome:</span>
				</label>
				<input type="text" name="nome" placeholder="Nome" id="nome" value="<? echo $_POST['nome']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidJur">
				<label class="labelForm">
                  Responsável:
				</label>
				<input type="text" name="responsavel" placeholder="Responsável" id="responsavel" value="<? echo $_POST['responsavel']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidFis">
               <label class="labelForm">
                  CPF:
               </label>
               <input type="text" placeholder="CPF" name="cpf" id="cpf" class="cpf" value="<? echo $_POST['cpf']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidJur">
               <label class="labelForm">
                  CNPJ:
               </label>
               <input type="text" name="cnpj" placeholder="CNPJ" id="cnpj" class="cnpj" value="<? echo $_POST['cnpj']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               <label class="labelForm">
                  CEP:
               </label>
               <input type="text" name="cep" id="cep" placeholder="CEP" class="cep"  size="8" value="<? echo $_POST['cep']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               <label class="labelForm">
                  Telefone:
               </label>
               <input type="text" name="telefone" placeholder="Telefone" id="telefone" class="phone" value="<? echo $_POST['telefone']; ?>" />
            </p>
            <div class="clear"></div>
            <p>
               <label class="labelForm">
                  Celular:
               </label>
               <input type="text" name="celular" placeholder="Celular" id="celular" class="phone" value="<? echo $_POST['celular']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidFis">
               <label class="labelForm">
                  Data de Nascimento:
               </label>
               <input type="text" name="dataNascimento" placeholder="Nascimento" id="dataNascimento" class="date" value="<? echo $_POST['dataNascimento']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidJur">
               <label class="labelForm">
                  Fundação:
               </label>
               <input type="text" name="fundacao" placeholder="Fundação" id="fundacao" class="date" value="<? echo $_POST['fundacao']; ?>" />
            </p>
            <div class="clear"></div>
            <p class="hidJur">
               <label class="labelForm">
                  Porte:
               </label>
               <select name="inPorte" id="inPorte">
                  <option value=''></option>                  
                  <option value='1' <? if($_POST['inPorte'] == 1) { echo "selected='selected'"; } ?> >Pequena</option>
                  <option value='2' <? if($_POST['inPorte'] == 2) { echo "selected='selected'"; } ?> >Média</option>
                  <option value='3' <? if($_POST['inPorte'] == 3) { echo "selected='selected'"; } ?>>Grande</option>
               </select>
            </p>
            <div class="clear"></div>
            <p>
               <label class="labelForm">
                  Tipo:
               </label>
               <select name="inTipo" id="inTipo">
                  <option value=''></option>
                  <option value='0' <? if($_POST['inTipo'] == 0) { echo "selected='selected'"; } ?> >Cliente</option>
                  <option value='1' <? if($_POST['inTipo'] == 1) { echo "selected='selected'"; } ?> >Fornecedor</option>
                  <option value='2' <? if($_POST['inTipo'] == 2) { echo "selected='selected'"; } ?> >Funcionário</option>
                  <option value='3' <? if($_POST['inTipo'] == 3) { echo "selected='selected'"; } ?> >Freelancer</option>
               </select>
            </p>
            <div class="clear"></div>
            <div class="floatRightMargin">
            	<input type="button" name="btnCancelar" class="btnCancelar btn btn-default" value="Voltar" mcf="cadastro" /> 
				<? if($_POST['act'] == 'add'){?>
                   <input type="button" name="btnAlterar" class="btnCadastrar btn btn-info" value="Cadastrar" />
				<? } else{ ?>
					<input type="button" name="btnAlterar" class="btnCadastrar btn btn-info" value="Alterar" />
				<? } ?>
            </div>
            <div class="clear"><br /></div>
         </fieldset>
      </form>
   </body>
<?
 require_once("personalizado/alerta.php");
?>
</html>