<div class="container my-5">
  <h2 class="text-danger mb-4">Minhas Matérias</h2>

  <?php if (!empty($_GET['msg'])): ?>
    <div class="alert alert-success">
      <?php if ($_GET['msg'] === 'sucesso'): ?>
        Matéria cadastrada com sucesso!
      <?php elseif ($_GET['msg'] === 'atualizado'): ?>
        Matéria atualizada com sucesso!
      <?php elseif ($_GET['msg'] === 'excluido'): ?>
        Matéria excluída com sucesso!
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="mb-3">
    <a href="?route=materia/form" class="btn btn-danger">
      <i class="bi bi-plus-circle"></i> Nova Matéria
    </a>
  </div>

  <?php if (empty($materias)): ?>
    <p>Nenhuma matéria cadastrada ainda.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Nível de Ensino</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($materias as $m): ?>
            <tr>
              <td><?= htmlspecialchars($m['nome']) ?></td>
              <td><?= htmlspecialchars($m['descricao']) ?></td>
              <td><?= htmlspecialchars($m['nivel_ensino']) ?></td>
              <td>
                <a href="?route=materia/form&id=<?= $m['id'] ?>" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="?route=materia/excluir&id=<?= $m['id'] ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Deseja realmente excluir esta matéria?')">
                  <i class="bi bi-trash"></i> Excluir
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
