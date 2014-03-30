<?php
	pg_connect("host=localhost dbname=sistema user=sistema password=sistema") or die ('não foi possível conectar');	
	#$cpf = $_GET['cpf'];
	$palavra = trim($_GET['cpf']);   
	#$a = $_GET['a'];
	// Verificamos se a ação é de busca 
	if ($palavra != '') {   
		// Pegamos a palavra 
		
		// Verificamos no banco de dados produtos equivalente a palavra digitada 
		$sql = pg_query("SELECT * FROM cadastro WHERE cpf LIKE '%".$palavra."%' ORDER BY nome");   
		// Descobrimos o total de registros encontrados 
		$numRegistros = pg_num_rows($sql);   
		// Se houver pelo menos um registro, exibe-o 
		if ($numRegistros != 0) { 
		// Exibe os produtos e seus respectivos preços 
			while ($contato = pg_fetch_assoc($sql)) { 
?>
				<tr>
					<td id="nome" name="nome">
						<? echo $contato['nome']; ?>
					</td>
					<td id="email" name="email">
						<? echo $contato['email']; ?>
					</td>
					<td>
						<? echo $contato['cpf']; ?>
					</td>
				</tr>
<?
			#echo $produto['nome'].'-'. $produto['email'];
			} // Se não houver registros 
		} else { 
			echo "nenhum registro encontrado";
		} 
	} else{
		$sql = pg_query('SELECT * FROM cadastro ORDER BY "idCadastro"');
		$linha = pg_num_rows($sql);
		while ($contato = pg_fetch_assoc($sql)) { 
?>
			<tr>
				<td id="nome" name="nome">
					<? echo $contato['nome']; ?>
				</td>
				<td id="email" name="email">
					<? echo $contato['email']; ?>
				</td>
				<td>
					<? echo $contato['cpf']; ?>
				</td>
			</tr>
<?
		}
	}
	/*$pessoas['000.000.000-00']['nome'] = "Exemplo1";
	$pessoas['000.000.000-00']['dataNascimento'] = "16/06/1986";
	$pessoas['111.111.111-11']['nome'] = "Exemplo2";
	$pessoas['111.111.111-11']['dataNascimento'] = "20/01/1932";
	$pessoas['222.222.222-22']['nome'] = "Exemplo3";
	$pessoas['222.222.222-22']['dataNascimento'] = "23/04/1914";
	echo $pessoas[$cpf]['nome'] ."-". $pessoas[$cpf]['dataNascimento'];
	*/
	#echo $cpf . '-' . $cpf;
?>
