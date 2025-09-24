<div class="container my-5">
  <div class="text-center">
    <h1 class="display-3 text-danger"><?= $error['code'] ?? 405 ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Método Não Permitido') ?></h2>
    <p class="lead mb-4"><?= htmlspecialchars($error['message'] ?? 'A ação que você tentou executar não é permitida para esta rota.') ?></p>
    
    <?php if (!empty($error['suggestion'])): ?>
      <p class="text-muted"><?= htmlspecialchars($error['suggestion']) ?></p>
    <?php endif; ?>

    <a href="?route=site/home" class="btn btn-danger mt-3">Voltar para Home</a>
  </div>
</div>
