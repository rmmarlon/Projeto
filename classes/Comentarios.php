<?
	require_once("autoload.php");
	
	class Comentarios extends dataRegistro{
		#atributos
		private $codigo = NULL;
		private $idCadastro = NULL;
		private $assunto = NULL;
		
		#set e get
		private function setCodigo($value){
			$this->codigo = $value;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		private function setIdCadastro($value){
			$this->idCadastro = $value;
		}
		public function getIdCadastro(){
			if(! isset($oCadastro)){
				$oCadastro = NULL;
			}
			if(is_null($oCadastro)){
				$dao = new CadastroDAO();
				$oCadastro = $dao->select(1, $this->idCadastro);
			}
			unset($dao);
			return $oCadastro;
		}
		private function setAssunto($value){
			$this->assunto = $value;
		}
		public function getAssunto(){
			return $this->assunto;
		}
		#funcao limpa
		public function clear(){
			$this->setCodigo(NULL);
			$this->setIdCadastro(NULL);
			$this->setAssunto(NULL);
			
			parent::clear();
		}
		#matodos de atualização
		public function updIdComentarios($value){
			$this->codigo = $value;
		}
		public function updCadastro($value){
			$this->idCadastro = $value;
		}
		public function updAssunto($value){
			$this->assunto = $value;
		}
		#construtor
		public function __construct($codigo = NULL,
									$idCadastro = NULL,
									$assunto = NULL,
									$dataCadastro = NULL,
									$dataAlteracao = NULL){
			$this->clear();
			
			$this->setCodigo($codigo);
			$this->setIdCadastro($idCadastro);
			$this->setAssunto($assunto);
			
			parent::setDataCadastro($dataCadastro);
			parent::setDataAlteracao($dataAlteracao);
		}
	}
?>