<?
	require_once ("classes/autoload.php");
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	
?>
    <link rel="stylesheet" type="text/css" href="personalizado/projeto.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="personalizado/shadowbox.css" />
    <script src="tool/jquery.js" language="javascript"></script>
    <script src="tool/shadowbox/shadowbox.js" language="javascript"></script> 
    <script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap-3.1.1/js/bootbox.min.js"></script>
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
            $(".detalhes").click(function(e) {
                $("#nome").html($(this).attr("nome") + '<br>');
                $("#cpf").html($(this).attr("cpf") + '<br>');
                $("#cep").html($(this).attr("cep") + '<br>');
                $("#telefone").html($(this).attr("telefone") + '<br>');
                $("#celular").html($(this).attr("celular") + '<br>');
                $("#pessoa").html($(this).attr("pessoa") + '<br>');
                $("#tipo").html($(this).attr("tipo") + '<br>');
                $("#produto").html($(this).attr("produto") + '<br>');
            });
        });
    </script>
    <style>
		body{
			margin:0 12%;
		}
	</style>
    <h1>
       Vendas
    </h1>
    <a href="com.compraEfetuar.php" title="Nova Compra" rel="shadowbox;width=700;height=500;" style="text-decoration:none">
        <input type="button" class="btn btn-info" value="Nova Venda" id="btnCompra" style="cursor:pointer" />
    </a>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr> 
                <th width="5%">
                    Código
                </th>
                <th width="26%">
                    Cliente
                </th>
                <th width="25%">
                    Produto
                </th>              
                <th width="12%">
                    Qtde Vendida
                </th>
                <th width="12%">
                    Valor Total
                </th>
                <th width="20%">
                    Data de cadastro
                </th>
            </tr>
        </thead>
        <tbody>
<?
			$quantidadeEstoque = 0;
			$quantidadeCompra = 0;
			$valorTotal = 0;				
			pagination('CompraDAO', 2, 10);
			if(! is_null($oLC)){
				foreach($oLC as $oCO){
					$quantidadeEstoque += $oCO->getIdProduto()->getQuantidade();
					$quantidadeCompra += $oCO->getQuantidadeCompra();
					$valorTotal += $oCO->getIdProduto()->getValor()*$oCO->getQuantidadeCompra();
?>    
                    <tr>
                        <td align="center">
                            <? echo $oCO->getCodigo(); ?>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#myModal" class="detalhes" nome="<? echo $oCO->getIdCadastro()->getNome(); ?>" cpf="<? echo $oCO->getIdCadastro()->getCPF() . $oCO->getIdCadastro()->getCNPJ(); ?>" cep="<? echo $oCO->getIdCadastro()->getCEP(); ?>" telefone="<? echo $oCO->getIdCadastro()->getTelefone(); ?>" celular="<? echo $oCO->getIdCadastro()->getCelular(); ?>" pessoa="<? echo $oCO->getIdCadastro()->getInPessoaDescricao(); ?>"  tipo="<? echo $oCO->getIdCadastro()->getInTipoDescricao(); ?>" produto="<? echo $oCO->getIdProduto()->getDescricao(); ?>">
                                <? echo $oCO->getIdCadastro()->getNome(); ?>
                            </a>
                        </td>
                        <td>
                            <? echo $oCO->getIdProduto()->getDescricao(); ?>
                        </td>         
                        <td style="text-align:center">
                            <? echo $oCO->getQuantidadeCompra(); ?>
                        </td>                     
                        <td align="center">
                            R$ <? echo number_format($oCO->getValorTotal(), 2, ",", "."); ?>
                        </td>
                        <td align="center">
                            <? echo $oCO->getDataCadastro()->getDMYHMS(); ?>
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
                    <marquee>Total</marquee>
                </th>               
                <th style="text-align:center">
                    <? echo $quantidadeCompra; ?>
                </th>
                <th style="text-align:center">
                    <? echo number_format($valorTotal, 2, ",", "."); ?>
                </th>
                <th align="left">
                    <span>Total de registros: </span><? echo $totalRegistros; ?>
                </th>
            </tr>
        </tfoot>
    </table>
<?			
	paginacaoBtn($pagina,'com.compra',$numPages);

	require_once("modal/modalCompra.php"); 
	require_once ("conADODBclose.php"); 
?>