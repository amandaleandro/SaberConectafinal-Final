<div class="container my-4">
  <h2 class="mb-4">Meus Conteúdos</h2>

  <?php if (empty($conteudos)): ?>
    <div class="alert alert-info">Você ainda não tem conteúdos vinculados.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($conteudos as $conteudo): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($conteudo['titulo']) ?></h5>
              <p class="card-text flex-grow-1"><?= htmlspecialchars($conteudo['descricao'] ?? 'Sem descrição') ?></p>
              <small class="text-muted">Tipo: <?= htmlspecialchars($conteudo['tipo']) ?></small>

              <div class="d-flex justify-content-between align-items-center mt-2">
                <a href="?route=aluno/visualizarConteudo&id=<?= $conteudo['id'] ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-eye"></i> Ver
                </a>
                <?php if (!empty($conteudo['favorito'])): ?>
                  <a href="?route=aluno/desfavoritarConteudo&id=<?= $conteudo['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-heart-fill"></i> Desfavoritar
                  </a>
                <?php else: ?>
                  <a href="?route=aluno/favoritarConteudo&id=<?= $conteudo['id'] ?>" class="btn btn-outline-warning btn-sm">
                    <i class="bi bi-heart"></i> Favoritar
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
