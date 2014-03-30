<?
	require_once("autoload.php");
	
	class ComentariosDAO{
		private $sql = NULL;
		
		public function getSQL(){
			return $this->sql;
		}
		#LOAD
		private function load($rs){
			return new Comentarios($rs->Fields("idComentarios"),
									$rs->Fields("idCadastro"),
									$rs->Fields("assunto"),
									$rs->Fields("dataCadastro"),
									$rs->Fields("dataAlteracao"));
		}
		#ADD
		public function add(&$obj){
			global $db;		
			$return = false;
			
			if(! is_null($obj)){
				$this->sql = "";
				$this->sql = sprintf('INSERT INTO "comentarios"("idCadastro",
																"assunto",
																"dataCadastro")
																VALUES(%u,
																	   %s,
																	   now());',
									$obj->getIdCadastro()->getCodigo(),
									$db->qstr($obj->getAssunto()));

				$db->BeginTrans();
				
				try{
					$db->Execute($this->sql);
					$db->CommitTrans();
					$return = true;
					
					$sqlInsert = sprintf("SELECT LASTVAL() as ins_id");
					$rs = $db->Execute($sqlInsert);
					
					$obj->updIdComentarios($rs->Fields("ins_id"));				
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
				$this->sql = sprintf('UPDATE "comentarios" 
															SET "idCadastro" = %u,
																"assunto" = %s,
																"dataAlteracao" = now()
															WHERE "idCOmentarios" = %u',
									$obj->getIdCadastro()->getCodigo(),
									$db_>qstr($obj->getAssunto()),
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
		##DELETE
		public function delete(&$obj){
			global $db;
			$return = false;
			$this->sql = "";
			
			if(! is_null($obj)){
				$this->sql = sprintf('DELETE FROM "comentarios" 
													WHERE "idComentarios" = %u',
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
		##SELECT
		public function select($option = 0,
								$key = NULL,
								$order = NULL){
		
			global $db;
			$return = NULL;
			$this->sql = "";
			
			switch($option){
				case 0:
					$this->sql = sprintf('SELECT * 
													FROM "comentarios"
													ORDER BY "idComentarios"
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
													FORM "comentarios"
													WHERE "idComentarios" = %u',
													
										$key);
					$rs = $db->Execute($this->sql);
					if(! $rs->EOF){
						$return = $this->load($rs);
					}
					$rs->Close();
				break;
				case 2:
					$this->sql = sprintf('SELECT * from comentarios 
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