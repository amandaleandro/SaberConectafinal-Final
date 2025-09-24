<div class="container my-5">
  <h2 class="text-center mb-4 text-danger">Todas as Matérias</h2>

  <?php if (!empty($materias)): ?>
    <div class="row">
      <?php foreach ($materias as $m): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-danger"><?= htmlspecialchars($m['nome']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($m['descricao']) ?></p>
              <p class="text-muted"><strong>Nível:</strong> <?= htmlspecialchars($m['nivel_ensino']) ?></p>
              <a href="?route=aluno/vincularMateria&id=<?= $m['id'] ?>" class="btn btn-danger btn-sm">
                Vincular
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">
      Nenhuma matéria cadastrada no sistema.
    </div>
  <?php endif; ?>
</div>
