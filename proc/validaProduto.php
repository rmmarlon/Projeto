<?
	require_once ("../classes/autoload.php");	
	require_once ("../conADODBopen.php");
	require_once ("../tool/funcoes.php");
	
	$retorno = 0;
	
	$dao = new ProdutoDAO();
	$oP = $dao->select(2, $_POST['descricao']);
	
	if(! is_null($oP)){
		$retorno = 1;
	}
	echo $retorno;
	
	require_once ("../conADODBclose.php");
?>