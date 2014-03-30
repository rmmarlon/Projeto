<?
	require_once("autoload.php");
	
	class MenuDAO{
		private $sql = NULL;
	
		public function getSQL(){
			return $this->sql;
		}
		private function load($rs){
			return new Menu($rs->Fields("idMenu"),
								 $rs->Fields("idMenuPai"),
								 $rs->Fields("descricao"),
								 $rs->Fields("pagina"),
								 $rs->Fields("inConsulta"),
								 $rs->Fields("inAltera"),
								 $rs->Fields("inAdiciona"),
								 $rs->Fields("inPermissaoEspecial"),
								 $rs->Fields("descricaoPermissao"),
								 $rs->Fields("inSituacao"),
								 $rs->Fields("dataCadastro"),
								 $rs->Fields("dataAlteracao"));
		}
		##add
		public function add(&$obj){
			global $db;
			
			$return = false;
			
			if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "menu"("idMenuPai",
																		"descricao",
																		"pagina",
																		"inConsulta",
																		"inAltera",
																		"inAdiciona",
																		"inPermissaoEspecial",
																		"descricaoPermissao",
																		"inSituacao",
																		"dataCadastro")
																		VALUES(%s,
																				 %s,
																				 %s,
																				 %u,
																				 %u,
																				 %u,
																				 %u,
																				 %s,
																				 %u,
																				 now())',
										is_null($obj->getIdMenuPai()) ? 'NULL' : $obj->getIdMenuPai()->getCodigo(),
										$db->qstr($obj->getDescricao()),
										$db->qstr($obj->getPagina()),	
										$obj->getInConsulta(),
										$obj->getInAltera(),
										$obj->getInAdiciona(),
										$obj->getInPermissaoEspecial(),
										$db->qstr($obj->getDescricaoPermissao()),	
										$obj->getInSituacao());
				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
					
					$sqlInsert	= sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
					
					$obj->updIdMenu($rs->Fields("ins_id"));
				} catch(exception $e){
					$db->RollBackTrans();
				}
			}
		return $return;
		}
		public function update(&$obj){
			global $db;
			
			$return = false;
			$this->sql = "";
			
			if(! is_null($obj)){
				$this->sql = sprintf('UPDATE 	"menu"
													SET "idMenuPai" = %s,
														 "descricao" = %s,
														 "pagina" = %s,
														 "inConsulta" = %u,
														 "inAltera" = %u,
														 "inAdiciona" = %u,
														 "inPermissaoEspecial" = %u,
														 "descricaoPermissao" = %s,
														 "inSituacao" = %u,
														 "dataAlteracao" = now()
														 WHERE "idMenu" = %u',
								is_null($obj->getIdMenuPai()) ? 'NULL' : $obj->getIdMenuPai()->getCodigo(),
								$db->qstr($obj->getDescricao()),
								$db->qstr($obj->getPagina()),	
								$obj->getInConsulta(),
								$obj->getInAltera(),
								$obj->getInAdiciona(),
								$obj->getInPermissaoEspecial(),
								$db->qstr($obj->getDescricaoPermissao()),	
								$obj->getInSituacao(),
								$obj->getCodigo());
								
				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
				} catch(exception $e){
					$db->RollBackTrans();	
				}
				return $return;
			}	
		}
		
		public function delete(&$obj){
			global $db;	
			
			$return = false;
			$this->sql = "";
			
			if(! is_null($obj)){
					
			}
			return $return;
		}
		
		public function select($option = 0,
									  $key = NULL,
									  $order = NULL){
				global $db;
				$return = NULL;	
				$this->sql = "";
				
				switch($option){
					case 0:
						$this->sql = sprintf('SELECT *
														FROM "menu"
														ORDER BY "descricao"
														LIMIT(1000);');
						
						$rs = $db->Execute($this->sql);
						
						while(! $rs->EOF){
							$return[] = $this->load($rs);
							$rs->MoveNext();
						}
						$rs->Close();
					break;
					
					case 1:
						$this->sql = sprintf('SELECT *
														FROM "menu"
														WHERE "idMenu" = %u',
														$key);
						
						$rs = $db->Execute($this->sql);
						
						if(! $rs->EOF){
							$return = $this->load($rs);
						}
						$rs->Close();
					break;
					
					case 2:
						$this->sql = sprintf('SELECT *
														FROM "menu"
															WHERE "idMenuPai" is null
															AND "idMenu" != %u
														ORDER BY "descricao";',
													$key);
					
						$rs = $db->Execute($this->sql);
						
						while(! $rs->EOF){
							$return[] = $this->load($rs);
							$rs->MoveNext();
						}
						$rs->Close();
					break;
					
					case 3:
						$this->sql = sprintf('SELECT *
														FROM "menu"
															WHERE "idMenuPai" = %u
															AND "pagina" = \'\'
														ORDER BY "descricao";',
													$key);
					
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