<?
	/*
		Autor : Marlon R Cardoso
		Data : 21/10/2013
		
		Arquivo: Compra.php
		Descrição: Metodos da tabela compra.
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		21/10/2013  Marlon R Cardoso	  Definicão inicial
	*/
	require_once("autoload.php");
	
	class Compra extends dataRegistro{
		#atrubutos
		private $codigo = NULL;
		private $idCadastro = NULL;
		private $idProduto = NULL;
		private $quantidadeCompra = NULL;
		private $valorTotal = NULL;
		
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
		private function setIdProduto($value){
			$this->idProduto = $value;
		}
		public function getIdProduto(){
			if(! isset($oProduto)){
				$oProduto = NULL;
			}
			if(is_null($oProduto)){
				$dao = new ProdutoDAO();
				$oProduto = $dao->select(1, $this->idProduto);
			}
			unset($dao);
			return $oProduto;
		}
		private function setQuantidadeCompra($value){
			$this->quantidadeCompra = $value;
		}
		public function getQuantidadeCompra(){
			return $this->quantidadeCompra;
		}
		private function setValorTotal($value){
			$this->valorTotal = $value;
		}
		public function getValorTotal(){
			return $this->valorTotal;
		}
		#função limpar
		public function clear(){
			$this->setCodigo(NULL);
			$this->setIdCadastro(NULL);
			$this->setIdProduto(NULL);
			$this->setQuantidadeCompra(NULL);
			$this->setValorTotal(NULL);
			
			parent::clear();
		}
		#metodos e atualizações
		public function updIdCompra($value){
			$this->codigo = $value;
		}
		public function updProduto($value){
			$this->idProduto = $value;
		}
		#construtor
		public function __construct($codigo = NULL,
											 $idCadastro = NULL,
											 $idProduto = NULL,
											 $quantidadeCompra = NULL,
											 $valorTotal = NULL,
											 $dataCadastro = NULL,
											 $dataAlteracao = NULL){
											
			$this->clear();
			
			$this->setCodigo($codigo);
			$this->setIdCadastro($idCadastro);
			$this->setIdProduto($idProduto);
			$this->setQuantidadeCompra($quantidadeCompra);
			$this->setValorTotal($valorTotal);
			
			parent::setDataCadastro($dataCadastro);
			parent::setDataAlteracao($dataAlteracao);
		}
	}
?>