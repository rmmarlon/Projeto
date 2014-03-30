$(document).ready(function(){
	var conteudo = $("#conteudo");
	var link = $("#paginacao a");
	conteudo.load("dados.php");
	link.on('click',function(e){
		e.preventDefault();
		var id=$(this).attr('id');
		conteudo.load("dados.php?pagerID="+id);
	})
});