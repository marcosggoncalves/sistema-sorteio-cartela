const criarTableRanking = (data) => {
    const table = document.getElementById('ranking');

    table.innerHTML = '';

    data.forEach((apostador, index) => {
        const tr = document.createElement('tr'); 
        let posicao = index + 1;

        const tdPosicao = document.createElement('td');
        tdPosicao.setAttribute('class', posicao <= 3 ? 'table boa' : 'table media');
        const tdPosicaoTexto = document.createTextNode(`${posicao}º`); 
        tdPosicao.appendChild(tdPosicaoTexto);

        const tdNome = document.createElement('td');
        const tdNomeTexto = document.createTextNode(apostador.nome);
        tdNome.appendChild(tdNomeTexto);

        const tdQtdAcertos = document.createElement('td');
        tdQtdAcertos.setAttribute('class', 'text-center');
        const tdQtdAcertosTexto = document.createTextNode(apostador.quantidade_acertos);
        tdQtdAcertos.appendChild(tdQtdAcertosTexto);

        const tdNumeros = document.createElement('td');
        tdNumeros.setAttribute('class', 'text-center');
        const tdNumerosTexto = document.createTextNode(apostador.numeros);
        tdNumeros.appendChild(tdNumerosTexto);

        const tdNumerosAcertos = document.createElement('td');
        tdNumerosAcertos.setAttribute('class', 'text-center');
        const tdNumerosAcertosTexto = document.createTextNode(apostador.numeros_acertos);
        tdNumerosAcertos.appendChild(tdNumerosAcertosTexto);

        tr.appendChild(tdPosicao); 
        tr.appendChild(tdNome);
        tr.appendChild(tdNumeros); 
        tr.appendChild(tdNumerosAcertos); 
        tr.appendChild(tdQtdAcertos);

        table.appendChild(tr);
    });
}

const criarTablerResultadoSorteio =  (data) => {
    const table = document.getElementById('resultado');

    table.innerHTML = '';

    data.forEach((apostador) => {
        const tr = document.createElement('tr'); 
 
        const tdNome = document.createElement('td');
        const tdNomeTexto = document.createTextNode(apostador.apostador);
        tdNome.appendChild(tdNomeTexto);
 
        const tdNumeros = document.createElement('td');
        tdNumeros.setAttribute('class', 'text-center');
        const tdNumerosTexto = document.createTextNode(apostador.numeros_escolhidos);
        tdNumeros.appendChild(tdNumerosTexto);

        const tdNumerosAcertos = document.createElement('td');
        tdNumerosAcertos.setAttribute('class', 'text-center');
        const tdNumerosAcertosTexto = document.createTextNode(apostador.numeros_acertos);
        tdNumerosAcertos.appendChild(tdNumerosAcertosTexto);

        const tdMensagem = document.createElement('td');
        const tdMensagemTexto = document.createTextNode(apostador.mensagem != null ? apostador.mensagem : 'Acertos contabilizados');
        tdMensagem.appendChild(tdMensagemTexto);

        tr.appendChild(tdNome);
        tr.appendChild(tdNumeros); 
        tr.appendChild(tdNumerosAcertos); 
        tr.appendChild(tdMensagem);

        table.appendChild(tr);
    });
}

const mostrarResultadoSorteioNumeros = (reultados) => {
    const {resultado, resultado_ordenado} = reultados;

    let div = document.getElementById('numeros_sorteados');
    div.style.display = 'block';

    let semOrdenacao = document.getElementById('numeros_sem_ordenado');
    semOrdenacao.innerHTML = '';

    resultado.forEach(numero => {
        semOrdenacao.innerHTML += `<div class='cartela-numero'>${numero}</div>`;
    });

    let  ordenado = document.getElementById('numeros_ordenado');
    ordenado.innerHTML = '';

    resultado_ordenado.forEach(numero => {
        ordenado.innerHTML += `<div class="cartela-numero">${numero}</div>`;
    });
}

const carregarRankigApostadores = () => {
    $(document).ready(function () {
        $.ajax({
            url: getHost() + '/ranking',
            type: 'GET',
            success: function (data) {
                criarTableRanking(data)
            },
            error: function (data) { },
        });
    });
}

$(document).ready(function () {
    $('#sortear').on('submit', function (event) {
        event.preventDefault();

        const nome = document.getElementById('nome').value;
        const data = document.getElementById('data').value;
        const inicial = document.getElementById('inicial').value;
        const final = document.getElementById('final').value;

        const body = {
            nome: nome,
            data: data,
            inicial: parseInt(inicial),
            final: parseInt(final)
        };

        $.ajax({
            url: getHost() + '/sortear',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(body),
            success:  (response) => {
                const { numerosSorteados, resultados } = response

                mostrarResultadoSorteioNumeros(numerosSorteados);
                criarTablerResultadoSorteio(resultados);
                mostrarMensagem(null, 'none');

            }, error: (data) => {
                const erros = JSON.parse(data.responseText);

                if (erros && erros.errors) {
                    return mostrarMensagem(erros.errors);
                }

                mostrarMensagem([erros.mensagem]);
            }
        });
    });
});

const setup = () => {
    carregarRankigApostadores();
}

/// Execute 
setup();