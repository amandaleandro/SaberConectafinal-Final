<div class="container my-5">
  <div class="card shadow p-4">
    <h2 class="text-center mb-4 text-danger">📚 Conteúdos Sugeridos</h2>

    <?php if (!empty($sugeridos)): ?>
      <div class="row g-4">
        <?php foreach ($sugeridos as $c): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title text-danger fw-bold">
                  <?= htmlspecialchars($c['titulo']) ?>
                </h5>
                <p class="text-muted small mb-1">
                  Matéria: <strong><?= htmlspecialchars($c['materia_nome']) ?></strong>
                </p>
                <p class="card-text flex-grow-1">
                  <?= nl2br(htmlspecialchars(substr($c['descricao'], 0, 100))) ?>...
                </p>

                <div class="mt-3 d-flex flex-column gap-2">
                  <a href="?route=conteudo/visualizar&id=<?= $c['id'] ?>" 
                     class="btn btn-outline-danger btn-sm w-100">
                    Visualizar
                  </a>
                  <a href="?route=aluno/vincularMateria&id=<?= $c['materia_id'] ?>" 
                     class="btn btn-danger btn-sm w-100">
                    Seguir Matéria
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">
        Nenhum conteúdo sugerido no momento 🎉
      </div>
    <?php endif; ?>
  </div>
</div>
