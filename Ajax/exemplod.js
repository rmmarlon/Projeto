//base Ajax/////////
//variavel ajax
var ajax = null;

//função que faz a requisição ajax
function requisicaoAjax(){
	
	//utilizado para requisições no browser Internet Explorer
	if (window.ActiveXObject) 
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	
	//utilizado como o padrão javascript para requisições AJAX.
	else if (window.XMLHttpRequest) 
		ajax = new XMLHttpRequest();
	
	//se a variável ajax for nula, logo o browser não suporta tal tecnologia
	if(ajax != null){
	  
	  //abre a requisição ajax, passando o método de acesso, a url solicitada e o parâmetro sobre sincronia
	  ajax.open('GET','http://gujs.com.br/',false);
	  
	  //seta a funcao que sera chamada quando o ajax for retornado
	  ajax.onreadystatechange = statusAjax;
	  
	  //inicia o tranporte
	  ajax.send(null);
	}
}

//função que trata o retorno ajax
function statusAjax(){
  //caso o status do ajax esteja ok, então chama a função retornoAjax enviando o retorno da requisição como parâmetro
  if(ajax.readyState == 4 && ajax.status == 200){
	retornoAjax(ajax.responseText);
  }
}

//função que é chamada quando o ajax for retornado
function retornoAjax(response){
  //dá um alerta no texto de retorno
  alert(response);
}
requisicaoAjax();



///////////////////////////////////////////////

//função para pegar o objeto ajax do navegador
function xmlhttp()
{
	// XMLHttpRequest para firefox e outros navegadores
	if (window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	}

	// ActiveXObject para navegadores microsoft
	var versao = ['Microsoft.XMLHttp', 
				'Msxml2.XMLHttp', 
				'Msxml2.XMLHttp.6.0', 
				'Msxml2.XMLHttp.5.0', 
				'Msxml2.XMLHttp.4.0', 
				'Msxml2.XMLHttp.3.0',
				'Msxml2.DOMDocument.3.0'
	];
	for (var i = 0; i < versao.length; i++)
	{
		try
		{
			return new ActiveXObject(versao[i]);
		}
		catch(e)
		{
			alert("Seu navegador não possui recursos para o uso do AJAX!");
		}
	} // fecha for
	return null;
} // fecha função xmlhttp

//função para fazer a requisição da página que efetuará a consulta no DB
function carregar()
{
   a = document.getElementById('busca').value;
   ajax = xmlhttp();
   if (ajax)
   {
	   ajax.open('get','busca.php?busca='+a, true);
	   ajax.onreadystatechange = trazconteudo; 
	   ajax.send(null);
   }
}

//função para incluir o conteúdo na pagina
function trazconteudo()
{
	if (ajax.readyState==4)
	{
		if (ajax.status==200)
		{
			document.getElementById('resultados').innerHTML = ajax.responseText;
		}
	}
}

