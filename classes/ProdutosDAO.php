<?
	require_once("autoload.php");
	
	class ProdutosDAO{
		private $sql = NULL;
		
		public function getSQL(){
			return $this->sql;
		}
		
		private function load($rs){
			return new Produtos($rs->Fields("idProdutos"),
									  $rs->Fields("descricao"),
									  $rs->Fields("valor"),
									  $rs->Fields("quantidadeEstoque"),
									  $rs->Fields("inSituacao"),
									  $rs->Fields("dataCadastro"),
									  $rs->Fields("dataAlteracao"));
		}
		##ADD
		public function add(&$obj){
			global $db;
			
			$return = false;
			
			if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "produtos"("descricao",
																			"valor",
																			"quantidadeEstoque",
																			"inSituacao",
																			"dataCadastro")
																			VALUES(%s,
																					 %0.2f,
																					 %u,
																					 %u,
																					 now())',
											 $db->qstr($obj->getDescricao()),
											 $obj->getValor(),
											 $obj->getQuantidadeEstoque(),
											 $obj->getInSituacao());
											 
				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
					
					$sqlInsert = sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
						
					$obj->updIdProdutos($rs->Fields("ins_id"));
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
				$this->sql = sprintf('UPDATE "produtos"
														SET "descricao" = %s,
															 "valor" = %0.2f,
															 "quantidadeEstoque" = %u,
															 "inSituacao" = %u,
															 "dataAlteracao" = now()
															 WHERE "idProdutos" = %u',
											$db->qstr($obj->getDescricao()),
											$obj->getValor(),
											$obj->getQuantidadeEstoque(),
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
			}
			return $return;
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
									  $Key = NULL,
									  $order = NULL){
			global $db;
			$return = NULL;
			$this->sql = "";
			
			switch($option){
				case 0:
					$this->sql = sprintf('SELECT *
													FROM "produtos"
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
													FROM "produtos"
													WHERE "idProdutos" = %u',
													$Key);
													
					$rs = $db->Execute($this->sql);
					
					if(! $rs->EOF){
						$return = $this->load($rs);
					}
					
					$rs->Close();
				break;
				
				case 2:
					$this->sql = sprintf('SELECT *
														FROM "produtos"
															WHERE "inSituacao" = 0');
					
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