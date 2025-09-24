<div class="container my-5">
  <div class="card shadow-lg p-4">
    <h2 class="mb-3 text-center text-danger"><?= htmlspecialchars($conteudo['titulo']) ?></h2>
    <p class="text-muted text-center mb-4">
      <strong>Matéria:</strong> <?= htmlspecialchars($conteudo['materia_nome']) ?> |
      <strong>Dificuldade:</strong> <?= ucfirst($conteudo['nivel_dificuldade']) ?>
    </p>

    <p class="lead"><?= nl2br(htmlspecialchars($conteudo['descricao'])) ?></p>

    <?php if (!empty($conteudo['url_externa'])): ?>
      <div class="text-center my-3">
        <a href="<?= htmlspecialchars($conteudo['url_externa']) ?>" 
           target="_blank" 
           class="btn btn-primary btn-lg">
           <i class="bi bi-box-arrow-up-right me-2"></i> Acessar Conteúdo Externo
        </a>
      </div>
    <?php endif; ?>

    <?php if (!empty($conteudo['caminho_arquivo'])): ?>
      <div class="text-center my-3">
        <a href="<?= htmlspecialchars($conteudo['caminho_arquivo']) ?>" 
           target="_blank" 
           class="btn btn-success btn-lg">
           <i class="bi bi-file-earmark-arrow-down me-2"></i> Baixar Arquivo
        </a>
      </div>
    <?php endif; ?>

    <div class="mt-4 text-center">
      <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
      </a>
    </div>
  </div>
</div>
