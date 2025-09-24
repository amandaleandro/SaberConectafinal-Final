<div class="container text-center my-5">
    <h1 class="display-3 text-dark"><?= htmlspecialchars($error['code'] ?? 500) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Erro') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'Ocorreu um erro inesperado.') ?></p>
    <?php if (!empty($error['suggestion'])): ?>
        <p><?= htmlspecialchars($error['suggestion']) ?></p>
    <?php endif; ?>

    <a href="?route=site/home" class="btn btn-dark mt-3">Voltar para a Home</a>
</div>
