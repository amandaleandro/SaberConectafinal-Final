<div class="container text-center my-5">
    <h1 class="display-3 text-secondary"><?= htmlspecialchars($error['code'] ?? 503) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Manutenção') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'O sistema está temporariamente indisponível.') ?></p>
    <p><?= htmlspecialchars($error['suggestion'] ?? 'Voltaremos em breve. Obrigado pela compreensão.') ?></p>

    <a href="?route=site/home" class="btn btn-secondary mt-3">Voltar para a Home</a>
</div>
