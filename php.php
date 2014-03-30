<?php
	mysql_connect("localhost","root","");
	mysql_select_db("pesquisa");
	
	$busca = $_GET['busca'];

	if($busca != "") {
		$sql = "SELECT * FROM cadastros WHERE cadastro LIKE '%$busca%' ORDER BY cadastro ASC ";
		$query = mysql_query($sql);
		
		//variavel para zebrar as linhas
		$cont = 0;
		while($row = mysql_fetch_object($query)) {
			//faz a diferenciação das cores para as linhas dos resultados
			if($cont %2 ==0) {
				$cor = "#EDEDED";
			} else {
				$cor = "#FFFFFF";
			}
			echo "<div style='background:$cor'>";
			echo $row->idcadastro. " - ";
			echo $row->cadastro."<br>";
			echo "</div>";
			$cont ++;
		}
	}
?>