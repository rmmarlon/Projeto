<?
	require_once ("classes/autoload.php");
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
        	Documento sem título
        </title>
        <script src="tool/jquery.js"></script>
        <script type="text/javascript">
			$(document).ready(function(){
				function loading_show(){
					$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
				}			
				function loading_hide(){
					$('#loading').fadeOut();
				} 
				function loadData(page){
					loading_show(); 
					$.ajax({
						type: "POST",
						url: "paginas.php",
						data: "page="+page,
						success: function(msg){
							$("#container").ajaxComplete(function(event, request, settings){
								loading_hide();
								$("#container").html(msg);
							});
						}
					});
				}
				loadData(1); // For first time page load default results
				$('#container .pagination li.active').live('click',function(){
					var page = $(this).attr('p');
					loadData(page);
				});
			});		
		</script>
	</head>
    <body>
<?

	$pagina = (isset($_POST['pagina']))? $_POST['pagina'] : 1;
	$dao = new ProdutoDAO();
	$oLP = $dao->select(0);
	
	$totalRegistro = count($oLP);
	$registros[1] = 5;
	
	$numPaginas = ceil($totalRegistro/$registros[1]);
	$registros[0] = ($registros[1]*$pagina)-$registros[1];
	$dao = new ProdutoDAO();
	$oLP = $dao->select(3, $registros);
	$total = count($oLP);
	
	foreach($oLP as $oC){
?>
		<div id="container">
        	<ul class="pagination">
            	<li>
        			<? echo $oC->getCOdigo(); ?>
            	</li>
            </ul>
        </div>
<?
	}
?>
    </body>
</html>