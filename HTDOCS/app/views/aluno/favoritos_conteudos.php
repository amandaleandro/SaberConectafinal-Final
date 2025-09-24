<div class="container mt-4">
  <h2 class="mb-4 text-danger"><i class="bi bi-heart-fill"></i> Meus Conteúdos Favoritos</h2>

  <?php if (empty($conteudos)): ?>
    <div class="alert alert-warning">Você ainda não favoritou nenhum conteúdo.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($conteudos as $conteudo): ?>
        <div class="col-md-4">
          <div class="card shadow-sm mb-3">
            <div class="card-body">
              <h5 class="card-title text-primary"><?= htmlspecialchars($conteudo['titulo']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($conteudo['descricao']) ?></p>
              <a href="?route=aluno/visualizarConteudo&id=<?= $conteudo['id'] ?>" class="btn btn-sm btn-outline-success">
                <i class="bi bi-eye"></i> Ver Conteúdo
              </a>
              <a href="?route=aluno/desfavoritarConteudo&id=<?= $conteudo['id'] ?>" 
                 class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Deseja remover dos favoritos?')">
                <i class="bi bi-x-circle"></i> Desfavoritar
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
