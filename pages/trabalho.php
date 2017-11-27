<?php
function executa($arqu) {
    include("./grafico.php");
    $lines = file("./arquivos/" . $arqu . ".txt"); // Lê um arquivo em um array.
    $name	 = './relatorios/Parte_1.txt';
    $file 		= fopen($name, 'a');
    $lista1 = array();
    $qtd_arestas = 0;
    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            $qtd_vertices = $line;
        } else {
            $arestas = $line;
            $aresta = explode(" ", $arestas);
            $vertice1 = (int) $aresta[0];
            $vertice2 = (int) $aresta[1];

            array_push($lista1, $vertice1);
            array_push($lista1, $vertice2);
            $qtd_arestas++;
        }
    }
    $grau = array_count_values($lista1);
    $maxg = max($grau);
    $ming = min($grau);
    $mgp = (int) $qtd_vertices - 1;
    ksort($grau);
    echo  "# n = " . $qtd_vertices."<br>";
    fwrite($file, "# n = " . $qtd_vertices."\n");
    echo "# m = " . $qtd_arestas."<br>";
    fwrite($file, "# m = " . $qtd_arestas."\n");
    echo "maior grau: " . $maxg."<br>";
    fwrite($file, "maior grau: " . $maxg."\n");
    echo "menor grau: " . $ming."<br>";
    fwrite($file, "menor grau: " . $ming."\n");
    echo "Graus:<br>";
    fwrite($file, "Graus:\n");
    
   
    foreach ($grau as $key => $value) {
        $graus = "{$key}  {$value}" . PHP_EOL;
        echo $graus . "<br>";
         fwrite($file,  $graus . "\n");
    }
    grafico($arqu, $ming, $maxg, $mgp);
   // echo ' <form action="../Gerador_Pdf/index.php" method="POST"><input value="'.$texto.'" name="info"/> <button type="submit">gerar pdf</button></form>';
    fclose($file);
    unset($lines);
    unset($grau);
    unset($lista1);
}

function lst($arqu) {
    include("./cronos.php");
    startExec();

    $lines = file("./arquivos/" . $arqu . ".txt"); // Lê um arquivo em um array. 
    $lista = array();
    $qtd_arestas = 0;

    $name	 		= './relatorios/lista_adjacencia.txt';
    $file 			= fopen($name, 'a');

    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            $qtd_vertices = $line;
        } else {

            $arestas = $line;
            $aresta = explode(" ", $arestas);
            $vertice1 = (int) $aresta[0];
            $vertice2 = (int) $aresta[1];

            $lista [$vertice1][$vertice2] = $vertice2;
            $lista [$vertice2][$vertice1] = $vertice1;
        }
    }
    echo "<br>Lista de adjacência: <br><br>";
    fwrite($file,  "\nLista de adjacência: \n\n");
    foreach ($lista as $data) {
        if (is_array($data)) {
            $elem = current($lista);
            echo "Elemento: " . key($lista) . "<br> Ligações: <br>";
            fwrite($file,  "Elemento: " . key($lista) . "\n Ligações: \n");
            next($lista);
            foreach ($data as $other_data) {
                echo $other_data . ' <br>';
                fwrite($file,  $other_data . " \n");
            }
            echo '<br/><br/>';
        } else {
            echo $data, '<br/>';
        }
    }
    
    $tempo = endExec();
    $total_t = "Tempo de execução: " . $tempo . "<br>";
    $memoria = memory_get_peak_usage(true) / 1024 / 1024;
    $memprog = memory_get_usage(true) / 1024 / 1024;
    $bytes = $memoria . ' MB<br>';
    $bytesprog = $memprog . ' MB<br>';
    echo "Pico de memoria: " . $bytes . "<br>";
    echo "Uso médio da memoria: " . $bytesprog . "<br>";
    fclose($file);
    unset($lista);
    unset($qtd_arestas);
    unset($qtd_vertices);
    echo $total_t;
}

