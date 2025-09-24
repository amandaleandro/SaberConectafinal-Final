<div class="container text-center my-5">
    <h1 class="display-3 text-danger"><?= htmlspecialchars($error['code'] ?? 500) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Erro Interno') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'Ocorreu um erro interno no servidor.') ?></p>
    <p><?= htmlspecialchars($error['suggestion'] ?? 'Tente novamente mais tarde ou contate o suporte.') ?></p>

    <a href="?route=site/home" class="btn btn-danger mt-3">Voltar para a Home</a>
</div>
