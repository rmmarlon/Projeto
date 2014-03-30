<?
	/*
		Autor : Marlon R Cardoso
		Data : 21/10/2013
		
		Arquivo: Produto.php
		Descrição: Metodos da tabela produto.
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		21/10/2013  Marlon R Cardoso	  Definicão inicial
	*/
	require_once ("autoload.php");
	
	class Produto extends dataRegistro{
		#atributos
		private $codigo = NULL;
		private $idCadastro = NULL;
		private $descricao = NULL;
		private $quantidade = NULL;
		private $valor = NULL;
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
		private function setDescricao($value){
			$this->descricao = $value;
		}
		public function getDescricao(){
			return $this->descricao;
		}
		private function setQuantidade($value){
			$this->quantidade = $value;
		}
		public function getQuantidade(){
			return $this->quantidade;
		}
		private function setValor($value){
			$this->valor = $value;
		}
		public function getValor(){
			return $this->valor;
		}
		#função limpar
		public function clear(){
			$this->setCodigo(NULL);
			$this->setIdCadastro(NULL);
			$this->setDescricao(NULL);
			$this->setQuantidade(NULL);
			$this->setValor(NULL);
			
			parent::clear();
		}
		#metodos de atualizacao
		public function updIdProduto($value){
			$this->codigo = $value;
		}
		public function updCadastro($value){
			$this->idCadastro = $value;
		}
		public function updDescricao($value){
			$this->descricao = $value;
		}
		public function updQuantidade($value){
			$this->quantidade = $value;
		}
		public function updValor($value){
			$this->valor = $value;
		}
		/*
					uma outra opcao para alterar a quantidade após a compra :
					public function updVenda($value){
						$this->quantidade = $this->quantidade - $value;
					}
		*/
		public function __construct($codigo = NULL,
											 $idCadastro = NULL,
											 $descricao = NULL,
											 $quantidade = NULL,
											 $valor = NULL,
											 $dataCadastro = NULL,
											 $dataAlteracao = NULL){
			$this->clear();
			
			$this->setCodigo($codigo);
			$this->setIdCadastro($idCadastro);
			$this->setDescricao($descricao);
			$this->setQuantidade($quantidade);
			$this->setValor($valor);
			
			parent::setDataCadastro($dataCadastro);
			parent::setDataAlteracao($dataAlteracao);
		}
	}
?>