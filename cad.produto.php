<?
	require_once ("classes/autoload.php");
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	
	#declarar variável
?>
    <link rel="stylesheet" type="text/css" href="personalizado/projeto.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css">
    <link href="tool/shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />     
    <script src="tool/jquery.js" language="javascript"></script>
    <script src="tool/shadowbox/shadowbox.js" language="javascript"></script> 
    <script src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.1.1/js/bootbox.min.js"></script>
    <script type="text/javascript" src="tool/script.js"></script>
    <script language="javascript">
        $(document).ready(function(e) {
            Shadowbox.init({  
                handleOversize: "drag",
                modal: true,//manter a shadowbox fixa mesmo ao clicar fora dela
                onClose : function(){
                    $("form").submit();
                }
            });
            $(".cadProd").click(function(e) {
                $("#idProduto").val($(this).attr("idCodigo"));
                $("form").attr("action", "est.produto.compra.php");
                $("form").submit();
            });
            $(".callpage").click(function(e) {
                var upd = $(this).attr('act');
                $("#act").val($(this).attr("act"));
                $("#idProduto").val($(this).attr("id"));
                $("#mcf").val($(this).attr("mcf"));
                if(upd == 'upd'){
                    bootbox.prompt('Insira a Senha', function(valida){
                        if(valida){
							if($(".modal-body form input").val() == 'cardoso'){
								$("form").attr("action", "cad.produto.edit.php");
								$("form").submit();
							} else{
								bootbox.alert('A senha esta incorreta');
							}
                        }
                    });
                } else{
                    $("form").attr("action", "cad.produto.edit.php");
                    $("form").submit();
                }
            });
            $("#legend").mouseover(function(e) {
               $("#lgdOpcoes").fadeIn(500);
            })
            $("#legend").mouseout(function(e) {             
                $("#lgdOpcoes").fadeOut(500);
            });
        });
    </script>
    <style type="text/css">
        body{
            margin:0 12%;
        }
        a{
            color:FFF;
            text-decoration:none;
        }
        
    </style>
    <h1>
        Lista Produto
    </h1>
    <form name="frmLista" method="post">
        <input type="hidden" name="act" id="act" />
        <input type="hidden" name="idProduto" id="idProduto" />
        <input type="button" name="btnNovo" value="Novo Produto" class="callpage btn btn-info floatLeft" id="" act="add" />
    </form>
    <span id="legend">
        Legenda
    </span>
    <div id="lgdOpcoes">
        <img src="img/add.png" alt="Adicionar Produto" width="16" height="16" />			
        Comprar mais de um Produto
        <img src="img/alterar.png" alt="Alterar" width="16" height="16" />
        Atualizar um Produto
    </div>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="6%">
                    Código
                </th>
                <th>
                    Produto
                </th>
                <th>
                    Fornecedor
                </th>
                <th width="8%">
                    Quantidade
                </th>
                <th>
                    Valor
                </th>
                <th>
                    Valor Total
                </th>                  
                <th width="18%">
                    Data de cadastro
                </th>
                <th width="5%" class="legend">
                    Editar
                </th>
                <th class="legend" style="text-align:center">
                    +
                </th>
            </tr>
        </thead>
        <tbody>
<?	
            $quantidadeEstoque = 0;
            $valor = 0;
            $valorTotal = 0;
            pagination('ProdutoDAO', 3, 8);
            if(! is_null($oLC)){
                foreach($oLC as $oP){
                    $quantidadeEstoque += $oP->getQuantidade();
                    $valor += $oP->getValor();
                    $valorTotal += $oP->getValor()*$oP->getQuantidade();
?>

                    <tr>
                        <td align="center">
                            <? echo $oP->getCodigo(); ?>
                        </td>
                        <td>
                            <? echo $oP->getDescricao(); ?>
                        </td>
                        <td>
                            <? echo is_null($oP->getIdCadastro()) ? 'Não Possui' : $oP->getIdCadastro()->getNome(); ?>
                        </td>
                        <td style="text-align:center">
                            <? echo $oP->getQuantidade(); ?>
                        </td>
                        <td align="center">
                            R$: <? echo ' ' . number_format($oP->getValor(), 2, ",","."); ?>
                        </td>
                        <td align="center">
                            R$: <? echo ' ' . number_format($oP->getValor()*$oP->getQuantidade(), 2, ",","."); ?>
                        </td>
                        <td align="center">
                            <? echo $oP->getDataCadastro()->getDMYHMS(); ?>
                        </td>
                        <td align="center">
                            <a href="#" title="Alterar" class="callpage" act="upd" id="<? echo $oP->getCodigo(); ?>">
                                <img src="img/alterar.png" alt="Alterar" width="16" height="16" />
                            </a>
                        </td>
                        <td style="text-align:center">
                            <a href="#" class="cadProd" style="cursor:pointer" idCodigo="<? echo $oP->getCodigo(); ?>" title="Comprar mais">
                                <img src="img/add.png" alt="Adicionar Produto" width="16" height="16" />
                            </a>
                        </td>
                    </tr>
<?
                }
            }
?>	
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" align="left">
                    Total 
                </th>
                <th style="text-align:center">
                    <? echo $quantidadeEstoque; ?>
                </th>
                <th>
                    R$: <? echo number_format($valor, 2, ",", "."); ?>
                </th>
                <th>
                    R$: <? echo ' ' . number_format($valorTotal, 2, ",", "."); ?>
                </th>
                <th colspan="3"><span>Total de registros: </span><? echo $totalRegistros; ?></th>
            </tr>
        </tfoot>
    </table>
<?			
	paginacaoBtn($pagina,'cad.produto',$numPages);
   
	require_once ("conADODBclose.php"); 
?>