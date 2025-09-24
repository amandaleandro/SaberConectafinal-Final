<div class="container my-4">
  <h2 class="mb-4">Minhas Disciplinas</h2>

  <?php if (empty($materias)): ?>
    <div class="alert alert-info">Você ainda não está vinculado a nenhuma disciplina.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($materias as $materia): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($materia['nome']) ?></h5>
              <p class="card-text flex-grow-1"><?= htmlspecialchars($materia['descricao'] ?? 'Sem descrição') ?></p>
              
              <div class="d-flex justify-content-between align-items-center mt-2">
                <a href="?route=aluno/visualizarMateria&id=<?= $materia['id'] ?>" class="btn btn-primary btn-sm">
                  <i class="bi bi-eye"></i> Ver
                </a>
                <?php if (!empty($materia['favorita'])): ?>
                  <a href="?route=aluno/desfavoritarMateria&id=<?= $materia['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-heart-fill"></i> Desfavoritar
                  </a>
                <?php else: ?>
                  <a href="?route=aluno/favoritarMateria&id=<?= $materia['id'] ?>" class="btn btn-outline-warning btn-sm">
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
