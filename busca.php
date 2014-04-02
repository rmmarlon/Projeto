
<?
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	require_once ("classes/autoload.php");
	//busca via ajax
	$busca[0] = 'nome';
	$busca[1] = isset($_GET['busca']) ? trim($_GET['busca']) : '';
	
	if($busca[1] != "") {
		$dao = new CadastroDAO();
		$oLC = $dao->select(5, $busca);
		$numRegistros = count($oLC);
		unset($dao);
			
		if($numRegistros == 0){
			$busca[0] = 'responsavel';
			$dao = new CadastroDAO();
			$oLC = $dao->select(5, $busca);
			$numRegistros = count($oLC);
			#unset($dao);
		}
		if(! is_null($oLC)){
			foreach($oLC as $oC){
?>
				<tr style="font-size:0.86em">		
					<td align="center" width="6%">
						<? echo $oC->getCodigo(); ?>
					</td>
					<td>
						<? echo $oC->getNome() == "" ? $oC->getResponsavel() : $oC->getNome(); ?>
					</td>
					<td>
						<? echo $oC->getResponsavel() == "" ? $oC->getNome() :$oC->getResponsavel(); ?>
					</td>
					<td>
						<? echo $oC->getCPF() . $oC->getCNPJ(); ?>
					</td>
					<td>
						<? echo $oC->getTelefone(); ?>
					</td>
					<td>
						<? echo $oC->getCelular(); ?>
					</td> 
					<td>	
						<? echo $oC->getInPessoaDescricao(); ?>
					</td>
					<td>
						<? echo $oC->getInTipoDescricao(); ?>
					</td>
					<td>
						<? echo ($oC->getInPorteDescricao()) == "" ? 'Pessoa Fisica' : $oC->getInPorteDescricao(); ?>
					</td>
					<td>
						<? echo $oC->getDataCadastro()->getDMYHMS(); ?>
					</td>
					<td style="text-align:center">
						<a href="#" title="Alterar" class="callpage" act="upd" id="<? echo $oC->getCodigo(); ?>">
							<img src="img/alterar.png" alt="Alterar" width="16" height="16" />
						</a>
					</td>
				</tr>
<?
			}
		}
		if($numRegistros == 0){
?>
			<th colspan="4"></th>
			<th colspan="3">
				<span class="close">Nenhum registro encontrado para palavra '<?=$busca[1];?>'<span id="fechar">&times;</span></span>	
			</th>
			<th colspan="4"></th>
<?
		} else{
?>
            <th colspan="9"></th>
            <th colspan="1">
                <span>Total de registros: </span><? echo $numRegistros; ?>
            </th>
            <th><a href="cad.cadastro.php">&laquo;</a></th>
            
<?	
		}
	} else{
		pagination('CadastroDAO', 4, 8);
		if(! is_null($oLC)){
			foreach($oLC as $oC){
?>
				<tr style="font-size:0.86em">								
					<td align="center" width="6%">
						<? echo $oC->getCodigo(); ?>
					</td>
					<td>
						<? echo $oC->getNome() == "" ? $oC->getResponsavel() : $oC->getNome(); ?>
					</td>
					<td>
						<? echo $oC->getResponsavel() == "" ? $oC->getNome() :$oC->getResponsavel(); ?>
					</td>
					<td>
						<? echo $oC->getCPF() . $oC->getCNPJ(); ?>
					</td>
					<td>
						<? echo $oC->getTelefone(); ?>
					</td>
					<td>
						<? echo $oC->getCelular(); ?>
					</td> 
					<td>	
						<? echo $oC->getInPessoaDescricao(); ?>
					</td>
					<td>
						<? echo $oC->getInTipoDescricao(); ?>
					</td>
					<td>
						<? echo ($oC->getInPorteDescricao()) == "" ? 'Pessoa Fisica' : $oC->getInPorteDescricao(); ?>
					</td>
					<td>
						<? echo $oC->getDataCadastro()->getDMYHMS(); ?>
					</td>
					<td style="text-align:center">
						<a href="#" title="Alterar" class="callpage" act="upd" id="<? echo $oC->getCodigo(); ?>">
							<img src="img/alterar.png" alt="Alterar" width="16" height="16" />
						</a>
					</td>
				</tr>
<?	
			}
		}
	}
	require_once("conADODBclose.php");
?>