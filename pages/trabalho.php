<?php
function grafico($arqu,$ming,$maxg,$mgp)
{  
	echo " 
	<!DOCTYPE html>
	<html lang='pt-br'>
		<body>
			<table>
				<tr>
					<td>
						<div id='piechart'></div>
					</td> 
					<td>
						<div id='table_div'></div>
					</td>
				</tr>
			</table>
			<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
			<script type='text/javascript'>
				// Load google charts
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);
				// Draw the chart and set the chart values
				function drawChart()
				{
					var data = google.visualization.arrayToDataTable
					([
					['Task', 'Grau'],
					['Menor grau',".$ming."],
					['Maior grau', ".$maxg."],
					['Maior grau possível', ".$mgp."]
					]);
					var options = {'title':'".$arqu.".txt', 'width':550, 'height':400, legend: { textStyle: { fontSize: 12 } }, legend: true};
					var chart = new google.visualization.LineChart(document.getElementById('piechart'));
					chart.draw(data, options);  
				}
				google.charts.load('current', {'packages':['table']});
				google.charts.setOnLoadCallback(drawTable);

				function drawTable() 
				{
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Grau');
					data.addColumn('number', 'Valor');
					data.addRows([
					['Menor grau',  {v: 10000, f: '".$ming."'}],
					['Maior grau',   {v:8000,   f: '".$maxg."'}],
					['Maior grau possível', {v: 12500, f: '".$mgp."'}]
					]);

					var table = new google.visualization.Table(document.getElementById('table_div'));

					table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
				}
			</script>
		</body>
	</html>
	";
}
function executa ($arqu)
{
	$lines 			= file ("./arquivos/".$arqu.".txt");// Lê um arquivo em um array. 
	$lista1 		= array ();
	$qtd_arestas	= 0;

	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
			$qtd_vertices = $line;
		}
		else
		{
			$arestas 	= $line;
			$aresta  	= explode (" ", $arestas);
			$vertice1 		= (int)$aresta[0];
			$vertice2		= (int)$aresta[1];
			
			array_push ($lista1, $vertice1);
			array_push ($lista1, $vertice2);
			$qtd_arestas++;
		}
	}

	$grau	 = array_count_values($lista1);
	
	$name	 = './relatorios/Parte_1.txt';
	$maxg =max($grau);
	$ming =min($grau);
	$text	 = "# n = ".$qtd_vertices;
	$text	 .= "# m = ".$qtd_arestas.PHP_EOL;
	$text	 .= "maior grau: ".$maxg.PHP_EOL;
	$text	 .= "menor grau: ".$ming.PHP_EOL;
	$mgp = (int)$qtd_vertices-1;
	
	$file 		= fopen($name, 'a');
	fwrite($file, $text);
	
	ksort($grau);
	echo "<br># n = ".$qtd_vertices."<br># m = ".$qtd_arestas."<br>maior grau: ".$maxg."<br>menor grau: ".$ming;
    echo "<br><br>Graus:<br>";
	foreach ($grau as $key => $value) 
	{
		$graus ="{$key}  {$value}".PHP_EOL;
		echo $graus."<br>";
		//fwrite($file, $graus);
	}
	fclose($file);
	grafico($arqu,$ming,$maxg,$mgp);
	unset($lines);
	unset($grau);
	unset($lista1);
}
function BFS($arq, $inicio, $fim)
{
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
				breadthFirstSearch.bfs(grafo, 1, 4);
				
			});	
		</script>
	</body>
