<div class="container mt-4">
    <h2>➕ Cadastrar Nova Matéria</h2>
    <p class="text-muted">Preencha os campos abaixo para criar uma nova disciplina.</p>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="?route=professor/salvarMateria">
                <!-- Nome da matéria -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Matéria</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <!-- Descrição -->
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-between">
                    <a href="?route=professor/minhasMaterias" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
