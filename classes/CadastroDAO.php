<?
	/*
			Autor : Marlon R Cardoso
			Data : 18/10/2013
			
			Arquivo: CadastroDAO.php
			Descrição: Funções (load,add,delete,select) da tabela cadastro.
			
			Data        Responsável         Breve Definição
			==========  ==================  ==================================================
			21/10/2013  Marlon R Cardoso	  Definicão inicial
	*/
	require_once("autoload.php");
 
	 class CadastroDAO{
		 private $sql = NULL;
		 
		 public function getSQL(){
			 return $this->sql;
		 }
		 private function load($rs){
			 return new Cadastro($rs->Fields("idCadastro"),
										$rs->Fields("nome"),
										$rs->Fields("cpf"),
										$rs->Fields("cnpj"),
										$rs->Fields("responsavel"),
										$rs->Fields("cep"),
										$rs->Fields("telefone"),
										$rs->Fields("celular"),
										$rs->Fields("mae"),
										$rs->Fields("dataNascimento"),
										$rs->Fields("fundacao"),
										$rs->Fields("inSexo"),
										$rs->Fields("inTipo"),
										$rs->Fields("inPessoa"),
										$rs->Fields("inPorte"),
										$rs->Fields("dataCadastro"),
										$rs->Fields("dataAlteracao"));
		 }
		  
		 #add
		 public function add(&$obj){
			 global $db;
			 
			 $return = false;
			 
			 if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "cadastro" ("nome",
															  "cpf",
															  "cnpj",
															  "responsavel",
															  "cep",
															  "telefone",
															  "celular",
															  "mae",
															  "dataNascimento",
															  "fundacao",
															  "inSexo",
															  "inTipo",
															  "inPessoa",
															  "inPorte",
															  "dataCadastro")
															  VALUES(%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%s,
																		%u,
																		%u,
																		%u,
																		%u,
																		now());',
									$db->qstr($obj->getNome()),
									$obj->getCPF() == "" ? 'NULL' : $db->qstr($obj->getCPF()),
									$obj->getCNPJ() == "" ? 'NULL' : $db->qstr($obj->getCNPJ()),
									is_null($obj->getResponsavel()) ? 'NULL' : $db->qstr($obj->getResponsavel()),
									$db->qstr($obj->getCEP()),
									$db->qstr($obj->getTelefone()),
									$db->qstr($obj->getCelular()),
									is_null($obj->getMae()) ? 'NULL' : $db->qstr($obj->getMae()), 
									$obj->getDataNascimento() == "" ? 'NULL' : $db->qstr($obj->getDataNascimento()->getYMD()),
									$obj->getFundacao() == "" ? 'NULL' : $db->qstr($obj->getFundacao()->getYMD()),
									$obj->getInSexo() == "" ? 'NULL' : $obj->getInSexo(),
									$obj->getInTipo(),
									$obj->getInPessoa(),
									$obj->getInPorte() == "" ? 'NULL' : $obj->getInPorte());
				$db->BeginTRans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return  = true;
					
					$sqlInsert = sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
					
					$obj->updIdCadastro($rs->Fields("ins_id"));
				}	catch (exception $e){
					$db->RollBackTrans();
				}
			 }
			 return $return;
		 }
		 #update
		 public function update(&$obj){
			 global $db;
			 
			 $return = false;		 
			 $this->sql = "";
			 
			 if(! is_null($obj)){
				 $this->sql = sprintf('UPDATE "cadastro"
															SET "nome"  = %s,
																  "cpf" = %s,
																  "cnpj" = %s,
																  "responsavel" = %s,
																  "cep" = %s,
																  "telefone" = %s,
																  "celular" = %s,
																  "mae" = %s,
																  "dataNascimento" = %s,
																  "fundacao" = %s,
																  "inSexo" = %u,
																  "inTipo" = %u,
																  "inPessoa" = %u,
																  "inPorte" = %s,
																  "dataAlteracao" = now()
															WHERE "idCadastro" = %u;',
																  
											$db->qstr($obj->getNome()),
											is_null($obj->getCPF()) ? 'NULL' : $db->qstr($obj->getCPF()),
											is_null($obj->getCNPJ()) ? 'NULL' : $db->qstr($obj->getCNPJ()),
											is_null($obj->getResponsavel()) ? 'NULL' : $db->qstr($obj->getResponsavel()),
											$db->qstr($obj->getCEP()),
											$db->qstr($obj->getTelefone()),
											$db->qstr($obj->getCelular()),
											$db->qstr($obj->getMae()),
											is_null($obj->getDataNascimento()) ? 'NULL' : $db->qstr($obj->getDataNascimento()->getYMD()),
											is_null($obj->getFundacao()) ? 'NULL' : $db->qstr($obj->getFundacao()->getYMD()),
											$obj->getInSexo(),
											$obj->getInTipo(),
											$obj->getInPessoa(),
											$obj->getInPorte() == '' ? 'NULL' : $obj->getInPorte(),
											$obj->getCodigo());
								
				$db->BeginTRans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return  = true;						
				}	catch (exception $e){
					$db->RollBackTrans();
				}
			 }
			 return $return;
		 }
		 #delete
		 public function delete(&$obj){
			global $db;
			
			$return = false;
			$this->sql = "";
			
			if(! is_null($obj)){
				$this->sql = sprintf('DELETE FROM "cadastro"
																WHERE "idCadastro" = %u;',
																$obj->getCodigo());
				$db->BeginTRans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return  = true;
				}	catch (exception $e){
					$db->RollBackTrans();
				}
			}
			return $return;
		 }
		 #consulta
		 public function select($option,
										$key = NULL,
										$order = NULL){
			global $db;
			$return = NULL;
			$this->sql = "";
			
			switch($option){
				case 0:
					$this->sql = sprintf('SELECT *
													FROM "cadastro"
													ORDER BY "nome"
													LIMIT(1000)');
	
					$rs = $db->Execute($this->sql);
					
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
				
				case 1:
					$this->sql = sprintf('SELECT *
														FROM "cadastro"
															WHERE "idCadastro" = %u;',
															$key);

					$rs = $db->Execute($this->sql);

					if (! $rs->EOF){
						$return = $this->load($rs);
					}
					$rs->Close();
				break;
				
				case 2:
					$this->sql = sprintf('SELECT *
													FROM "cadastro"
													WHERE "inTipo" = 0
													ORDER BY "idCadastro"');
	
					$rs = $db->Execute($this->sql);
					
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
				case 3:
					$this->sql = sprintf('SELECT *
											FROM "cadastro"
											WHERE "inTipo" = 1
											ORDER BY "idCadastro"');
	
					$rs = $db->Execute($this->sql);
					
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
				
				case 4:
					$this->sql = sprintf('SELECT *
											FROM "cadastro"
											ORDER BY "idCadastro"
											OFFSET %u
											LIMIT %u',
										$key[0],
										$key[1]);

					$rs = $db->Execute($this->sql);
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
				
				case 5:
					$this->sql = sprintf('SELECT *
											FROM "cadastro"
											WHERE (%s ILIKE \'%%%s%%\')
											ORDER BY "idCadastro"',
										$key[0],
										$key[1]);
					
					$rs = $db->Execute($this->sql);
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
				
				case 6:
					$this->sql = sprintf('SELECT *
											FROM "cadastro"
											WHERE %s ILIKE \'%%%s%%\'
											ORDER BY "idCadastro"
											OFFSET %u
											LIMIT %u',
										$key[0],
										$key[1],
										$key[2],
										$key[3]);
					$rs = $db->Execute($this->sql);
					while(! $rs->EOF){
						$return[] = $this->load($rs);
						$rs->MoveNext();
					}
					$rs->Close();
				break;
			}
			return $return;
		}		
	 }
?>