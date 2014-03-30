<style>
	body{
		background:#096;
	}
	ul{
		list-style:none;
	}
</style>
<?
	function abrirTags($parser, $elemento){
		if($elemento == "AGENDA"){
			echo "Lista de Cotatos";
			echo "<ul>";
		}
		if($elemento == "CONTATO"){
			echo "<li> Contato: <ul>";
		}
		if($elemento == "NOME"){
			echo "<li>";
		}
		if($elemento == "FONE"){
			echo "<li>";
		}
	}
	function exibeDados($parser, $dados){
		echo "$dados";
	}
	function fecharTags($parser, $elemento){
		if($elemento == "AGENDA"){
			echo "</ul>";
		}
		if($elemento == "CONTATO"){
			echo "</ul></li>";
		}
		if($elemento == "NOME"){
			echo "</li>";
		}
		if($elemento == "FONE"){
			echo "</li>";
		}
	}
	$parser = xml_parser_create();
	xml_set_element_handler($parser, "abrirTags", "fecharTags");
	xml_set_character_data_handler($parser, "exibeDados");
	$ponteiro = fopen("agenda.xml", "r");
	
	while($dados = fread($ponteiro, 4096)){
		xml_parse($parser, $dados);
	}
	xml_parseR_free($parser);
?>