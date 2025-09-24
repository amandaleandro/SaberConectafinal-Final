<div class="container my-5">
  <h2 class="mb-4 text-danger">Minhas Matérias</h2>

  <!-- Botão para adicionar -->
  <a href="?route=materia/form" class="btn btn-danger mb-4">
    <i class="bi bi-plus-circle me-2"></i> Nova Matéria
  </a>

  <?php if (!empty($materias)): ?>
    <div class="row g-4">
      <?php foreach ($materias as $materia): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title fw-bold text-dark">
                <?= htmlspecialchars($materia['nome']) ?>
              </h5>
              <p class="card-text text-muted">
                <?= htmlspecialchars($materia['descricao']) ?>
              </p>
              <span class="badge bg-danger">
                <?= htmlspecialchars($materia['nivel_ensino']) ?>
              </span>
            </div>
            <div class="card-footer bg-white text-end">
              <a href="?route=materia/form&id=<?= $materia['id'] ?>" 
                 class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i> Editar
              </a>
              <a href="?route=materia/excluir&id=<?= $materia['id'] ?>" 
                 class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Tem certeza que deseja excluir esta matéria?')">
                <i class="bi bi-trash"></i> Excluir
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-info">
      <i class="bi bi-info-circle me-2"></i> Nenhuma matéria cadastrada ainda.
    </div>
  <?php endif; ?>
</div>
