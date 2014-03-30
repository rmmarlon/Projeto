<?
	  //conexão com o banco de dados
        pg_connect("host=localhost dbname=projeto user=projeto password=projeto") or die ("Não foi possivel conectar ao servidor PostGreSQL");
 
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
        $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
 
    //seleciona todos os itens da tabela
        $cmd = "select * from comentarios";
        $produtos = pg_query($cmd);
   
    //conta o total de itens
        $total = pg_num_rows($produtos);
   
    //seta a quantidade de itens por página, neste caso, 2 itens
        $registros = 2;
   
    //calcula o número de páginas arredondando o resultado para cima
        $numPaginas = ceil($total/$registros);
   
    //variavel para calcular o início da visualização com base na página atual
        $inicio = ($registros*$pagina)-$registros;
 
    //seleciona os itens por página
        $cmd = "select * from produtos limit $inicio,$registros";
        $produtos = pg_query($cmd);
        $total = pg_num_rows($produtos);
 
    //exibe os produtos selecionados
        while ($produto = pg_fetch_array($produtos)) {
            echo $produto['idComentarios']." - ";
            echo $produto['idCadastro']." - ";
            echo $produto['assunto']." - ";
            echo "R$ ".$produto['dataCadastro']."<br />";
        }
 
    //exibe a paginação
        for($i = 1; $i < $numPaginas + 1; $i++) {
             echo "<a href='paginacao.php?pagina=$i'>".$i."</a> ";
        }

?>