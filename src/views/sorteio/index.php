<!DOCTYPE html>
<html lang="pt-br">
<?php include_once __DIR__ . '/../../../public/componentes/head.inc.php' ?>

<body>
    <?php include_once __DIR__ . '/../../../public/componentes/header.inc.php' ?>

    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-6 mb-4">
                <div class="row">
                    <div class="col-12">
                        <form class="row g-3 mt-1" id="sortear">
                            <div class="col-12">
                                <input type="text" id="nome" class="form-control" placeholder="Digite o nome da loteria" aria-label="Nome">
                            </div>
                            <div class="col-12">
                                <input type="date" id="data" class="form-control" aria-label="Data">
                            </div>
                            <div class="col-12">
                                <input type="number" id="inicial" class="form-control" placeholder="Número inicial" min="1" aria-label="Número inicial">
                            </div>
                            <div class="col-12">
                                <input type="number" id="final" class="form-control" placeholder="Número final" min="1" aria-label="Número final">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Realizar Sorteio</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-4">
                        <div id="numeros_sorteados">
                            <div class="titulo">
                                <h1>Números Sorteados</h1>
                            </div>
                            Sem Ordenação: <div class="cartela" id="numeros_sem_ordenado"></div>
                            Ordenados: <div class="cartela" id="numeros_ordenado"></div>
                        </div>
                        <div>
                            <div class="titulo">
                                <h1>Resultados</h1>
                            </div>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="text-center">Escolhidos</th>
                                        <th class="text-center">Acertados</th>
                                        <th>Mensagem</th>
                                    </tr>
                                </thead>
                                <tbody id="resultado"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="titulo">
                    <h1>Ranking Apostadores (Top 5)</h1>
                </div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th class="text-center">Números</th>
                            <th class="text-center">Acertos</th>
                            <th class="text-center">Total Acertos</th>
                        </tr>
                    </thead>
                    <tbody id="ranking"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/sorteio.js"></script>
    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/mensagem.js"></script>
    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/host.js"></script>
</body>
</html>
