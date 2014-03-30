<?
	header("Content-Type:text/html; charset=utf-8");
	$estado = $_GET['estado'];
	$cidades = "" ;
	switch($estado){
		case 'pr':
			$cidades .= "<option value='1'> Tupãssi </option>";
			$cidades .= "<option value='2'> Toledo </option>";
			$cidades .= "<option value='3'> Cascavel </option>";
			$cidades .= "<option value='4'> Pato Branco </option>";
		break;
		
		case 'rs':
			$cidades .= "<option value='5'> Porto alegre</option>";
			$cidades .= "<option value='6'> Palmeiras </option>";
			$cidades .= "<option value='7'> Santos </option>";
		break;
		
		case 'sp':
			$cidades .= "<option value='8'> mogi das cruzes</option>";
			$cidades .= "<option value='9'> Palmeiras </option>";
			$cidades .= "<option value='10'> Santos </option>";
		break;
	}

	echo $cidades;
?>