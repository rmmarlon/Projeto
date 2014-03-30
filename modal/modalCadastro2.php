<div id="modalCadastro" class="window windowB  dados">
	<input type="button" style="float:right; opacity:1.0;padding:0 0.7%" class="close closeB btn-danger" value="X" />
    <div class="clear"></div>
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