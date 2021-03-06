/**
* Algoritmo de Busca em largura
* Algoritmo de busca em grafos utilizado para realizar uma busca ou travessia num grafo e estrutura de dados do tipo árvore.
*
* Complexidade O(|E| + |V|)
*/
var breadthFirstSearch = function(){


	var visitados  = [], listaAtual = [],grafo;

	return { bfs: bfs };
	/**
	* Inicialização do algoritmo
	* @private
	* @param {array} inputGrafo matriz de entrada do grafo
	*/
	function init(inputGrafo) {
		grafo = inputGrafo;
		visitados  = [];
		listaAtual = [];
		for (var i = 0; i < grafo.length; i++)
			visitados[i] = false;
	}

	/**
	* Verifica se existe um caminho entre um determinado nó de início para determinado destino
	* @public
	* @param {array} grafo 
	* @param {number} inicio nó inicial de entrada na matriz
	* @param {number} destino nó final na matriz
	* @return {boolean} true/false dependendo se há caminho entre os nós
	*/
	function bfs(grafo, inicio, destino) {
		init(grafo);
		var atual;
		// https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/Array/push
		listaAtual.push(inicio);
		while (listaAtual.length > 0) {
			console.log("Atual: " + listaAtual);
			// https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/Array/shift
			atual = listaAtual.shift();
			visitados[atual] = true;
			console.log("Array de visitados: " + "["+visitados+"]");
			for (var i = 0; i < grafo.length; i++) {
				console.log("Atual: " + atual + " i: " + i);
				if (grafo[atual][i] == 1) {
					if (i == destino)
					 	console.log("Valor econtrado.");
					if (!visitados[i])
						listaAtual.push([i]);
				}
			}
		}
		return false;
	}

}();