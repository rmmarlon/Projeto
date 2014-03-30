<?
	require_once ("classes/autoload.php");	 
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	
	#declarando variaveis
	if(! isset($_POST['act'])){
		$_POST['act'] = NULL;
	}
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	
	if($_POST['acao'] == 'comprar'){
		$obj = new Compra(NULL,
								  $_POST['idCadastro'],
								  $_POST['idProduto'],
								  $_POST['quantidadeCompra'],
								  corrigeValor($_POST['valorTotal']));
								 
		$dao = new CompraDAO();
		if($dao->add($obj)){
			$_SESSION['msg'] = "Cadastro realizado com sucesso";
		} else{
			$_SESSION['msg'] = "Não foi possível cadastrar!!!";	
		}
		$dao = new ProdutoDAO();
		$oP = $dao->select(1, $_POST['idProduto']);
		
		$oP->updQuantidade($_POST['saldo']);
		if($dao->update($oP)){
		} else{
			$_SESSION["msg"] = "Não foi possível alterar!!!<br>";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <title>
	        Area Inicio
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="personalizado/projeto.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css"/>
        <script type="text/javascript" src="tool/jquery.js"></script>
       	<script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="bootstrap-3.1.1/js/bootbox.min.js"></script>
        <script type="text/javascript" src="tool/script.js"></script>
      	<script language="javascript">
			$(document).ready(function(e) {
				$(".limpaModal, .limpaModalB").hide();
				$(".pages").click(function(e) {
					$("#mcf").val($(this).attr("mcf"));
					$("form").attr("action", "cad.cadastro.php");
					$("form").submit();
            	});
				$("#btnCompra").click(function(e) {
					var quantidadeCompra = $("#quantidadeCompra").attr("value");
					var quantidade = $("#quantidade").attr("value");
               		if($("#idCadastro").val() == ""){
						bootbox.alert("Favor selecione o <strong style='color:#f00'>Cadastro</strong>, clique na lupa e selecione!!!");
					} else if($("#idProduto").val() == ""){
						bootbox.alert("Favor selecione o <strong style='color:#f00'>Produto</strong>, clique na lupa e selecione!!!");
					} else if($("#quantidadeCompra").val() == ""){
						bootbox.alert("Favor preencher com a <strong style='color:#f00'>Quantidade</strong>!");
					} else if(parseInt(quantidade) < parseInt(quantidadeCompra)){
						bootbox.alert("A <strong style='color:#f00'>quantidade de compra</strong> não pode ser maior que a <strong style='color:#f00'>quantidade em estoque</strong>");
					} else{
						bootbox.confirm('Você realmente quer efetuar a compra', function(valida){
							if(valida){
								$("#acao").val('comprar');
								$("form").submit();
							}
						});
					}
            	});	
				$(".inSeleciona").click(function(e) {
               		var idCodigo = $(this).attr("codigo");
					var nome = $(this).attr("nome");
					$("#idCadastro").val(idCodigo);					
					$("#spnCadastro").html(nome);
					$(".limpaModal").show();
					$("#pesquisaModal").hide();
					$(".close").trigger("click");
            	});
				$(".limpaModal").click(function(e) {
               		$("#idCadastro").val('');
					$("#spnCadastro").html('');
					$("#pesquisaModal").show();
					$(".limpaModal").hide();
            	});
				$(".inSeleciona2").click(function(e) {
					var descricao = $(this).attr("descricao");
					var valor = $(this).attr("valor");
					var idCodigo = $(this).attr("idCodigo");
					var quantidade = $(this).attr("quantidade");
					$("#idProduto").val(idCodigo);
					$("#spnProduto").html(descricao);
					$("#quantidade").val(quantidade);
					$("#valor").val(valor);
					$(".limpaModalB").show();
					$("#pesquisaModalB").hide();
					$(".close").trigger("click");
            	});
				$(".limpaModalB").click(function(e) {
               		$("#idProduto").val('');
					$("#spnProduto").html('');
					$("#quantidade").val('');
					$("#valor").val('');
					$("#pesquisaModalB").show();
					$(".limpaModalB").hide();
            	});
				$("#quantidadeCompra").blur(function(e) {
					var quantidadeCompra = $(this).attr("value");
					var quantidade = $("#quantidade").attr("value");
					var valoBruto = $("#valor").attr("value");
					var soma = number_format(quantidadeCompra*corrigeValor(valoBruto), 2, ",", ".");
					var saldo = parseInt(quantidade)-parseInt(quantidadeCompra);
					$("#valorTotal").val(soma);
					$("#saldo").val(saldo);
            	});
				
				//$("#menus li:nth-child:(2)contains('Cadastro'), li:nth-child(4)").css("background","#F00");
			});
		</script>
        <style>
			body{
				background: -webkit-radial-gradient(right top,#DeDaDf, #F0F9Ea, #e6e9Df);
				background: -moz-radial-gradient(right top,#DeDaDf, #F0F9Ea, #e6e9Df);
				background: -ms-radial-gradient(right top,#DeDaDf, #F0F9Ea, #e6e9Df);
			}
		</style>
	</head>
    <body>   	
		<form method="post">
        	<input type="hidden" name="acao" id="acao" />
        	<input type="hidden" name="idCompra" id="idCompra" />
        	<input type="hidden" name="saldo" id="saldo"  class="integer" />
            <fieldset class="dadosB">
                <h3>
                    Nova Venda
                </h3>
                <p>
                    <label class="labelForm" >
                        Cadastro:
                    </label>
                    <input type="text" name="idCadastro" id="idCadastro" readonly="readonly" class="readOnly inputPesquisa" />
                    <span id="spnCadastro"></span>
                    <span class="btnPesquisa">
                        <a href="#" id="pesquisaModal" data-toggle="modal" data-target="#myModalB">
                            <img src="img/pesquisamini.png" alt="Pesquisar" width="19" height="17" />
                        </a>
                        <a href="#" class="limpaModal">
                            <img src="img/limpar.png" alt="Limpar" width="15" height="15" />
                        </a>
					</span>
                </p>
                <div class="clear"></div>            
                <p>
                    <label class="labelForm">
                        Produto:
                    </label>
                    <input type="text" name="idProduto" id="idProduto" readonly="readonly" class="readOnly inputPesquisa" size="1" />
                    <span id="spnProduto"></span>
                    <span class="btnPesquisa">
                        <a href="#" id="pesquisaModalB" data-toggle="modal" data-target="#myModal">
                            <img src="img/pesquisamini.png" alt="Pesquisar Produto" width="19" height="17" />
                        </a>
                        <a href="#" class="limpaModalB" title="Limpar o Produto">
                            <img src="img/limpar.png" alt="Limpar" width="15" height="15" />
                        </a>
                    </span>
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Quantidade:
                    </label>               
                    <input type="text" name="quantidade" id="quantidade" class="readOnly"  size="1" readonly="readonly" />
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Valor:
                    </label>                   
                    <input type="text" name="valor" id="valor" class="decimal" readonly="readonly" />
                    <input type="text" name="valorTotal" id="valorTotal" class="decimal" readonly="readonly" />
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Comprar:
                    </label>
                    <input type="text" name="quantidadeCompra" id="quantidadeCompra" class="integer readOnly" />     
                </p>
                <div class="clear"><br /></div>
                <div class="floatRightMargin">
                    <input type="button" name="btnCompra" class="btn btn-info" id="btnCompra" value="Efetuar Venda" />
                </div>
                <div class="clear"><br /></div>
			</fieldset>
		</form>
   </body>
</html>
<?
	require_once("modal/modalProduto.php");
	require_once("modal/modalCadastro.php");
	require_once("personalizado/alerta.php");
	require_once("conADODBclose.php");
?>