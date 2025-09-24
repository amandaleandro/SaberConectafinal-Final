<div class="container my-5">
    <h2 class="mb-4 text-danger">Conteúdos Disponíveis</h2>

    <?php if (!empty($conteudos)): ?>
        <div class="row g-4">
            <?php foreach ($conteudos as $c): ?>
                <div class="col-md-4">
                    <div class="card shadow h-100 p-3">
                        <h5><?= htmlspecialchars($c['titulo']) ?></h5>
                        <p><?= htmlspecialchars($c['descricao'] ?? 'Sem descrição.') ?></p>
                        <small class="text-muted"><?= htmlspecialchars($c['materia_nome'] ?? '') ?></small>
                        <div class="mt-auto">
                            <a href="?route=conteudo/visualizar&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger mt-2">Visualizar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Nenhum conteúdo disponível no momento.</div>
    <?php endif; ?>
</div>
