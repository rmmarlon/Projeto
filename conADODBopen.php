<?
	require_once("tool/adodb/adodb.inc.php");
	require_once("tool/adodb/adodb-exceptions.inc.php");
	$server = "localhost";
	$user = "projeto";
	$pass = "projeto";
	$name = "projeto";
	$conexao = sprintf("host=%s dbname=%s user=%s password=%s",
							 $server,
							 $name,
							 $user,
							 $pass); 
	$db = NewADOConnection('postgres');
	if(! $db->PConnect($conexao)){
		echo "falha de conexão";
	}
?>