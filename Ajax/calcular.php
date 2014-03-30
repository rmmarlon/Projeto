<?
	#sleep(2);
	switch($_GET['v3']){
		case '/':
			echo (int) $_GET['v1'] / (int) $_GET['v2'];
		break;
		case '-':
			echo (int) $_GET['v1'] - (int) $_GET['v2'];
		break;
		case 'x':
			echo (int) $_GET['v1'] * (int) $_GET['v2'];
		break;
		default:
			echo $_GET['v1'] + $_GET['v2'];
	}
?>