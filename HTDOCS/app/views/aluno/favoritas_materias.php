<div class="container mt-4">
  <h2 class="mb-4 text-danger"><i class="bi bi-heart-fill"></i> Minhas Matérias Favoritas</h2>

  <?php if (empty($materias)): ?>
    <div class="alert alert-warning">Você ainda não favoritou nenhuma matéria.</div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($materias as $materia): ?>
        <div class="col-md-4">
          <div class="card shadow-sm mb-3">
            <div class="card-body">
              <h5 class="card-title text-primary"><?= htmlspecialchars($materia['nome']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($materia['descricao']) ?></p>
              <a href="?route=aluno/visualizarMateria&id=<?= $materia['id'] ?>" class="btn btn-sm btn-outline-success">
                <i class="bi bi-eye"></i> Ver Detalhes
              </a>
              <a href="?route=aluno/desfavoritarMateria&id=<?= $materia['id'] ?>" 
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
