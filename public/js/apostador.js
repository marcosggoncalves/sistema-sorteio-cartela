const criarCartela = (min, max) => {
    const container = document.getElementById('cartela');
    const inputNumeros = document.getElementById('numeros');
    const numerosSelecionados = [];

    if (min < 1 || min > 5) {
        return console.log('Mínimo 1 e máximo 5');
    }

    if (max < 60 || max > 80) {
        return console.log('Mínimo 60 e máximo 80');
    }

    for (let i = min; i <= max; i++) {
        container.innerHTML = '';

        for (let i = min; i <= max; i++) {
            const div = document.createElement('div');
            div.setAttribute('class', 'cartela-numero');

            const divTexto = document.createTextNode(i);
            div.appendChild(divTexto);

            div.addEventListener('click', () => {
                const index = numerosSelecionados.indexOf(i);

                if (index > -1) {
                    numerosSelecionados.splice(index, 1);
                    div.classList.remove('selecionado');
                    inputNumeros.value = numerosSelecionados.join(', ');
                    mostrarMensagem(null, 'none');
                    return;
                }

                if (numerosSelecionados.length == 6) {
                    return mostrarMensagem(["Você já selecionou os 6 números da sorte!"]);
                }

                numerosSelecionados.push(i);
                div.classList.add('selecionado');
                inputNumeros.value = numerosSelecionados.join(', ');
            });

            container.appendChild(div);
        }
    }
}

const criarTabeApostadores = (data) => {
    const table = document.getElementById('apostadores');

    table.innerHTML = '';

    data.forEach(apostador => {
        const tr = document.createElement('tr');

        const tdNome = document.createElement('td');
        const tdNomeTexto = document.createTextNode(apostador.nome);
        tdNome.appendChild(tdNomeTexto);

        const tdCartelaId = document.createElement('td');
        tdCartelaId.setAttribute('class', 'text-center');
        const tdCartelaIdTexto = document.createTextNode(apostador.cartela_id);
        tdCartelaId.appendChild(tdCartelaIdTexto);

        const tdNumeros = document.createElement('td');
        tdNumeros.setAttribute('class', 'text-center');
        const tdNumerosTexto = document.createTextNode(apostador.numeros);
        tdNumeros.appendChild(tdNumerosTexto);

        const tdIconeExcluir = document.createElement('td');
        tdIconeExcluir.setAttribute('class', 'text-center');
        const iconElement = document.createElement('i');
        iconElement.setAttribute('class', 'fa fa-trash');
        tdIconeExcluir.appendChild(iconElement);

        tdIconeExcluir.addEventListener('click', () => deleteApostador(apostador.id));

        tr.appendChild(tdNome);
        tr.appendChild(tdCartelaId);
        tr.appendChild(tdNumeros);
        tr.appendChild(tdIconeExcluir);

        table.appendChild(tr);
    });
}

const deleteApostador = (id) => {
    $.ajax({
        url: getHost() + '/deletar-apostador?id=' + id,
        type: 'DELETE',
        success: (response) => {
            const { mensagem } = response
            mostrarMensagem([mensagem], 'block', 'success');
            carregarApostadores();
        },
        error: (data) => mostrarMensagem([data.toString()])
    });
}

const carregarApostadores = () => {
    $(document).ready(function () {
        $.ajax({
            url: getHost() + '/listagem',
            type: 'GET',
            success: function (data) {
                criarTabeApostadores(data)
            },
            error: function (data) { },
        });
    });
}

$(document).ready(function () {
    $('#apostador').on('submit', function (event) {
        event.preventDefault();

        let nome = document.getElementById('nome').value
        let numeros = document.getElementById('numeros').value;

        numeros = numeros.split(',').map(numero => numero.trim()).filter(numero => numero !== '')
       

        $.ajax({
            url: getHost() + '/novo-apostador',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify( { nome, numeros}),
            success:  (response) =>{
                const { mensagem } = response

                $('#apostador')[0].reset();

                mostrarMensagem([mensagem], 'block', 'success');
                
                setup();
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
    criarCartela(1, 80);

    carregarApostadores();
}

/// Execute 
setup();