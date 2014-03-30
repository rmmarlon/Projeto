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
	if(! isset($obj)){
		$obj = NULL;
	}
	if($_POST['acao'] == 'cadastrar'){
		$obj = new Produto($_POST['idProduto'],
								  $_POST['idCadastro'],
								  $_POST['descricao'],
								  $_POST['quantidade'],
								  corrigeValor($_POST['valor']));
								 
		$dao = new ProdutoDAO();
		switch($_POST['act']){
			case 'add':
				if($dao->add($obj)){
					$_SESSION['msg'] = "Produto cadastrado com sucesso";
				} else{
					$_SESSION['msg'] = "Não foi possível cadastrar o Produto!!!";	
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
        <link rel="stylesheet" type="text/css" href="personalizado/projeto.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css"/>
        <script type="text/javascript" src="tool/jquery.js"></script>
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.1.1/js/bootbox.min.js"></script>
        <script type="text/javascript" src="tool/script.js"></script>
        <script language="javascript">
            $(document).ready(function(e) {
                $(".btnCancelar").click(function(e) {
                    $("form").attr("action", "cad.produto.php");
                    $("form").submit();
                });				
                $(".btnCadastrar").click(function(e) {
                    if($("#descricao").val() == ""){
                        bootbox.alert("Favor preencher o campo Descrição");
                    } else if($("#idCadastro").val() == ""){
                        bootbox.alert("Favor preencher o campo Fornecedor, clique na lupa e selecione!");
                    } else if($("#quantidade").val() == ""){
                        bootbox.alert("Favor preencher com a quantidade!");
                    } else if($("#valor").val() ==  "0,00"){
                        bootbox.alert("Favor preencher com o valor do produto!");
                    } else{
                        bootbox.confirm(<? if($_POST['act'] == 'upd'){ ?>'Você realmente quer altarar?' <? } else{?>'Você realmente quer cadastrar?'<? } ?>, function(valida){
                            if(valida){
                                $("#acao").val('cadastrar');
                                $("form").submit();
                            }
                        });
                    }
                });
                //$("#produto option:gt(0)").css("background","#F00");
                $("#descricao").blur(function(e) {
                    var descricao = $(this).val();
                    $.post("proc/validaProduto.php", { 
                            descricao: $(this).val()
                        },function(retorno){
                            if(parseInt(retorno) == 1){
                                jAlert("O produto <strong>"+descricao+"</strong> já está cadastrado no sistema!!!");
                                $("#descricao").val('');
                                return false;
                            }
                        }
                    );
                });
                $(".inSeleciona").click(function(e) {
                    var idCadastro = $(this).attr("idCadastro");
                    var nome = $(this).attr("nome");
                    $("#idCadastro").val(idCadastro);
                    $("#spnFornecedor").html(nome);
					$("#PesquisaModal").hide();
                    $(".limpaModal").show();
                    $(".close").trigger("click");
               	});
                $(".limpaModal").click(function(e) {
                    $("#idCadastro").val('');
                    $("#spnFornecedor").html('');
					$("#PesquisaModal").show();
                    $(".limpaModal").hide();
                });
                <? if($_POST['act'] == 'add'){ ?> $("#adUp").hide(); <? } ?>
                //$("#menus li:nth-child:(2)contains('Cadastro'), li:nth-child(4)").css("background","#F00");				
            });
        </script>
	</head>
	<body>
<?
		$action = "";
		switch($_POST['act']){
        	case "add":
            	$action = "Adicionar - Novo Produto";
        	break;
         
			case "upd":
				$action = "Atualizar";
			break;
		}		
      	if($_POST['act'] == "upd"){
			$dao = new ProdutoDAO();
			$obj = $dao->select(1, $_POST['idProduto']);
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
                    <label class="labelForm" for="idProduto" id="adUp">Código:</label>
<?
						if($_POST['act'] == 'upd'){
							echo $obj->getCodigo();
							$_POST['idProduto'] = $obj->getCodigo();
							$_POST['idCadastro'] = $obj->getIdCadastro()->getCodigo();
							$_POST['descricao'] = $obj->getDescricao();
							$_POST['quantidade'] = $obj->getQuantidade();
							$_POST['valor'] = $obj->getValor();
						} else{
							$_POST['idProduto'] = NULL;
							$_POST['idCadastro'] = NULL;
							$_POST['descricao'] = NULL;
							$_POST['quantidade'] = NULL;
							$_POST['valor'] = NULL;
						}
?>               
                    <input type="hidden" name="idProduto" id="idProduto" value="<? echo $_POST['idProduto']; ?>" />
                </p>
                <div class="clear"></div>            
                <p>
                    <label class="labelForm">
                      Descrição:
                    </label>
                    <input type="text" name="descricao" id="descricao" value="<? echo $_POST['descricao']; ?>" />
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Fornecedor:
                    </label>
                    <input type="text" name="idCadastro" id="idCadastro" class="readOnly inputPesquisa" readonly="readonly" value="<? echo $_POST['idCadastro']; ?>" />
                    <span id="spnFornecedor">
						<? if($_POST['act'] == 'upd' && $obj->getIdCadastro() != 'NULL'){ echo $obj->getIdCadastro()->getNome(); } ?>
                    </span>
                    <span class="btn-default btnPesquisa">
                        <a href="#" id="PesquisaModal" data-toggle="modal" data-target="#myModal">
                            <img src="img/pesquisamini.png" alt="Perquisar" width="19" height="17" />
                        </a>
                        <a href="#" class="limpaModal" title="Limpar o Fornecedor">
                            <img src="img/limpar.png" alt="Limpar" width="15" height="15" />
                        </a>
                    </span>
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Quantidade:
                    </label>
                    <input type="text" name="quantidade" id="quantidade" class="integer readOnly" value="<? echo $_POST['quantidade']; ?>" />
                </p>
                <div class="clear"></div>
                <p>
                    <label class="labelForm">
                        Valor:
                    </label>
                    <input type="text" name="valor" id="valor" class="decimal" value="<? echo $_POST['valor']; ?>" />
                </p>
                <div class="clear"></div>
                <div class="floatRight" style="margin:4%">
                	<input type="button" name="btnCancelar" class="btnCancelar btn btn-default" value="Voltar"/> 
					<? if($_POST['act'] == 'upd'){ ?>
                        <input type="button" name="btnAlterar" class="btnCadastrar btn btn-info" value="Alterar" />
					<? } else{ ?>
                        <input type="button" name="btnCadastrar" class="btnCadastrar btn btn-info" value="Cadastrar" />
					<? } ?>
                </div>
                <div class="clear"></div>
            </fieldset>
		</form>
	</body>
<?
	require_once("modal/modalFornecedor.php");
	require_once("personalizado/alerta.php");
	require_once("conADODBclose.php");
?>
</html>