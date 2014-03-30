<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    Lista de Produtos
                </h4>
            </div>
            <div class="modal-body">            
                <div style="height:200px; overflow-y:auto;">
<?
					$dao = new ProdutoDAO();
					$oLP = $dao->select(0);
					
					if(! is_null($oLP)){
						foreach($oLP as $oP){
?>
                            <span id="descPro">
                                <? echo $oP->getDescricao(); ?>
                            </span> 
                            <div id="descVal">
                                R$: <? echo number_format($oP->getValor(), 2, ",","."); ?>
                            </div>
                            <div class="botao">
                                <a href="#" class="inSeleciona2" quantidade="<? echo $oP->getQuantidade(); ?>" valor="<? echo number_format($oP->getValor(), 2, ",","."); ?>" descricao="<? echo $oP->getDescricao(); ?>" idCodigo="<? echo $oP->getCodigo(); ?>" title="Selecione o Produto">
                                    <img src="img/selecionar.png" alt="Selecione" />
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