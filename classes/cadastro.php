<?
	/*
		Autor : Marlon R Cardoso
		Data : 18/10/2013
		
		Arquivo: Cadastro.php
		Descrição: Metodos da tabela produto.
		
		Data        Responsável         Breve Definição
		==========  ==================  ==================================================
		18/10/2013  Marlon R Cardoso	  Definicão inicial
	*/
	require_once("autoload.php");
	
	class Cadastro extends dataRegistro{
		#atributos
		private $codigo = NULL;
		private $nome = NULL;
		private $cpf = NULL;
		private $cnpj = NULL;
		private $responsavel = NULL;
		private $cep = NULL;
		private $telefone = NULL;
		private $celular = NULL;
		private $mae = NULL;
		private $dataNascimento = NULL;
		private $fundacao = NULL;
		private $inSexo = NULL;
		private $inTipo = NULL;
		private $inPessoa = NULL;
		private $inPorte = NULL;
		
		#set e get
		private function setCodigo($value){
			$this->codigo = $value;
		}
		public function getCodigo(){
			return $this->codigo;
		}
		private function setNome($value){
			$this->nome = $value;
		}
		public function getNome(){
			return $this->nome;
		}
		private function setCPF($value){
			$this->cpf = $value;
		}
		public function getCPF(){
			return $this->cpf;
		}
		private function setCNPJ($value){
			$this->cnpj = $value;
		}
		public function getCNPJ(){
			return $this->cnpj;
		}
		private function setResponsavel($value){
			$this->responsavel = $value;
		}
		public function getResponsavel(){
			return $this->responsavel;
		}
		private function setCEP($value){
			$this->cep = $value;
		}
		public function getCEP(){
			return $this->cep;
		}
		private function setTelefone($value){
			$this->telefone = $value;
		}
		public function getTelefone(){
			return $this->telefone;
		}
		private function setCelular($value){
			$this->celular = $value;
		}
		public function getCelular(){
			return $this->celular;
		}
		private function setMae($value){
			$this->mae = $value;
		}
		public function getMae(){
			return $this->mae;
		}
		private function setDataNascimento($value){
			$this->dataNascimento = $value;
		}
		public function getDataNascimento(){
			$oDataNascimento = NULL;
			if($this->dataNascimento != ""){
				$oDataNascimento = new UtilData($this->dataNascimento);
			}
			return $oDataNascimento;
		}
		private function setFundacao($value){
			$this->fundacao = $value;
		}
		public function getFundacao(){
			$oFundacao = NULL;
			if($this->fundacao != ""){
				$oFundacao = new UtilData($this->fundacao);
			}
			return $oFundacao;
		}
		private function setInSexo($value){
			$this->inSexo = $value;
		}
		public function getInSexo(){
			return $this->inSexo;
		}
		public function getInSexoDescricao(){
			switch($this->inSexo){
				case 1:
					$oInSexoDescricao = "Feminino";
				break;
				case 2:
					$oInSexoDescricao = "Masculino";
				break;
			}
			return $oInSexoDescricao;
		}
		private function setInTipo($value){
			$this->inTipo = $value;
		}
		public function getInTipo(){
			return $this->inTipo;
		}
		public function getInTipoDescricao(){
			switch($this->inTipo){
				case 0:
					$oInTipoDescricao = "Cliente";
				break;
				
				case 1:
					$oInTipoDescricao = "Fornecedor";
				break;
				
				case 2:
					$oInTipoDescricao = "Funcionário";
				break;
				
				case 3:
					$oInTipoDescricao = "Freelancer";
				break;
			}
			return $oInTipoDescricao;
		}
		private function setInPessoa($value){
			$this->inPessoa = $value;
		}
		public function getInPessoa(){
			return $this->inPessoa;
		}
		public function getInPessoaDescricao(){
			switch($this->inPessoa){
				case 0:
					$oInPessoaDescricao = "Fisica";
				break;
				case 1:
					$oInPessoaDescricao = "Juridica";
				break;
			}
			return $oInPessoaDescricao;
		}
		private function setInPorte($value){
			$this->inPorte = $value;
		}
		public function getInPorte(){
			return $this->inPorte;
		}
		public function getInPorteDescricao(){
			switch($this->inPorte){
				case 0:
					$oInPorteDescricao = "";
				break;
				case 1:
					$oInPorteDescricao = "Pequena";
				break;
				case 2:
					$oInPorteDescricao = "Média";
				break;
				case 3:
					$oInPorteDescricao = "Grande";
				break;
			}
			return $oInPorteDescricao;
		}
		#funcao limpar
		public function clear(){
			$this->setCodigo(NULL);
			$this->setNome(NULL);
			$this->setCPF(NULL);
			$this->setCNPJ(NULL);
			$this->setResponsavel(NULL);
			$this->setCEP(NULL);
			$this->setTelefone(NULL);
			$this->setCelular(NULL);
			$this->setMae(NULL);
			$this->setDataNascimento(NULL);
			$this->setFundacao(NULL);
			$this->setInSexo(NULL);
			$this->setInTipo(NULL);
			$this->setInPessoa(NULL);
			$this->setInPorte(NULL);
			
			parent::clear();
		}
		#metodos e atualizacoes
		public function updIdCadastro($value){
			$this->codigo = $value;
		}
		public function updNome($value){
			$this->nome = $value;
		}
		public function updCPF($value){
			$this->cpf = $value;
		}
		public function updCNPJ($value){
			$this->cnpj = $value;
		}
		public function updResponsavel($value){
			$this->responsavel = $value;
		}
		public function updCEP($value){
			$this->cep = $value;
		}
		public function updTelefone($value){
			$this->telefone = $value;
		}
		public function updCelular($value){
			$this->celular = $value;
		}
		public function updMae($value){
			$this->mae = $value;
		}
		public function updDataNascimento($value){
			$this->dataNascimento = $value;
		}
		public function updFundacao($value){
			$this->fundacao = $value;
		}
		public function updSexo($value){
			$this->inSexo = $value;
		}
		public function updTipo($value){
			$this->inTipo = $value;
		}
		public function updPessoa($value){
			$this->inPessoa = $value;
		}
		public function updPorte($value){
			$this->inPorte = $value;
		}
		#construtor
		public function __construct($codigo = NULL,
											 $nome = NULL,
											 $cpf = NULL,
											 $cnpj = NULL,
											 $responsavel = NULL,
											 $cep = NULL,
											 $telefone = NULL,
											 $celular = NULL,
											 $mae = NULL,
											 $dataNascimento = NULL,
											 $fundacao = NULL,
											 $inSexo = NULL,
											 $inTipo = NULL,
											 $inPessoa = NULL,
											 $inPorte = NULL,
											 $dataCadastro = NULL,
											 $dataAlteracao = NULL){
											
				$this->clear();
				
				$this->setCodigo($codigo);
				$this->setNome($nome);
				$this->setCPF($cpf);
				$this->setCNPJ($cnpj);
				$this->setResponsavel($responsavel);
				$this->setCEP($cep);
				$this->setTelefone($telefone);
				$this->setCelular($celular);
				$this->setMae($mae);
				$this->setDataNascimento($dataNascimento);
				$this->setFundacao($fundacao);
				$this->setInSexo($inSexo);
				$this->setInTipo($inTipo);
				$this->setInPessoa($inPessoa);
				$this->setInPorte($inPorte);
				
				parent::setDataCadastro($dataCadastro);
				parent::setDataAlteracao($dataAlteracao);
		}
	}
?>