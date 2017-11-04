var saiu = 0;

function initDFS(nodos, inicial, fim)
{
	i = inicial;
	console.log(nodos[i]);
	DFS(nodos, i, fim);
}

function DFS(nodos, i, fim) 
{
	nodos[i].visita = 2;
	if (nodos[i].relIdObj === fim) 
	{
		console.log(nodos[i]);
		saiu = 1;
	}
	if (nodos[i].relIdObj !== fim && saiu === 0) 
	{
		for (var j = 0; j < nodos[i].filhosObj.length; j++) 
		{
			nodo = nodos[i].filhosObj[j].idVertice2;
			if (nodo === fim && saiu === 0) 
			{
				console.log(nodos[nodo]);
				saiu = 1;
			}
			if (nodos[nodo].visita !== 2 && saiu === 0) 
			{
				console.log(nodos[nodo]);
				DFS(nodos, nodos[nodo].relIdObj, fim);
			}
		}
	}
}