</html>';
//breadthFirstSearch.bfs(.'$arq'.,.'$inicio'.,.'$fim'.);
}
function DFS ($arq, $inicio, $fim)
{
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
</html>';//initDFS(.'$arq'.,.'$inicio'.,.'$fim'.);
}
function lst ($arqu)
{
	include("./cronos.php");
	startExec();
	
	$lines 			= file ("./arquivos/".$arqu.".txt");// Lê um arquivo em um array. 
	$lista 			= array ();
	$qtd_arestas	= 0;
	
	$name	 		= './relatorios/lista_adjacencia.txt';
	$file 			= fopen($name, 'a');
	
	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
			$qtd_vertices = $line;
		}
		else
		{
		    
			$arestas 	= $line;
			$aresta  	= explode (" ", $arestas);
			$vertice1 		= (int)$aresta[0];
			$vertice2		= (int)$aresta[1];
			
			$lista [$vertice1][$vertice2] =  $vertice2;
			$lista [$vertice2][$vertice1] = $vertice1;
		}
	}
	echo "<br>Lista de adjacência: <br><br>";
    foreach($lista as $data)
    {
        if(is_array($data))
        {
            $elem = current($lista);
            echo "Elemento: ".key($lista)."<br> Ligações: " ;
            next($lista);
            foreach($data as $other_data)
            {
                echo $other_data.' ';
            }
            echo '<br/><br/>';
        }
        else
        {
            echo $data, '<br/>';
        }
        
    }
    //var_dump($lista);
	
    $tempo = endExec();
    $total_t = "Tempo de execução: ".$tempo."<br>";
	$memoria = memory_get_peak_usage(true)/1024/1024;
		echo memory_get_usage()."memoria gasta de lista";
	$memprog = memory_get_usage(true)/1024/1024;
    $bytes = $memoria . ' MB';
	$bytesprog = $memprog . ' MB';
    echo "Pico de memoria: ".$bytes."<br>";
	echo "Uso médio da memoria: ".$bytesprog."<br>";
    fclose($file);

    unset($lista);
	unset ($qtd_arestas);
	unset ($qtd_vertices);
    echo $total_t;  
}

function mtrz ($arqu)
{
	include("./cronos.php");
	startExec();
	
	$lines 			= file ("./arquivos/".$arqu.".txt");// Lê um arquivo em um array. 
	$matriz 		= array ();

	$name	 = './relatorios/matriz_adjacencia.txt';
	$file 		= fopen($name, 'a');
	
/*	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
			$qtd_vertices = $line;
		}
		break 1;
	}
	$i_aux = 1;
	$limite_inferior = $i_aux;
	$limite_superior = $qtd_vertices;
	for($i = $limite_inferior; $i < $limite_superior; $i++ )
	{
	   for($j = $limite_inferior; $j < $limite_superior; $j++ )
	   {
			if($i==$j)
			{
				$i_aux = $i+1;
				$limite_inferior = $i_aux;  
			}
			else  if($i!=$j && ($i !=0 && $j != 0))
			{
				$matriz [$i][$j] = false;
			}
	    }
	}*/
	
	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
			$qtd_vertices = $line;
		}
		else
		{
		    
			$arestas 	= $line;
			$aresta  	= explode (" ", $arestas);
			$vertice1 		= (int)$aresta[0];
			$vertice2		= (int)$aresta[1];
			//echo $vertice1 ."  ".$vertice2."<br><br>";
			if ($vertice1 < $vertice2)
            {
                $matriz [$vertice1][$vertice2] =  true;
            }
           else if ($vertice1 > $vertice2)
            {
                $matriz [$vertice2][$vertice1] = true;
            }
		}
	}
	echo "<br>Matriz de adjacência: <br><br>";
    foreach($matriz as $data)
    {
        if(is_array($data))
        {
            $elem = current($matriz);
            echo "Elemento: ".key($matriz)."<br> Ligações: <br>" ;
            next($matriz);
            foreach($data as $other_data => $li)
            {
                echo $other_data.' '. $li.'<br>';
            }
            echo '<br/><br/>';
        }
        else
        {
            echo $data, '<br/>';
        }
        
    }
    //var_dump($matriz);
    //	fwrite($file,  print_r($lista));
    $tempo = endExec();
    $total_t = "Tempo de execução: ".$tempo."<br>".PHP_EOL;
	$memoria = memory_get_peak_usage(true)/1024/1024;
	echo memory_get_usage()."memoria gasta na matriz";
	$memprog = memory_get_usage(true)/1024/1024;
    $bytes = $memoria . ' MB';
	$bytesprog = $memprog . ' MB';
    echo "Pico de memoria: ".$bytes."<br>";
	echo "Uso médio da memoria: ".$bytesprog."<br>";
    fclose($file);
    unset($matriz);
    unset($lista1);

    echo $total_t;
}

