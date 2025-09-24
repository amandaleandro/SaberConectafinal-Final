<div class="container my-5">
    <h2 class="mb-4 text-center text-danger fw-bold">📚 Meus Conteúdos</h2>

    <div class="text-end mb-3">
        <a href="?route=conteudo/form" class="btn btn-success">
            ➕ Novo Conteúdo
        </a>
    </div>

    <?php if (!empty($conteudos)): ?>
        <div class="row">
            <?php foreach ($conteudos as $c): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($c['titulo']) ?></h5>
                            <p class="card-text text-muted small">
                                <?= nl2br(htmlspecialchars($c['descricao'])) ?>
                            </p>
                            <p class="mb-1"><strong>Matéria:</strong> <?= htmlspecialchars($c['materia_nome']) ?></p>
                            <p class="mb-1"><strong>Tipo:</strong> <?= htmlspecialchars($c['tipo']) ?></p>
                            <p class="mb-3"><strong>Dificuldade:</strong> <?= htmlspecialchars($c['nivel_dificuldade']) ?></p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="?route=conteudo/visualizar&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    🔍 Visualizar
                                </a>
                                <a href="?route=conteudo/form&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-warning">
                                    ✏️ Editar
                                </a>
                                <a href="?route=conteudo/excluir&id=<?= $c['id'] ?>" 
                                   onclick="return confirm('Tem certeza que deseja excluir este conteúdo?')" 
                                   class="btn btn-sm btn-outline-danger">
                                    🗑 Excluir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Nenhum conteúdo cadastrado ainda.
        </div>
    <?php endif; ?>
</div>
