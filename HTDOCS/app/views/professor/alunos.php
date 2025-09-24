<div class="container my-5">
  <h2 class="mb-4 text-danger fw-bold">Meus Alunos</h2>

  <?php if (!empty($_SESSION['mensagem'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <i class="bi bi-check-circle me-2"></i>
      <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (!empty($_SESSION['erro'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <i class="bi bi-exclamation-triangle me-2"></i>
      <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (empty($alunos)): ?>
    <div class="alert alert-info">
      <i class="bi bi-info-circle me-2"></i>
      Nenhum aluno vinculado às suas matérias ainda.
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Nível Escolar</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alunos as $aluno): ?>
            <tr>
              <td><?= htmlspecialchars($aluno['nome']) ?></td>
              <td><?= htmlspecialchars($aluno['email']) ?></td>
              <td><?= htmlspecialchars($aluno['nivel_escolar'] ?? '-') ?></td>
              <td class="text-center">
                <form method="POST" action="?route=professor/desvincularAluno" onsubmit="return confirm('Deseja realmente desvincular este aluno?')" style="display:inline;">
                  <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-x-circle"></i> Desvincular
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
