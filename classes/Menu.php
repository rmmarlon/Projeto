<?
	require_once("autoload.php");

	class Menu extends DataRegistro{
		#Atributos
		private $codigo = NULL;
		private $idMenuPai = NULL;
		private $descricao = NULL;
		private $pagina = NULL;
		private $inConsulta = NULL;
		private $inAltera = NULL;
		private $inAdiciona = NULL;
		private $inPermissaoEspecial = NULL;
		private $descricaoPermissao = NULL;
		private $inSituacao = NULL;		
		#Set e get
		private function setCodigo($value){
			$this->codigo = $value;	
		}
		public function getCodigo(){
			return $this->codigo;
		}
		private function setIdMenuPai($value){
			$this->idMenuPai = $value;	
		}
		public function getIdMenuPai(){
			if(! isset($oMenuPai)){
				$oMenuPai = NULL;
			}
			if(is_null($oMenuPai)){
				$dao = new MenuDAO();
				$oMenuPai = $dao->select(1, $this->idMenuPai);
			}
			unset($dao);
			return $oMenuPai;
		}
		private function setDescricao($value){
			$this->descricao = $value;	
		}
		public function getDescricao(){
			return $this->descricao;
		}
		private function setPagina($value){
			$this->pagina = $value;	
		}
		public function getPagina(){
			return $this->pagina;
		}
		private function setInConsulta($value){
			$this->inConsulta = $value;	
		}
		public function getInConsulta(){
			return $this->inConsulta;
		}
		public function getInConsultaDescricao(){
			switch($this->inConsulta){
				case 0:
					$oInConsultaDescricao = "Não";
				break;
				
				case 1:
					$oInConsultaDescricao = "Sim";
				break;
			}
			return $oInConsultaDescricao;
		}
		private function setInAltera($value){
			$this->inAltera = $value;	
		}
		public function getInAltera(){
			return $this->inAltera;
		}
		public function getInAlteraDescricao(){
			switch($this->inAltera){
				case 0:
					$oInAlteraDescricao = "Não";
				break;
				
				case 1:
					$oInAlteraDescricao = "Sim";
				break;
			}
			return $oInAlteraDescricao;
		}
		private function setInAdiciona($value){
			$this->inAdiciona = $value;	
		}
		public function getInAdiciona(){
			return $this->inAdiciona;
		}
		public function getInAdicionaDescricao(){
			switch($this->inAdiciona){
				case 0:
					$oInAdicionaDescricao = "Não";
				break;
				
				case 1:
					$oInAdicionaDescricao = "Sim";
				break;
				
			}
			return $oInAdicionaDescricao;
		}
		private function setInPermissaoEspecial($value){
			$this->inPermissaoEspecial = $value;	
		}
		public function getInPermissaoEspecial(){
			return $this->inPermissaoEspecial;
		}
		public function getInPermissaoEspecialDescricao(){
			switch($this->InPermissaoEspecial){
				case 0:
					$oInPermissaoEspecialDescricao = "Não";
				break;
				
				case 1:
					$oInPermissaoEspecialDescricao = "Sim";
				break;
			}
			return $oInPermissaoEspecialDescricao;
		}
		private function setDescricaoPermissao($value){
			$this->descricaoPermissao = $value;	
		}
		public function getDescricaoPermissao(){
			return $this->descricaoPermissao;
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
					$oInSituacaoDescricao ="Inativo";
				break;
			}
			return $oInSituacaoDescricao;
		}
		#Função limpar
		public function clear(){
			$this->setCodigo(NULL);
			$this->setIdMenuPai(NULL);	
			$this->setDescricao(NULL);
			$this->setPagina(NULL);
			$this->setInConsulta(NULL);
			$this->setInAltera(NULL);
			$this->setInAdiciona(NULL);
			$this->setInPermissaoEspecial(NULL);
			$this->setDescricaoPermissao(NULL);
			$this->setInSituacao(NULL);

			parent::clear();
		}
		#Metodos e atualizações
		public function updIdMenu($value){
			$this->codigo = $value;			
		}
		
		public function updInAltera($value){
			$this->inAltera = $value;
		}
		#Construtor
		public function __construct($codigo = NULL,
											 $idMenuPai = NULL,
											 $descricao = NULL,
											 $pagina = NULL,
											 $inConsulta = NULL,
											 $inAltera = NULL,
											 $inAdiciona = NULL,
											 $inPermissaoEspecial = NULL,
											 $descricaoPermissao = NULL,
											 $inSituacao = NULL,
											 $dataCadastro = NULL,
											 $dataAlteracao = NULL){
												 
			$this->clear();
			
			$this->setCodigo($codigo);
			$this->setIdMenuPai($idMenuPai);
			$this->setDescricao($descricao);
			$this->setPagina($pagina);
			$this->setInConsulta($inConsulta);
			$this->setInAltera($inAltera);
			$this->setInAdiciona($inAdiciona);
			$this->setInPermissaoEspecial($inPermissaoEspecial);
			$this->setDescricaoPermissao($descricaoPermissao);
			$this->setInSituacao($inSituacao);
			
			parent::setDataCadastro($dataCadastro);
			parent::setDataAlteracao($dataAlteracao);
		}
	}
?>