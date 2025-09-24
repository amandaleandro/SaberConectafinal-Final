<div class="container text-center my-5">
    <h1 class="display-3 text-warning"><?= htmlspecialchars($error['code'] ?? 403) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Acesso Negado') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'Você não tem permissão para acessar esta página.') ?></p>
    <p><?= htmlspecialchars($error['suggestion'] ?? 'Entre na sua conta ou contate o administrador.') ?></p>

    <a href="?route=site/home" class="btn btn-warning mt-3">Voltar para a Home</a>
</div>
