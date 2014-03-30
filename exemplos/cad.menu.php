<?
	//require_once "personalizado/controleSessao.php";
	/*
		Autor : Leandro Ferreira Marcelli
		Data : 15/12/2012
		
		Arquivo: cad.menu.php
		Descrição: Tela principal do cadastro da tabela menu
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		15/12/2012  Leandro F Marcelli  Definicão inicial
	*/
	require_once "conADODBopen.php";
	//require_once "personalizado/config.php";
	require_once "classes/autoload.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			<? echo TITULO; ?>
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="personalizado/estilo.css" rel="stylesheet" type="text/css" />
		<link href="personalizado/dataTable.css" rel="stylesheet" type="text/css" />
		<script charset="utf-8" language="javascript" src="tool/jquery.js"></script>
		<script charset="utf-8" language="javascript" src="tool/dataTable.js"></script>
		<script charset="utf-8" language="javascript">
		<!--
			$(document).ready(function(e){
				$("#menu").dataTable({
					"sScrollY": "25em",
					"iDisplayLength" : 50
				});
				
				$(".callPage").live("click",function(){
					$("form").attr("action", "cad.menu.edit.php");
					$("#act").val($(this).attr("act"));
					$("#idMenu").val($(this).attr("id"));
					$("form").submit();
				});
			});
		-->
		</script>
	</head>
	<body>
		<h1>
			Cadastro de menu
		</h1>
		<br />
		<form name="frmLista" method="post">
			<input type="hidden" name="idMenu" id="idMenu" />
			<input type="hidden" name="act" id="act" />
			<input type="button" class="floatLeft callPage" id="" act="add" value="Adicionar Novo"  />
			<div id="clear"></div>
			<br />
			<table cellspacing="0" id="menu">
				<thead>
					<tr>
						<th align="center">
							Código
						</th>
						<th>
							MenuPai
						</th>
						<th>
							Descricao
						</th>
						<th>
							Pagina
						</th>
						<th>
							Consulta
						</th>
						<th>
							Altera
						</th>
						<th>
							Adiciona
						</th>
						<th>
						</th>
						<th>
							Data Cadastro
						</th>
						<th>
							Data Alteração
						</th>
                  <th>
                  </th>
					</tr>
				</thead>
				<tbody>
<?
					$dao = new MenuDAO();
					$lista = $dao->select(0);

					if (! is_null($lista)){
						$i = 0;
						foreach($lista as $obj){
?>
							<tr>
								<td align="center">
									<? echo $obj->getCodigo(); ?>
								</td>
								<td>
									<? echo is_null($obj->getIdMenuPai()) ? 'NULL' : $obj->getIdMenuPai()->getCodigo() . " - " . $obj->getIdMenuPai()->getDescricao(); ?>
								</td>
								<td>
									<? echo $obj->getDescricao(); ?>
								</td>
								<td>
									<? echo $obj->getPagina(); ?>
								</td>
								<td>
									<? echo $obj->getInConsulta() . " - " . $obj->getInConsultaDescricao(); ?>
								</td>
								<td>
									<? echo $obj->getInAltera() . " - " . $obj->getInAlteraDescricao(); ?>
								</td>
								<td>
									<? echo $obj->getInAdiciona() . " - " . $obj->getInAdicionaDescricao(); ?>
								</td>
								<td>
									<a href="#" class="callPage" id="<? echo $obj->getCodigo(); ?>" act="upd"><img src="img/alterar.png" border="0" /></a>
									<!--<a href="javascript:callPage(<? //echo $obj->getCodigo(); ?>, 'del');"><img src="img/cancelar.png" border="0" /></a>-->
								</td>
								<td>		
									<? echo $obj->getDataCadastro()->getDMYHMS(); ?>
								</td>
								<td>
									<? echo is_null($obj->getDataAlteracao()) ? "" : $obj->getDataAlteracao()->getDMYHMS(); ?>
								</td>
                        <td>
                        </td>
							</tr>
<?
						}
					}
?>
				</tbody>
			</table>
			<br />
			<input type="button" value="Adicionar Novo" class="callPage" id="" act="add"  />
		</form>
	</body>
</html>
<?
	require_once "conADODBclose.php";
?>