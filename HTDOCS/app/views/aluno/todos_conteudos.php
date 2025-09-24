<div class="container my-5">
  <h2 class="mb-4 text-center">📚 Todos os Conteúdos</h2>

  <?php if (!empty($conteudos)): ?>
    <div class="row g-4">
      <?php foreach ($conteudos as $c): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1"><?= htmlspecialchars($c['titulo']) ?></h5>
              <small class="text-muted mb-2">
                <?= htmlspecialchars(strtoupper($c['tipo'] ?? 'conteúdo')) ?>
                • <?= htmlspecialchars($c['nivel_dificuldade'] ?? 'médio') ?>
              </small>
              <p class="card-text flex-grow-1">
                <?= htmlspecialchars(mb_strimwidth($c['descricao'] ?? '', 0, 120, '...')) ?>
              </p>
              <div class="d-flex gap-2 mt-2">
                <a href="?route=aluno/visualizarConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-outline-secondary">Ver</a>
                <a href="?route=aluno/vincularConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-danger">Vincular</a>
                <a href="?route=aluno/favoritarConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-heart"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="text-center p-4 border rounded-3 bg-light">
      <p class="mb-2">Nenhum conteúdo encontrado ainda.</p>
      <a class="btn btn-primary" href="?route=aluno/dashboard">Voltar ao Dashboard</a>
    </div>
  <?php endif; ?>
</div>
