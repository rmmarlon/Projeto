<!-- 
	self:: - quando se trata da classe, atributos estaticos. 
	$this é um 'ponteiro' que 'aponta' para o proprio objeto. 
	parent:: - Onde podemos acessar métodos de outras classes extendidas
	extends - herda métodos da classe pai
-->
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
	      	Sistema de controle de estoque
        </title>
        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="personalizado/projeto.css" />        
        <script src="tool/jquery.js" language="javascript"></script>
        <script type="text/javascript" src="tool/script.js"></script>
        <script type="text/javascript">
		var spag = "#page1";
		$(document).ready(function(e) {
			$(".pagians a").click(function(e) {
				$(spag).removeClass('active');
				spag = $(this).attr('id');
				spag = "#page"+spag;
				$(spag).addClass('active');
			});
		});
        </script>
   </head>
   <body>
   	<!-- Starting on git-->
   	<div id="menus">
          <ul>
            <li class="pagians" id="page1">
            	<a href="cad.cadastro.php" id="1" title="Cadastro" target="pages">Cadastro</a>
            </li>
            <li class="pagians" id="page2">
            	<a href="cad.produto.php" id="2" title="Produto" target="pages">Produto</a>
            </li>
            <li class="pagians" id="page3">
            	<a href="com.compra.php" id="3" title="Vendas" target="pages">Venda</a>
            </li>
            <li class="pagians" id="page4">
            	<a href="com.comentarios.php" id="4" title="Comentários" target="pages">Comentários</a>
            </li>
          </ul>
      </div>
      <iframe src="pages.php" name="pages" id="pages" border="0" frameborder="No"></iframe>
   </body>
</html>
