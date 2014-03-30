<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id="myModalLabel">
                	Lista de fornecedores
                </h4>
      		</div>
      		<div class="modal-body">
            	<div style="height:300px; overflow:auto">
<?
					$dao = new CadastroDAO();
					$oLC = $dao->select(3);
					
					if(! is_null($oLC)){
						foreach($oLC as $oC){
?>
                            <span class="nome">
                                <? echo $oC->getNome();?>
                            </span>
                            <span class="botao">
                                <a href="#" class="inSeleciona" idCadastro="<? echo $oC->getCodigo(); ?>" nome="<? echo $oC->getNome(); ?>">
                                    <img src="img/selecionar.png" alt="Seleciona" />
                                </a>
                            </span>
                            <div class="clear"></div>
                      		<hr />      
<?	
						}
						
					}
?>
				</div>
            </div>
            <div class="modal-footer"></div>
		</div>
	</div>
</div>