function mtrz($arqu) {
    include("./cronos.php");
    startExec();

    $lines = file("./arquivos/" . $arqu . ".txt"); // Lê um arquivo em um array. 
    $matriz = array();
    $name	 = './relatorios/matriz_adjacencia.txt';
    $file 		= fopen($name, 'a');
    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            $qtd_vertices = $line;
        } else {

            $arestas = $line;
            $aresta = explode(" ", $arestas);
            $vertice1 = (int) $aresta[0];
            $vertice2 = (int) $aresta[1];
            if ($vertice1 < $vertice2) {
                $matriz [$vertice1][$vertice2] = true;
            } else if ($vertice1 > $vertice2) {
                $matriz [$vertice2][$vertice1] = true;
            }
        }
    }
    echo "<br>Matriz de adjacência: <br><br>";
    fwrite($file,  "\nMatriz de adjacência: \n\n");
    foreach ($matriz as $data) {
        if (is_array($data)) {
            $elem = current($matriz);
            echo "Elemento: " . key($matriz) . "<br> Ligações: <br>";
            fwrite($file,  "Elemento: " . key($matriz) . "\nLigações: \n");
            next($matriz);
            foreach ($data as $other_data => $li) {
                echo $other_data . ' ' . $li . '<br>';
                fwrite($file,  $other_data . " " . $li . "\n");
            }
            echo '<br/><br/>';
        } else {
            echo $data, '<br/>';
        }
    }
    $tempo = endExec();
    $total_t = "Tempo de execução: " . $tempo . "<br>" . PHP_EOL;
    $memoria = memory_get_peak_usage(true) / 1024 / 1024;
    $memprog = memory_get_usage(true) / 1024 / 1024;
    $bytes = $memoria . ' MB<br>';
    $bytesprog = $memprog . ' MB<br>';
    echo "Pico de memoria: " . $bytes . "<br>";
    echo "Uso médio da memoria: " . $bytesprog . "<br>";
    fwrite($file,  "Uso médio da memoria: " . $bytesprog . "\n");
    fclose($file);
    unset($matriz);
    echo $total_t;
}

function BFS($arq, $inicio, $fim) {
    print_r($arq);
    echo $inicio;
    echo $inicio;

    echo '
    <html>
	<head>
		<meta charset="utf-8">
		<title>Algoritmo BFS</title>
	  	<meta name="author" content=""/>
	  	<meta name="description" content="Algoritmo de Busca em largura"/>
	</head>
	<body>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="bfs.js"></script>
		<script>
			$(document).ready(function(){
				var grafo = [[1,1,0,0,1],
				             [0,1,1,1,0],
				             [0,0,1,1,0],
				             [1,0,0,1,0],
				             [0,0,0,1,1]];
                                breadthFirstSearch.bfs('.$arq.','.$inicio.','.$fim.');
				
			});	
		</script>
	</body>
</html>';

}

function DFS($arq, $inicio, $fim) {
    echo $inicio;
    echo '
    <html>
	<head>
		<meta charset="utf-8">
		<title>Algoritmo DFS</title>
	  	<meta name="author" content=""/>
	  	<meta name="description" content="Algoritmo de Busca em profundidade"/>
	</head>
	<body>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="dfs.js"></script>
		<script>
			$(document).ready(function(){
				var grafo = [[1,1,0,0,1],
				             [0,1,1,1,0],
				             [0,0,1,1,0],
				             [1,0,0,1,0],
				             [0,0,0,1,1]];
				    initDFS(grafo, 1, 4);
			});	
		</script>
	</body>
</html>'; //initDFS(.'$arq'.,.'$inicio'.,.'$fim'.);
}

