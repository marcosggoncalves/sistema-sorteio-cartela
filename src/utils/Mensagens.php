<?php

namespace CooperTest\Utils;

class Mensagens {
    const MENSAGEM_404 = "Erro ao carregar a visualização.";
    const MENSAGEM_ERRO_BANCO = "Erro na conexão com o banco de dados:";
    const MENSAGEM_ARQUIVO_NAO_ENCONTRADO = "Erro: arquivo de rota não encontrado.";
    const MENSAGEM_ERRO_ROUTER_NAO_ECONTRADA = "Erro 404: Rota não encontrada.";
    const MENSAGEM_ERRO_AO_SALVAR_APOSTADOR = "Erro ao salvar apostador:";
    const MENSAGEM_ERRO_AO_EXCLUIR_APOSTADOR = "Erro ao excluir apostador:";
    const MENSAGEM_ERRO_AO_LISTAR_APOSTADORES = "Erro ao listar apostadores: ";
    const MENSAGEM_CADASTRO_APOSTADOR_VAZIO= "Informe o nome e os números do apostador!";
    const MENSAGEM_CADASTRO_APOSTADOR_CARACTERES_INSUFICIENTE = "Nome do apostador precisa ter pelos menos 4 caracteres";
    const MENSAGEM_CADASTRO_REALIZADO = "Cadastro realizado com sucesso!";
    const MENSAGEM_CADASTRO_DELETADO = "Cadastro deletado com sucesso!";
    const MENSAGEM_ID_NAO_INFORMADO =  "ID do apostador não foi informado!";
    const MENSAGEM_ERRO_AO_DELETAR_CADASTRO = "Não foi possivel deletar cadastro com sucesso!";
    const MENSAGEM_CADASTRO_APOSTADOR_QTD_NUMEROS_INVALIDOS= "Quantidade de números selecionados é inválido, só pode escolher 6 números!";
    const MENSAGEM_LISTAGEM_APOSTADORES_VAZIA = "Nenhum apostador encontrado, cadastra!";
    const MENSAGEM_ERRO_AO_CADASTRAR_RESULTADOS = "Não foi possivel cadastrar resultados!";
    const MENSAGEM_ERRO_BODY = "Body não foi informada!";
    const NOME_LOTERIA_INSUFICIENTE = 'O nome da loteria deve ter pelo menos 5 caracteres.';
    const DATA_SORTEIO_INVALIDA = 'A data do sorteio deve ser uma data válida e futura.';
    const NUMERO_INICIAL_INVALIDO = 'O número inicial deve ser maior ou igual a 1.';
    const NUMERO_FINAL_INVALIDO = 'O número final não pode ser maior que 80.';
    const NUMERO_FINAL_MENOR_INICIAL = 'O número final deve ser maior ou igual ao número inicial.';
    const NAO_HOUVE_ACERTOS = 'Não houve acertos.';
}