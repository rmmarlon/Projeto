<!-- Modal -->
<div class="modal fade" id="myModalB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    Lista de Cadastro
                </h4>
            </div>
            <div class="modal-body">
                <div style="overflow-y:auto; height:300px;">
<?
					$dao = new CadastroDAO();
					$oLC = $dao->select(0);
					
					if(! is_null($oLC)){
						foreach($oLC as $oC){
?>
                            <span class="nome">
                                <? echo $oC->getNome(); ?>
                            </span>
                            <div class="botao">
                                <a href="#" class="inSeleciona" codigo="<? echo $oC->getCodigo(); ?>" nome="<? echo $oC->getNome(); ?>">
                                    <img src="img/selecionar.png" title="Selecione" alt="Selecione" width="20" height="20" />
                                </a>
                            </div>
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