function Busca($arqu, $opcional) {
    include("./cronos.php");
    startExec();
    if ($opcional == "null") {
        $opcional = 1;
    }
    $lines = file("./arquivos/" . $arqu . ".txt"); // Lê um arquivo em um array. 
    $lista = array();
    $qtd_arestas = 0;

    //$name	 		= './relatorios/busca.txt';
    //$file 			= fopen($name, 'a');

    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            $qtd_vertices = $line;
        } else {
            $arestas = $line;
            $aresta = explode(" ", $arestas);
            $vertice1 = (int) $aresta[0];
            $vertice2 = (int) $aresta[1];

            $lista [$vertice1][$vertice2] = $vertice2;
            $lista [$vertice2][$vertice1] = $vertice1;
        }
    }
    echo "<br>Lista de adjacência: <br><br>";
    foreach ($lista as $data) {
        if (is_array($data)) {
            $elem = current($lista);
            echo "Elemento: " . key($lista) . "<br> Ligações: ";
            next($lista);
            foreach ($data as $other_data) {
                echo $other_data . ' ';
            }
            echo '<br/><br/>';
        } else {
            echo $data, '<br/>';
        }
    }
    //DFS($lista,$opcional, 7);
    BFS($lista, $opcional, 7);

    $tempo = endExec();
    $total_t = "Tempo de execução: " . $tempo . "<br>";
    $memoria = memory_get_peak_usage(true) / 1024 / 1024;
    echo memory_get_usage();
    $memprog = memory_get_usage(true) / 1024 / 1024;
    $bytes = $memoria . ' MB';
    $bytesprog = $memprog . ' MB';
    echo "Pico de memoria: " . $bytes . "<br>";
    echo "Pico de memoria: " . $bytesprog . "<br>";

    unset($lista);
    echo $total_t;

    /*     * *************** */
    startExec();
    $matriz = array();
    $i_aux = 1;
    $limite_inferior = $i_aux;
    $limite_superior = $qtd_vertices;
    for ($i = $limite_inferior; $i < $limite_superior; $i++) {
        for ($j = $limite_inferior; $j < $limite_superior; $j++) {
            if ($i == $j) {
                $i_aux = $i + 1;
                $limite_inferior = $i_aux;
            } else if ($i != $j && ($i != 0 && $j != 0)) {
                $matriz [$i][$j] = false;
            }
        }
    }
    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            
        } else {

            $arestas = $line;
            $aresta = explode(" ", $arestas);
            $vertice1 = (int) $aresta[0];
            $vertice2 = (int) $aresta[1];
            echo $vertice1 . "  " . $vertice2 . "<br><br>";
            if ($vertice1 < $vertice2) {
                $matriz [$vertice1][$vertice2] = true;
            } else if ($vertice1 > $vertice2) {
                $matriz [$vertice2][$vertice1] = true;
            }
        }
    }
    echo "<br>Matriz de adjacência: <br><br>";
    foreach ($matriz as $data) {
        if (is_array($data)) {
            $elem = current($matriz);
            echo "Elemento: " . key($matriz) . "<br> Ligações: <br>";
            next($matriz);
            foreach ($data as $other_data => $li) {
                echo $other_data . ' ' . $li . '<br>';
            }
            echo '<br/><br/>';
        } else {
            echo $data, '<br/>';
        }
    }
    BFS($matriz, $opcional, 7);

    $tempo1 = endExec();
    $total_t = "Tempo de execução: " . $tempo1 . "<br>";
    //fclose($file);
    $memoria = memory_get_peak_usage(true) / 1024 / 1024;
    echo memory_get_usage();
    $memprog = memory_get_usage(true) / 1024 / 1024;
    $bytes = $memoria . ' MB';
    $bytesprog = $memprog . ' MB';
    echo "Pico de memoria: " . $bytes . "<br>";
    echo "Pico de memoria: " . $bytesprog . "<br>";
    unset($matriz);
    echo $total_t;

    executa($arqu);
}

function menor_caminho($arquivo, $verticeO, $verticeF) {
    require("Dijkstra.php");
    $g = new Graph();
    $lines = file("./arquivos/" . $arquivo . ".txt"); // Lê um arquivo em um array. 

    foreach ($lines as $line_num => $line) {
        if ($line_num === 0) {
            $qtd_vertices = $line;
        } else {
            $arestas = $line;
            $aresta = explode(" ", $arestas); 
            $vertice1 = $aresta[0];
            $vertice2 = $aresta[1];
            $peso = (floatval($aresta[2]));
            if ($peso >= 0) {
                $g->addedge($vertice1, $vertice2, $peso);
                $g->addedge($vertice2, $vertice1, $peso);
            } else {
                echo "Não é possível calcular com peso negativo!";
                die();
            }
        }
    }
    list($distances, $prev) = $g->paths_from((string)$verticeO);

    $path = $g->paths_to($prev, (string)$verticeF);
    echo "menor caminho:";
    //print_r($path);
    if(sizeof($path)){
    foreach ($path as $k => $v) {
        echo " $v=>";
    }
    echo "fim";
    }else
    echo"Não existe!";
}

if (isset($_POST["O"])) {
    $O = $_POST["O"];
    //echo $O;
    if (isset($_POST["arquivoO"])) {
        $arquivoO = $_POST["arquivoO"];
        if ($arquivoO == "Dijkstra") {
            $verticeO = $_POST["verticeO"];
            $verticeF = $_POST["verticeF"];
            menor_caminho($arquivoO,$verticeO,$verticeF);
            
        } else {
            if (isset($_POST["tipoO"])) {
                $tipoO = $_POST["tipoO"];
                if ($tipoO == "lista") {
                    lst($arquivoO, "null");
                } else if ($tipoO == "matriz") {
                    mtrz($arquivoO, "null");
                }
            } else if (isset($_POST["verticeO"])) {
                $verticeO = $_POST["verticeO"];
                Busca($arquivoO, $verticeO);
            } else {
                executa($arquivoO);
            }
        }
    } else if ($O == "Estudo de caso 1") {
        ec1("as_graph", "null");
    } else if ($O == "Estudo de caso 2") {
        lst("as_graph", "null");
        echo"callback";
    }
}
?>
