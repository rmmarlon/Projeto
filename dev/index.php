<?
	$arrays = array(
				'15,00' => "Armazenamento Digital 1GB",
				'50,00' => "Email Aniversáriante",
				'30,00' => "Usuário Adicional",
				'20,00' => "Pacote de Véiculos",
				'150,00' => "Hospedagem Sites",
				'50,00' => "Integrador Sites"
	);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
        	Dev
        </title>
        <link rel="stylesheet" type="text/css" href="../bootstrap-3.1.1/css/bootstrap.min.css">
        <script src="../tool/jquery.js"></script>
        <script>
			//instancioar um obj Array
			var animes = new Array('Naruto','BragonBallZ','bleach','deathNote');
			//foreach
			try{
				for(i in animes){
					document.createElement('span').innerHTML=animes[i];
				}
			} catch(f){
				//name e message
				alert(f.toString());
			}
			//try catch
			try{
				var x = a;
				var y = x + 10;
				alert(y);
			} catch(e){
				alert(e.name + ' - ' + e.message);
			}
			$(document).ready(function(e) {
                $(".btn").click(function(e) {
					var i = "#"+$(this).parent().siblings().find('input').attr('id');
					var a = "#"+$(this).attr('id');
					var d = "#"+$(this).siblings().attr('id');
					$(a).fadeOut(400, function(){
						$(d).fadeIn();
					});
					$(i).removeAttr("disabled");
                });
				$(".btn2").click(function(e) {
					var i = "#"+$(this).parent().siblings().find('input').attr('id');
					var a = "#"+$(this).attr('id');
					var d = "#"+$(this).siblings().attr('id');
					$(a).fadeOut(400, function(){
						$(d).fadeIn();
					});
					$(i).attr("disabled","disabled").val('');
                });
            });
		</script>
        <style>
			#container{
				width:50%;
				margin:auto;
			}
			.labe{
				color:#000;
				width:200px;
				text-align:right;
			}
			.inp{
				float:right;
			}
		</style>
    </head>
    <body>
    	<div id="container">
        	<form>
            	<table class="table table-bordered border-hover">
                	<thead>
                    	<tr>
                        	<th width="20">Produto</th>
                            <th align="center" width="280px">Quantidade</th>
                            <th width="30">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<? 
							$i = 0;
							foreach($arrays as $p => $inp){ 
							$i++;
						?>
                    	<tr>
                        	<td id="um">
                            	<input type="button" value="Ativa" id="a<?=$i;?>" class="btn btn1 btn-success">
                                <input type="button" value="Desativa" id="d<?=$i;?>" style="display:none" class="btn btn2 btn-danger">
                            </td>
                            <td id="dois">
                            	<label class="labe"><?=$inp;?></label>
                                <input type="text" size="2" id="i<?=$i;?>" class="inp" disabled name="<?=$inp;?>">
                            </td>
                            <td>
                            	<?=$p;?>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
                <div id="arrays">
                </div>
            </form>
        </div>
    </body>
</html>