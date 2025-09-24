<div class="container my-4">
  <h2 class="mb-4">Disciplinas Sugeridas</h2>

  <?php if (empty($materias)): ?>
    <div class="alert alert-info">Nenhuma sugestão de disciplina no momento.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($materias as $materia): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm border-success">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-success"><?= htmlspecialchars($materia['nome']) ?></h5>
              <p class="card-text flex-grow-1"><?= htmlspecialchars($materia['descricao'] ?? 'Sem descrição') ?></p>

              <div class="d-flex justify-content-between align-items-center mt-2">
                <a href="?route=aluno/vincularMateria&id=<?= $materia['id'] ?>" class="btn btn-success btn-sm">
                  <i class="bi bi-plus-circle"></i> Vincular
                </a>
                <a href="?route=aluno/favoritarMateria&id=<?= $materia['id'] ?>" class="btn btn-outline-warning btn-sm">
                  <i class="bi bi-heart"></i> Favoritar
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