function Busca($arqu, $opcional)
{
	include("./cronos.php");
	startExec();
	if ($opcional == "null")
	{
		$opcional 	= 1;
	}
	$lines 			= file ("./arquivos/".$arqu.".txt");// Lê um arquivo em um array. 

	$lista 			= array ();
	$qtd_arestas	= 0;
	
	$name	 		= './relatorios/busca.txt';
	$file 			= fopen($name, 'a');
	
	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
			$qtd_vertices = $line;
		}
		else
		{
		    
			$arestas 	= $line;
			$aresta  	= explode (" ", $arestas);
			$vertice1 		= (int)$aresta[0];
			$vertice2		= (int)$aresta[1];
			
			$lista [$vertice1][$vertice2] =  $vertice2;
			$lista [$vertice2][$vertice1] = $vertice1;
		}
	}
	echo "<br>Lista de adjacência: <br><br>";
    foreach($lista as $data)
    {
        if(is_array($data))
        {
            $elem = current($lista);
            echo "Elemento: ".key($lista)."<br> Ligações: " ;
            next($lista);
            foreach($data as $other_data)
            {
                echo $other_data.' ';
            }
            echo '<br/><br/>';
        }
        else
        {
            echo $data, '<br/>';
        }
        
    }
	//DFS($lista,$opcional, 7);
	BFS($lista,$opcional, 7);
	
    $tempo = endExec();
    $total_t = "Tempo de execução: ".$tempo."<br>";
	$memoria = memory_get_peak_usage(true)/1024/1024;
	echo memory_get_usage();
	$memprog = memory_get_usage(true)/1024/1024;
    $bytes = $memoria . ' MB';
	$bytesprog = $memprog . ' MB';
    echo "Pico de memoria: ".$bytes."<br>";
	echo "Pico de memoria: ".$bytesprog."<br>";
	
    unset($lista);
    echo $total_t;
    
	/******************/
	startExec();
	$matriz 		= array ();

		$i_aux = 1;
	$limite_inferior = $i_aux;
	$limite_superior = $qtd_vertices;
	for($i = $limite_inferior; $i < $limite_superior; $i++ )
	{
	   for($j = $limite_inferior; $j < $limite_superior; $j++ )
	   {
			if($i==$j)
			{
				$i_aux = $i+1;
				$limite_inferior = $i_aux;  
			}
			else  if($i!=$j && ($i !=0 && $j != 0))
			{
				$matriz [$i][$j] = false;
			}
	    }
	}
	foreach ($lines as $line_num => $line)
	{
		if($line_num === 0)
		{
		}
		else
		{
		    
			$arestas 	= $line;
			$aresta  	= explode (" ", $arestas);
			$vertice1 		= (int)$aresta[0];
			$vertice2		= (int)$aresta[1];
			echo $vertice1 ."  ".$vertice2."<br><br>";
			if ($vertice1 < $vertice2)
            {
                $matriz [$vertice1][$vertice2] =  true;
            }
           else if ($vertice1 > $vertice2)
            {
                $matriz [$vertice2][$vertice1] = true;
            }
		}
	}
	echo "<br>Matriz de adjacência: <br><br>";
    foreach($matriz as $data)
    {
        if(is_array($data))
        {
            $elem = current($matriz);
            echo "Elemento: ".key($matriz)."<br> Ligações: <br>" ;
            next($matriz);
            foreach($data as $other_data => $li)
            {
                echo $other_data.' '. $li.'<br>';
            }
            echo '<br/><br/>';
        }
        else
        {
            echo $data, '<br/>';
        }
        
    }
//	DFS ($matriz,$opcional, 7);
	BFS ($matriz,$opcional, 7);  
	
    $tempo1 = endExec();
    $total_t = "Tempo de execução: ".$tempo1."<br>";
    fclose($file);

	$memoria = memory_get_peak_usage(true)/1024/1024;
	echo memory_get_usage();
	$memprog = memory_get_usage(true)/1024/1024;
    $bytes = $memoria . ' MB';
	$bytesprog = $memprog . ' MB';
    echo "Pico de memoria: ".$bytes."<br>";
	echo "Pico de memoria: ".$bytesprog."<br>";
	unset($matriz);
    echo $total_t;
	
	executa ($arqu);
}

if(isset($_POST["O"]))
{
	$O = $_POST["O"];   
	//echo $O;
	if(isset($_POST["arquivoO"]))
	{
		$arquivoO = $_POST["arquivoO"]; 
		if(isset($_POST["tipoO"]))
		{
			$tipoO = $_POST["tipoO"]; 
			if($tipoO == "lista")
			{
				lst ($arquivoO, "null");
			}
			else if($tipoO == "matriz")
			{
				mtrz ($arquivoO, "null");
			}
			//echo $O;
			//echo  $arquivoO;
		}
		else if(isset($_POST["verticeO"]))
		{
			$verticeO = $_POST["verticeO"];
			Busca ($arquivoO,$verticeO);

		}
		else 
		{
			executa ($arquivoO);
		}
	}
	else if($O == "Estudo de caso 1")
	{
		ec1 ("as_graph", "null");
	}
	else if($O == "Estudo de caso 2")
	{
		lst ("as_graph", "null");
		echo"callback";
	}
	else;
}
?>
