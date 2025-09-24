<div class="container my-5">
  <h2 class="mb-4 text-center text-white bg-dark p-3 rounded">📚 Todos os Conteúdos</h2>

  <div class="row">
    <?php if (!empty($conteudos)): ?>
      <?php foreach ($conteudos as $c): ?>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-danger"><?= htmlspecialchars($c['titulo']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($c['descricao']) ?></p>
              <p><small><strong>Matéria:</strong> <?= htmlspecialchars($c['materia_nome']) ?></small></p>

              <div class="mt-auto d-flex flex-column gap-2">
                <a href="?route=conteudo/visualizar&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger w-100">
                  Visualizar
                </a>
                <?php if ($_SESSION['usuario_tipo'] === 'aluno'): ?>
                  <a href="?route=aluno/vincularConteudo&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger w-100">
                    Vincular
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-warning text-center">
          Nenhum conteúdo disponível ainda.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
