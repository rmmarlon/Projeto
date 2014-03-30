<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>
        	Gerador de Senha
        </title>
    </head>    
    <body>
<?
	$conso = "BCDFGHKKLmnpqrsutvxwyzbcdfghjklMNPQRSTUVXWYZ";
	$vogal = "AEaeIiouOU";
	$num = "!012@345<67&89$";
	
	$y = strlen($conso)-1;
	$x = strlen($vogal)-1;
	$z = strlen($num)-1;
	
	for ($i=0; $i<1; $i++){
		$rand = rand(0,$y);
		$rand2 = rand(0,$x);
		$rand3 = rand(0,$z);
		
		$str = substr($conso, $rand,3);
		$str2 = substr($vogal, $rand2,3);
		$str3 = substr($num, $rand3,3);
		
		$password = $str . $str2 . $str3;
		print $password;
	}
?>
    </body>
</html>