<?
	$p[0] = "abacate";
	$p[1] = "abobora";
	$p[2] = "banana";
	$p[3] = "beco";
	$p[4] = "cabo";
	$p[5] = "cebo";
	$p[6] = "dedo";
	$p[7] = "dado";
	$p[8] = "elefante";
	$p[9] = "faca";
	$p[10] = "gato";
	$p[11] = "porta";
	
	$search = $_GET['s'];
	echo $search;
	$x = 0;
	$res = "{'pal ':[";
	for ( $x = 0 ; $x<11; $x++){
		if($search==substr($p[$x], 0,strlen($search))){
			echo $res .= "'" . $p[$x] . " '," ;
		}
	}
	$res = substr($res , 0, (strlen($res)));
	$res .= "]}";
	#echo substr($p[$x], 0,strlen($search));
?>