<?
	pg_connect("host=localhost dbname=sistema user=sistema password=sistema") or die ('não foi possível conectar');	
	$query = pg_query('SELECT * FROM cadastro ORDER BY "idCadastro"');
	$linha = pg_num_rows($query);
?>
<!DOCTYPE html>
<html> 
	<head> 
		<meta content="charset=utf-8"> 
		<title>ajax is not a new programming language</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<script language="javascript" src="jquery.js"></script>
		<script language="javascript" src="aplicacao.js"></script>
		<script>
			$(document).ready(function(){
				$('#cpf').keydown(function(){
					//alert();
				});
			});
		</script>
	</head>
	<body> 
		<div style="width:500px; margin:auto;">		 
			<form action="mantemPessoas.php" method="post">
				<fieldset>
					<legend>Dados do Cliente</legend>
					<p>
						<label for="cpf">CPF: </label>
						<input type="text" id="cpf" name="cpf" />		
					</p>
					<!--p>
						<label for="nome">Nome: </label>
						<input type="text" id="nome" name="nome" />
					</p>
					<p>
						<label for="email">Data Nascimento: </label>
						<input type="text" id="email" name="email" />
					</p-->
				</fieldset>
				<textarea cols="30"> </textarea>
			</form>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>
							Nome
						</th>
						<th>
							email
						</th>
						<th>
							cpf
						</th>
					</tr>
				</thead>
				<tbody>
<?
					if($linha >0){
						while($contato = pg_fetch_assoc($query)){
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
?>
				</tbody>
			</table>
		</div>
	</body> 
</html>