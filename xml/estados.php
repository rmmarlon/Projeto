<select name="estado">
	<option value='0'>Selecione seu estado</option>
    
<?
	$xml = simplexml_load_file("estados.xml");
	
	foreach($xml->cidade as $cid){
		echo "<option value='$cid->codigo.'>".$cid->uf . " - " . $cid->nome . "</option>";
	}
?>
</select>