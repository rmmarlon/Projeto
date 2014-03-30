<?
	require_once ("classes/autoload.php");
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
		
	if(! isset($_POST['acao'])){
		$_POST['acao'] = NULL;
	}
	
	if($_POST['acao'] == 'cadastrar'){
		$obj = new Comentarios(NULL,
							   $_POST['idCadastro'],
							   $_POST['editor1']);
		$dao = new ComentariosDAO();
		if($dao->add($obj)){
			$_SESSION['msg'] = "Seu Comentário foi enviado com sucesso";
		} else{
			$_SESSION['msg'] = "Não foi possível enviar";
		}
	}
?>
    <link rel="stylesheet" type="text/css" href="personalizado/projeto.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css"/>
    <script type="text/javascript" src="tool/jquery.js"></script>
	<script type="text/javascript" src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap-3.1.1/js/bootbox.min.js"></script>
    <script type="text/javascript" src="tool/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $("#btnEnviar").click(function(e) {
				if($("#idCadastro").val() == ''){
					bootbox.alert('Favor preencher o campo com o cliente');
				} else if($("#textarea_id").val() == ''){
					bootbox.alert('Favor preencher o campo \'Deixe seu comentário\'');
				} else{
					bootbox.confirm('Você deseja comentar', function(valida){
						if(valida){
							$("#acao").val('cadastrar');
							$("form").submit();
						}
					});
				}
            });
            $(".inSeleciona").click(function(e) {
                var codigo = $(this).attr("codigo");
                var nome = $(this).attr("nome");
                $("#idCadastro").val(codigo);
                $("#spnNome").html(nome);
                $(".limpaModal").show();
                $("#modalPesquisar").hide();
                $(".close").trigger("click");
            });
            $(".limpaModal").click(function(e) {
                $("#idCadastro").val('');
                $("#spnNome").html('');
                $("#modalPesquisar").show();
                $(".limpaModal").hide();
            });
        }); 
    </script>
    <div style="margin:auto; width:50%">
        <div style="width:50%;">
            <form method="post">
                <input type="hidden" name="acao" id="acao" />
                <p>
                    <input type="text" name="idCadastro" id="idCadastro" class="readOnly inputPesquisa" readonly /> 
                    <span id="spnNome"></span>
                    <span class="btnPesquisa btn-default">
                        <a href="#" id="modalPesquisar" data-toggle="modal" data-target="#myModalB">
                            <img src="img/pesquisamini.png" alt="procure o cliente" width="19" height="17" />
                        </a>
                        <a href="#" class="limpaModal" title="Limpar o cliente">
                            <img src="img/limpar.png" alt="Limpar" width="15" height="15" />
                        </a>
                    </span>
                    <input type="button" value="Enviar" id="btnEnviar" class="btn btn-info floatRight" />
                </p>
                <div class="clear"></div>
                <p>
                    <textarea name="editor1" placeholder="Deixe seu comentário" id="textarea_id" style="width:100%;height:10%; resize:none;float:left"></textarea>
                </p>
                <div class="clear"></div>
            </form>
        </div>
        <table width="100%" align="center" class="table-striped table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th width="6%">
                        Codigo
                    </th>
                    <th>
                        Nome
                    </th>
                    <th>
                        Assunto
                    </th>
                    <th>
                        Data de cadastro
                    </th>
                </tr>
            </thead>
            <tbody>
<?
				pagination('ComentariosDAO', 2, 8);
				if(! is_null($oLC)){
					foreach($oLC as $oCO){
?>
                        <tr>
                            <td align="center">
                                <? echo $oCO->getCodigo(); ?>
                            </td>
                            <td>
                                <? echo $oCO->getIdCadastro()->getNome(); ?>
                            </td>
                            <td>
                                <? echo $oCO->getAssunto(); ?>
                            </td>
                            <td>
                                <?  echo $oCO->getDataCadastro()->getDMYHMS(); ?>
                            </td>
                        </tr>
	<?
                    }
                }
?>	
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3"></th>
                    <th colspan="1" align="left">
                        <strong>Total de registros: </strong><?	echo $totalRegistros; ?>
                    </th>
                </tr>
        	</tfoot>
        </table>
<?			
		paginacaoBtn($pagina,'com.comentarios',$numPages);
?>
	</div>
<? 
	require_once ("modal/modalCadastro.php");
	require_once ("personalizado/alerta.php");
	require_once ("conADODBclose.php"); 
?>