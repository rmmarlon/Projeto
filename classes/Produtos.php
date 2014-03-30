<?
	require_once("autoload.php");
	
	class Produtos extends DataRegistro{
		#atributos
		private $codigo = NULL;
		private $descricao = NULL;
		private $valor = NULL;
		private $quantidadeEstoque = NULL;
		private $inSituacao = NULL;
		#Set e Get
		#recebe o objeto dessa classe e referncia a variavel
		private function setCodigo($value){
			$this->codigo = $value;
		}
		#retorna a variavel
		public function getCodigo(){
			return $this->codigo;
		}
		
		private function setDescricao($value){
			$this->descricao = $value;
		}
		
		public function getDescricao(){
			return $this->descricao;	
		}
		
		private function setValor($value){
			$this->valor = $value;
		}
		
		public function getValor(){
			return $this->valor;	
		}
		
		private function setQuantidadeEstoque($value){
			$this->quantidadeEstoque = $value;	
		}
		
		public function getQuantidadeEstoque(){
			return $this->quantidadeEstoque;	
		}
		
		private function setInSituacao($value){
			$this->inSituacao = $value;	
		}
		
		public function getInSituacao(){
			return $this->inSituacao;	
		}
		
		public function getInSituacaoDescricao(){
			switch($this->inSituacao){
				case 0:
					$oInSituacaoDescricao = "Ativo";
				break;
				
				case 1:
					$oInSituacaoDescricao = "Inativo";
				break;
			}
			return $oInSituacaoDescricao;
		}
		#funcao limpar
		public function clear(){
			$this->setCodigo(NULL);
			$this->setDescricao(NULL);
			$this->setValor(NULL);
			$this->setQuantidadeEstoque(NULL);
			$this->setInSituacao(NULL);
			
			parent::clear();
		}
		#metodos de atualizações
		public function updIdProdutos($value){
			$this->codigo = $value;
		}
		
		public function updSituacao($value){
			$this->inSituacao = $value;
		}
		#construtor
		public function __construct($codigo = NULL,
											 $descricao = NULL,
											 $valor = NULL,
											 $quantidadeEstoque = NULL,
											 $inSituacao = NULL,
											 $dataCadastro = NULL,
											 $dataAlteracao = NULL){
			$this->clear();
			
			$this->setCodigo($codigo);
			$this->setDescricao($descricao);
			$this->setValor($valor);
			$this->setQuantidadeEstoque($quantidadeEstoque);
			$this->setInSituacao($inSituacao);
			
			parent::setDataCadastro($dataCadastro);
			parent::setDataAlteracao($dataAlteracao);
		}
	}
?>