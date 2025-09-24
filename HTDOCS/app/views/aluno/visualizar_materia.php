<?php include_once __DIR__ . '/../partials/header.php'; ?>
<div class="container my-5">
  <h2 class="mb-4">Detalhes da Matéria</h2>
  <?php if (empty($materia)): ?>
    <div class="alert alert-warning">Matéria não encontrada.</div>
  <?php else: ?>
    <div class="card shadow-sm">
      <div class="card-body text-dark">
        <h3><?= htmlspecialchars($materia['nome']) ?></h3>
        <p><?= htmlspecialchars($materia['descricao'] ?? 'Sem descrição') ?></p>
        <p><strong>Nível:</strong> <?= htmlspecialchars($materia['nivel_ensino'] ?? '') ?></p>
        <!-- Você pode mostrar outros campos dependendo de sua tabela -->
        <a href="?route=aluno/minhasMaterias" class="btn btn-secondary mt-3">Voltar às Minhas Disciplinas</a>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php include_once __DIR__ . '/../partials/footer.php'; ?>
