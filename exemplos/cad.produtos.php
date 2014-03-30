<?
	#require_once("controleSessao.php");
	require_once("conADODBopen.php");
	require_once("tool/funcoes.php");
	require_once("classes/autoload.php");
	#declaracao das variaveis
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	if(! isset($_POST['idProdutosExclusao'])){
		$_POST['idProdutosExclusao'] = NULL;
	}
	if($_POST['acao'] == "cadastrar"){
		$oP = new Produtos(NULL,
								 $_POST['descricao'],
								 corrigeValor($_POST['valor']),
								 $_POST['quantidadeEstoque'],
								 0);
								 
		$dao = new ProdutosDAO();
		if($dao->add($oP)){
			echo "Cadastro	realizado com sucesso!!";
		} else {
			echo "Falha ao cadastrar!!";
		}
		
	}
	
	if($_POST['idProdutosExclusao'] == 'excluir'){
		$dao = new ProdutosDAO();
		$oP = $dao->select(1, $_POST['idProdutosExclusao']);	
		$oP->updSituacao(1);
		if($dao->update($oP)){
			echo "Produto excluído com sucesso!!";	
		} else {
			echo "Falha ao excluir o produto!!";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   	<title>
   		Documento sem título
      </title>
      <link href="personalizado/estilo.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="personalizado/dataTable.css"/>
      <script src="tool/jquery.js" language="javascript"></script>
		<script type="text/javascript" src="tool/dataTable.js"></script>
      <script src="tool/script.js" language="javascript"></script>
      <script language="javascript">
			$(document).ready(function(e) {
				$("#tblDataTable").dataTable();
            $("#btnCadastrar").click(function(e) {
               if($("#descricao").val().length < 2){
						alert("Favor preencher a descrição com mo minimo 2 dígitos!");
					} else if($("#valor").val() ==  "0,00"){
						alert("Favor preencher com o valor do produto!");
					} else if($("#quantidadeEstoque").val() == ""){
						alert("Favor preencher com a quantidade!");
					} else{
						$("#acao").val('cadastrar');
						$("form").submit();
					}
            });
				$(".inExcluir").click(function(e) {
               var idCodigo = $(this).attr("idCodigo");
					var descricao = $(this).attr("descricao");
					var confirmacao = jConfirm("Você deseja excluir o produto " + descricao + "?");
					
					if(confirmacao){
						$("#idProdutosExclusao").val('excluir');
						$("form").submit();	
					}
            });
         });
		</script>
      <style type="text/css">
			.clear{
				clear:both;
			}
			label{
				width:150px;
				float:left;
				text-align:right;
				margin-right:3px;
			}
			#produtos{
				width:355px;
				margin:auto;
				background:#a89d5a;
				padding:15px;
			}
			.floatRight{
				float:right;
			}
      </style>
   </head>
   <body>
      <form method="post">
      	<input type="hidden" name="acao" id="acao" />
         <input type="hidden" name="idProdutosExclusao" id="idProdutosExclusao" />
         <div id="produtos">
         	<p>
      	      <label for="descricao">Descrição: </label>
               <input type="text" name="descricao" id="descricao" maxlength="24" />          
            </p>
            <div class="clear"></div>
            <p>
            	<label for="valor">Valor: </label>
               <input type="text" name="valor" id="valor" class="decimal" />
            </p>
            <div class="clear"></div>
            <p>
            	<label for="quantidadeEstoque">Quantidade Estoque: </label>
               <input type="text" name="quantidadeEstoque" id="quantidadeEstoque" class="integer" size="1" />
            </p>
            <div class="clear"></div>
            <div class="floatRight">
            	<input type="button" value="CADASTRAR" id="btnCadastrar" />
            </div>
            <div class="clear"></div>
         </div>
         <hr />
         <caption>
         	Produtos cadastrados 
         </caption>
         <table cellpadding="2" id="tblDataTable">
         	<thead>
            	<tr>
               	<th>
                  	ID	
                  </th>
                 	<th width="120">
							Descrição
                 	</th>
                  <th>
                  	Quantidade
                  </th>
                 	<th width="90">
              			Valor
                 	</th>
                  <th width="120">
                  	Total
                  </th>
                  <th>
                  	Excluir
                  </th>
               </tr>
            </thead>
            <tbody>
<?
					$dao = new ProdutosDAO();
					$oLP = $dao->select(2);
					$totalQuantidade = 0;
					$totalValor = 0;
					$i = 0;
					foreach($oLP as $oP){
						$totalQuantidade += $oP->getQuantidadeEstoque();
						$totalValor += $oP->getValor()*$oP->getQuantidadeEstoque();
						$bgColor = "#34f";
						if($i%2 == 0){
							$bgColor="#78f";	
						}
?>
						<tr bgcolor="<? echo $bgColor; ?>">
                  	<td>
                     	<? echo $oP->getCodigo(); ?>
                     </td>
                     <td>
                     	<? echo $oP->getDescricao(); ?>
                     </td>
                     <td align="center">
                     	<? echo $oP->getQuantidadeEstoque(); ?>
                     </td>
                     <td align="right">
                     	R$: <? echo number_format($oP->getValor(), 2, ",","."); ?>
                     </td>
                     <td align="right">
                     	R$: <? echo number_format($oP->getValor()*$oP->getQuantidadeEstoque(), 2, ",","."); ?>
                     </td>
                     <td align="center">
                     	<a href="#" class="inExcluir" idCodigo="<? echo $oP->getCodigo(); ?>" descricao="<? echo $oP->getDescricao(); ?>"><img src="img/cancelar.png" alt="EXCLUIR" /></a>
                     </td>
                  </tr>
<?
						$i++;
					}
?>	
            </tbody>
            <tfoot>
            	<tr>
               	<th colspan="2" align="left">
                  	Total
                  </th>
                  <th>
                  	<? echo $totalQuantidade; ?>
                  </th>
                  <th>
                  
                  </th>
                  <th align="right">
                  	R$: <? echo number_format($totalValor, 2, ",","."); ?>
                  </th>
                  <th>
                  
                  </th>
               </tr>
            </tfoot>
         </table>
      </form>
   </body>
</html>