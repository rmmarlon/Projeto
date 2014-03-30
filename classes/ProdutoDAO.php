<?
		/*
			Autor : Marlon R Cardoso
			Data : 21/10/2013
			
			Arquivo: ProdutoDAO.php
			Descrição: Funções (load,add,delete,select) da tabela produto.
			
			Data        Responsável         Breve Definição
			==========  ==================  ==================================================
			21/10/2013  Marlon R Cardoso	  Definicão inicial
		*/
	require_once("autoload.php");
	
	class ProdutoDAO{
		private $sql = NULL;
		
		public function getSQL(){
			return $this->sql;
		}
		private function load($rs){
			return new Produto($rs->Fields("idProduto"),
									 $rs->Fields("idCadastro"),
									 $rs->Fields("descricao"),
									 $rs->Fields("quantidade"),
									 $rs->Fields("valor"),
									 $rs->Fields("dataCadastro"),
									 $rs->Fields("dataAlteracao"));

		}
		#add
		public function add(&$obj){
			global $db;
			$return = false;
			
			if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "produto" ("idCadastro",
																			"descricao",
																			"quantidade",
																			"valor",
																			"dataCadastro")
																			VALUES(%u,
																					 %s,
																					 %u,
																					 %0.2f,
																					 now());',
											$obj->getIdCadastro()->getCodigo(),
											$db->qstr($obj->getDescricao()),
											$obj->getQuantidade(),
											$obj->getValor());
				$db->BeginTrans();
				
				try{					
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return  = true;
					
					$sqlInsert = sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
					
					$obj->updIdProduto($rs->Fields("ins_id"));
				} catch(exception $e){
					$db->RollBackTrans();
				}						
			}
			return $return;
		}
		#UPDATE
		public function update(&$obj){
			global $db;
			
			$return = false;
			$this->sql = "";
			
			if(! is_null($obj)){
				$this->sql = sprintf('UPDATE "produto"
															SET "idCadastro" = %u,
																 "descricao" = %s,
																 "quantidade" = %u,
																 "valor" = %0.2f,
																 "dataAlteracao" = now()
															WHERE "idProduto" = %u',
															
											$obj->getIdCadastro()->getCodigo(),
											$db->qstr($obj->getDescricao()),
											$obj->getQuantidade(),
											$obj->getValor(),
											$obj->getCodigo());

				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
				} catch(exception $e){
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
				$this->sql = sprintf('DELETE FROM "produto"
										WHERE "idProduto" = %u',
									$obj->getCodigo());
				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
				} catch(exception $e){
					$db->RollBackTrans();
				}
			}
			return $return;
		}
		#consulta
		public function select($option = 0,
									  $key = NULL,
									  $order = NULL){
			global $db;
			$return = NULL;
			$this->sql = "";
			
			switch($option){
				case 0:
					$this->sql = sprintf('SELECT *
											FROM "produto"
											ORDER BY "idProduto"
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
													FROM "produto"
													WHERE "idProduto" = %u',
												$key);
													
					$rs = $db->Execute($this->sql);
					
					if(! $rs->EOF){
						$return = $this->load($rs);						
					}
					$rs->Close();
				break; 
				
				case 2:
					$this->sql = sprintf('SELECT *
											FROM "produto"
											WHERE upper("descricao") = upper(%s)',
										$db->qstr($key));
													
					$rs = $db->Execute($this->sql);
					
					if(! $rs->EOF){
						$return = $this->load($rs);						
					}
					$rs->Close();
				break;
				
				case 3:
					$this->sql = sprintf('SELECT *
											FROM "produto"
											ORDER BY "idProduto"
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
			}
			return $return;
		}
	}
?>