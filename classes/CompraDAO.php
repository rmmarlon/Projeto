<?
	/*
		Autor : Marlon R Cardoso
		Data : 21/10/2013
		
		Arquivo: CompraDAO.php
		Descrição: Funções (load,Add,update,delete e select) da tabela compra.
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		21/10/2013  Marlon R Cardoso	  Definicão inicial
	*/
	require_once("autoload.php");
	
	class CompraDAO{
		private $sql = NULL;
		
		public function getSQL(){
			return $this->sql;
		}
		private function load($rs){
			return new Compra($rs->Fields("idCompra"),
									$rs->Fields("idCadastro"),
									$rs->Fields("idProduto"),
									$rs->Fields("quantidadeCompra"),
									$rs->Fields("valorTotal"),
									$rs->Fields("dataCadastro"),
									$rs->Fields("dataAlteracao"));
		} 
		#ADD
		public function add(&$obj){
			global $db;
			
			$return = false;
			if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "compra" ("idCadastro",
															"idProduto",
															"quantidadeCompra",
															"valorTotal",
															"dataCadastro")
															VALUES(%u,
																	 %u,
																	 %u,
																	 %0.2f,
																	 now())',
											$obj->getIdCadastro()->getCodigo(),
											$obj->getIdProduto()->getCodigo(),
											$obj->getQuantidadeCompra(),
											$obj->getValorTotal());
																																	
				$db->BeginTrans();
				
				try{					
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return  = true;
					
					$sqlInsert = sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
					
					$obj->updIdCompra($rs->Fields("ins_id"));
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
				$this->sql = sprintf('UPDATE "compra"
														SET "idCadastro" = %u,
															 "idProduto" = %u,
															 "quantidadeCompra" = %u,
															 "valorTotal" = %0.2f,
															 "dataAlteracao" = now()
														WHERE "idCompra" = %u',
														 
											$obj->getIdCadastro()->getCodigo(),
											$obj->getIdProduto()->getCodigo(),
											$obj->getQuantidadeCompra(),
											$obj->getValorTotal(),
											$obj->getCodigo());
				echo $this->sql;
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
			}
			return $return;
		}
		#consultas
		public function select($option = 0,
									  $key = NULL,
									  $order = NULL){
		
			global $db;
			$return = NULL;
			$this->sql = "";
			
			switch($option){
				case 0:
					$this->sql = sprintf('SELECT *
														FROM "compra"
														ORDER BY "idCompra"
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
											FROM "compra"
											WHERE "idCompra" = %u',
										$key);
					
					$rs = $db->Execute($this->sql);
					if(! $rs->EOF){
						$return = $this->load($rs);
					}
					$rs->Close();
				break;
				
				case 2:
					$this->sql = sprintf('SELECT *
											FROM "compra"
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