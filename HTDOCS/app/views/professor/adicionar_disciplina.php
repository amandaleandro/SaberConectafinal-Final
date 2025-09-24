<?php include_once 'app/views/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Vincular Aluno a Matéria</h2>
    <p class="text-muted">Selecione o aluno e a matéria para criar o vínculo.</p>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" action="?route=professor/adicionarDisciplinaAluno">
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required>
                <option value="">Selecione um aluno</option>
                <?php foreach ($alunos as $a): ?>
                    <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="materia_id" class="form-label">Matéria</label>
            <select name="materia_id" id="materia_id" class="form-select" required>
                <option value="">Selecione uma matéria</option>
                <?php foreach ($materias as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Salvar
        </button>
        <a href="?route=professor/gerenciarAlunos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>


