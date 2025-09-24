<div class="container text-center my-5">
    <h1 class="display-3 text-danger"><?= htmlspecialchars($error['code'] ?? 404) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Página Não Encontrada') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'A página solicitada não foi encontrada.') ?></p>
    <p><?= htmlspecialchars($error['suggestion'] ?? 'Verifique o endereço digitado ou volte para a página inicial.') ?></p>

    <a href="?route=site/home" class="btn btn-danger mt-3">Voltar para a Home</a>
</div>
