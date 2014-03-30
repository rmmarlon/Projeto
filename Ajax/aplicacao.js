$(function () {
	$("#cpf").keyup(function () {
		var cpf = $(this).val();
		$.ajax({
			type: "GET",
			url: "pessoas.php",
			data: "cpf="+cpf,
			success: function(pessoa){
				
				$("tbody").html(pessoa);
				
			}
		});
	});
});