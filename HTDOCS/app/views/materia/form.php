<div class="container my-5">
  <div class="col-md-8 mx-auto">
    <div class="card shadow p-4">
      <h2 class="text-danger mb-4">
        <?= isset($materia) ? "Editar Matéria" : "Cadastrar Nova Matéria" ?>
      </h2>

      <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
      <?php endif; ?>

      <form method="POST" action="?route=materia/salvar">
        <input type="hidden" name="id" value="<?= $materia['id'] ?? '' ?>">

        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="nome" 
                 value="<?= htmlspecialchars($materia['nome'] ?? '') ?>" required>
          <label>Nome da Matéria</label>
        </div>

        <div class="form-floating mb-3">
          <textarea class="form-control" style="height:100px" name="descricao" required><?= htmlspecialchars($materia['descricao'] ?? '') ?></textarea>
          <label>Descrição</label>
        </div>

        <div class="form-floating mb-3">
          <select class="form-select" name="nivel_ensino" required>
            <option value="fundamental" <?= (isset($materia['nivel_ensino']) && $materia['nivel_ensino']=="fundamental") ? "selected" : "" ?>>Fundamental</option>
            <option value="medio" <?= (isset($materia['nivel_ensino']) && $materia['nivel_ensino']=="medio") ? "selected" : "" ?>>Médio</option>
            <option value="superior" <?= (isset($materia['nivel_ensino']) && $materia['nivel_ensino']=="superior") ? "selected" : "" ?>>Superior</option>
          </select>
          <label>Nível de Ensino</label>
        </div>

        <button type="submit" class="btn btn-danger w-100">
          <i class="bi bi-save"></i> Salvar
        </button>
      </form>
    </div>
  </div>
</div>
