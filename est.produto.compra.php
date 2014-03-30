<?
	require_once ("classes/autoload.php");	
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	#declarando variaveis
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	#carrega objeto
	$dao = new ProdutoDAO();
	$oP = $dao->select(1, $_POST['idProduto']);
	
	if($_POST['acao'] == 'Alterar'){
			$oP->updQuantidade($_POST['quantidade']);
								 
		if($dao->update($oP)){
			$_SESSION["msg"] = "Compra realizado com sucesso!!!";
		} else{
			$_SESSION["msg"] = "Não foi possível compra!!!";
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
        <link rel="stylesheet" type="text/css" href="personalizado/bootstrap.min.css" />
        <script type="text/javascript" src="tool/jquery.js"></script>
        <script type="text/javascript" src="tool/bootstrap.min.js"></script>
        <script type="text/javascript" src="tool/bootbox.min.js"></script>
        <script type="text/javascript" src="tool/script.js"></script>
        <script language="javascript">
			$(document).ready(function(e) {
				$(".pages").click(function(e) {
					$("#mcf").val($(this).attr("mcf"));
					$("form").attr("action", "cad.cadastro.php");
					$("form").submit();
				});
				$(".btnCancelar").click(function(e) {
						$("form").attr("action", "cad.produto.php");
						$("form").submit();
				});				
				$(".btnCadastrar").click(function(e) {
               	if($("#quantidade").val() == ""){
						bootbox.alert("Favor preencher com a quantidade!");
					} else{
						var descricaoCompra = 'você quer comprar mais deste produto ?<br><br><label class="labelForm">Quantidade: </label>'
													+$("#quantidade").val() +'</p><div class="clear"></div>';
						bootbox.confirm(descricaoCompra, function(valida){
							if(valida){
								$("#acao").val('Alterar');
								$("form").submit();
							} else{
								$("#quantidadeEstoque").val('');
								$("#quantidade").val('');
							}
						});
					}
            	});
				$("#quantidadeEstoque").blur(function(e) {
            		var quantidadeEstoque = $(this).attr("value");
					var quantidade = $("#quanEst").attr("quantidade");
					var soma = parseInt(quantidadeEstoque)+parseInt(quantidade); 
					$("#quantidade").val(soma);
            	});			
				//$("#menus li:nth-child:(2)contains('Cadastro'), li:nth-child(4)").css("background","#F00");
			});
		</script>
    </head>
    <body>     	
		<form method="post">
			<input type="hidden" name="acao" id="acao" />
            <input type="hidden" name="idProduto" id="idProduto" value="<? echo $_POST['idProduto']; ?>" />
            <fieldset class="dados">
            	<p>
                	<label class="labelForm">
                    	Descrição:
                   	</label>
                   <? echo $oP->getDescricao(); ?>
                </p>
                <div class="clear"></div>
                <p>
                   <label class="labelForm">
                      Saldo:
                   </label>
                   <span id="quanEst" quantidade="<? echo $oP->getQuantidade(); ?>"><? echo $oP->getQuantidade(); ?></span>
                </p>
                <div class="clear"></div>
                <p>
                   <label class="labelForm">
                      Valor:
                   </label>
                   <? echo number_format($oP->getValor(), 2, ",","."); ?>
                </p>
                <div class="clear"></div>
                <p>
                   <label class="labelForm">
                      Valor Total:
                   </label>
                   <? echo number_format($oP->getQuantidade()*$oP->getValor(), 2, ",","."); ?>
                </p>
                <div class="clear"></div>
                <p>
                   <label class="labelForm">
                    Quantidade
                   </label>    
                   <input type="text" id="quantidadeEstoque" class="integer readOnly" />
                </p>
                <div class="clear"></div>
                <p>
                   <label class="labelForm">
                    Novo Saldo
                   </label>    
                   <input type="text" name="quantidade" id="quantidade" class="integer readOnly" />
                </p>
                <div class="clear"><br /></div>
                <div class="floatRight">
                        <input type="button" name="btnCancelar" class="btnCancelar btn" value="Voltar" />
                   <input type="button" name="btnCadastrar" class="btnCadastrar btn btn-info" value="Comprar" />
                </div>
                <div class="clear"></div>
			</fieldset>
		</form>
   </body>
<?
	require_once("personalizado/alerta.php");
	require_once("conADODBclose.php");
?>   
</html>