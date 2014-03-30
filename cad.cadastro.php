<?
	require_once ("conADODBopen.php");
	require_once ("tool/funcoes.php");
	require_once ("classes/autoload.php");
	#declarar variável
	
	/*
	$a = isset($_GET["a"]) ? $_GET["a"] : '';
	if ($a == "buscar") {   
		// Pegamos a palavra 
		$busca[0] = 'nome';
		$busca[1] = trim($_POST['busca']);
		$dao = new CadastroDAO();
		$oLC = $dao->select(5, $busca);
		$numRegistros = count($oLC);
		unset($dao);
		
		if($numRegistros == 0){
			$busca[0] = 'responsavel';
			$busca[1] = trim($_POST['busca']);
			$dao = new CadastroDAO();
			$oLC = $dao->select(5, $busca);
			$numRegistros = count($oLC);
			unset($dao);
		}
	}
	*/
?>        
    <link rel="stylesheet" type="text/css" href="personalizado/projeto.css" />
	<link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="tool/jquery.js"></script>
	<script src="bootstrap-3.1.1/js/bootstrap.min.js"></script>
	<script src="bootstrap-3.1.1/js/bootbox.min.js"></script>
    <script type="text/javascript" src="tool/script.js"></script>
    <script language="javascript">
		/*function atualizarRegistros(){
			ajax = ajaxInit();
			document.getElementById("totalRegistros").remove();
			
		}*/
		$(function () {
			$("#busca").keyup(function () {
				var busca = $(this).val();
				$.ajax({
					type: "GET",
					url: "busca.php",
					data: "busca="+busca,
					success: function(buscar){
						$("tbody").html(buscar);
						if($("#busca").val() !=''){
							$("tfoot,#paginacaoBtn").hide();
						} else{
							$("tfoot, #paginacaoBtn").show();
						}
					}
				});
			});
		});
        $(document).ready(function(e) {
            $(".callpage").live('click',function(e) {
                var upd = $(this).attr('act');
                $("#act").val($(this).attr("act"));
				var id = $(this).attr("id");
                $("#idCadastro").val($(this).attr("id"));
                $("#mcf").val($(this).attr("mcf"));
                if(upd =="upd"){
                    bootbox.prompt('Insira Senha', function(valida){
                        if(valida){
							if($(".modal-body form input").val() == 'cardoso'){
								$("form").attr("action", "cad.cadastro.edit.php");
								$("form").submit();
							} else{
								bootbox.alert('A senha esta incorreta');
							}
                        }
                    });
                } else{
                    $("form").attr("action", "cad.cadastro.edit.php");
                    $("form").submit();
                }
            });
			$("#fechar").live('click',function(){
				$(".close").remove();
				setTimeout('location.href="cad.cadastro.php"', 600);
			});
			$("#busca").keyup(function(e) {
                if($(this).val() !=''){
					//$("tfoot").hide();
				} else{
					//$("tfoot").show();
				}
            });
            //$("table tr nth-child:contains('1')").css("background","#cc6");
        });
    </script>
    <style>
		body{
			margin:0 5%;
		}
	</style>
    <h1>
        Lista de Cadastros
    </h1>
    <form name="frmLista" method="post">
        <input type="hidden" name="act" id="act" />
        <input type="hidden" name="idCadastro" id="idCadastro" />
        <input type="button" name="btnNovo" value="Novo Cadastro" class="callpage floatLeft btn btn-info" act="add" />
		<div class="input-group floatRight" style="width:30%">
			<input type="text" class="form-control" placeholder="Faça sua busca...." name="busca" id="busca" />
			<span class="input-group-btn">
				<button type="button" id="btnEnvia" class="btn btn-default" style="height:34px;">
					<img src="img/pesquisamini.png" width="18" height="20" alt="pesquisar" />
				</button>
			</span>
		</div>
	</form>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>
                    Código
                </th>
                <th>
                    Nome
                </th>
                <th>
                    Responsável
                </th>
                <th>
                    CPF/CNPJ
                </th>
                <th>
                    Telefone
                </th>
                <th>
                    Celular
                </th>
                <th>
                    Pessoa
                </th>
                <th width="6%">
                    Tipo
                </th>
                <th>
                    Porte
                </th>
                <th>
                    Data de cadastro
                </th>
                <th width="2%">
                    Editar
                </th>
            </tr>
        </thead>
        <tbody id="loadLine">
<?
			pagination('CadastroDAO', 4, 8);
			if(! is_null($oLC)){
                foreach($oLC as $oC){ 
?>
                    <tr style="font-size:0.86em" id="tableLoad">								
                        <td align="center" width="6%">
                            <? echo $oC->getCodigo(); ?>
                        </td>
                        <td>
                            <? echo $oC->getNome() == "" ? $oC->getResponsavel() : $oC->getNome(); ?>
                        </td>
                        <td>
                            <? echo $oC->getResponsavel() == "" ? $oC->getNome() :$oC->getResponsavel(); ?>
                        </td>
                        <td>
                            <? echo $oC->getCPF() . $oC->getCNPJ(); ?>
                        </td>
                        <td>
                            <? echo $oC->getTelefone(); ?>
                        </td>
                        <td>
                            <? echo $oC->getCelular(); ?>
                        </td> 
                        <td>	
                            <? echo $oC->getInPessoaDescricao(); ?>
                        </td>
                        <td>
                            <? echo $oC->getInTipoDescricao(); ?>
                        </td>
                        <td>
                            <? echo ($oC->getInPorteDescricao()) == "" ? 'Pessoa Fisica' : $oC->getInPorteDescricao(); ?>
                        </td>
                        <td>
                            <? echo $oC->getDataCadastro()->getDMYHMS(); ?>
                        </td>
                        <td style="text-align:center">
                            <a href="#" title="Alterar" class="callpage" act="upd" id="<? echo $oC->getCodigo(); ?>">
                                <img src="img/alterar.png" alt="Alterar" width="16" height="16" />
                            </a>
                        </td>
                    </tr>
<?
                }
			}
?>
			</div>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="9" id="atual"></th>
                <th colspan="2" id="totalRegistros">
                    <span>Total de registros: </span><? echo $totalRegistros; ?>
                </th>
            </tr>
        </tfoot>
    </table>
    <div id="paginacaoBtn">
		<? if(isset($numPages) && $numPages >1) paginacaoBtn($pagina,'cad.cadastro',$numPages); ?>
    </div>
<?
	require_once ("conADODBclose.php"); 
?>