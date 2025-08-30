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
                        <form class="row g-3 mt-1" id="apostador">
                            <div class="col-12">
                                <input type="text" id="nome" class="form-control" placeholder="Digite o nome do apostador" aria-label="Nome">
                            </div>
                            <div class="col-12">
                                <input type="text" disabled id="numeros" class="form-control" placeholder="Meus números escolhidos" aria-label="Números">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="titulo">
                            <h1>Apostadores</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="text-center">Cartelas</th>
                                        <th class="text-center">Números</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="apostadores"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="titulo">
                    <h1>Selecione seus 6 números da sorte:</h1>
                </div>
                <div class="cartela" id="cartela"></div>
            </div>
        </div>
    </div>

    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/apostador.js"></script>
    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/mensagem.js"></script>
    <script src="<?= $_ENV['NAME_PASTA'] ?>/public/js/host.js"></script>
</body>
</html>
