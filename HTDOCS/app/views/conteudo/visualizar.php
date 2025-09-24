
<div class="container my-5">
  <?php if (!empty($conteudo)): ?>
    <div class="card shadow-lg border-0">
      <div class="card-body">
        <h2 class="mb-3 text-primary">
          <i class="bi bi-file-earmark-text me-2"></i><?= htmlspecialchars($conteudo['titulo']) ?>
        </h2>

        <p class="text-muted">
          <?= nl2br(htmlspecialchars($conteudo['descricao'])) ?>
        </p>

        <hr>

        <?php if (!empty($conteudo['caminho_arquivo'])): ?>
          <div class="mb-4">
            <?php if (pathinfo($conteudo['caminho_arquivo'], PATHINFO_EXTENSION) === 'pdf'): ?>
              <iframe src="<?= $conteudo['caminho_arquivo'] ?>" width="100%" height="600px" style="border: none;"></iframe>
              <a href="<?= $conteudo['caminho_arquivo'] ?>" target="_blank" class="btn btn-outline-primary mt-3">
                <i class="bi bi-download me-2"></i>Baixar PDF
              </a>
            <?php else: ?>
              <a href="<?= $conteudo['caminho_arquivo'] ?>" target="_blank" class="btn btn-outline-secondary">
                <i class="bi bi-download me-2"></i>Baixar Arquivo
              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($conteudo['url_externa'])): ?>
          <div class="alert alert-info d-flex align-items-center">
            <i class="bi bi-box-arrow-up-right me-2"></i>
            <div>
              <strong>Link Externo:</strong> 
              <a href="<?= $conteudo['url_externa'] ?>" target="_blank"><?= $conteudo['url_externa'] ?></a>
            </div>
          </div>
        <?php endif; ?>

        <div class="mt-4">
          <a href="?route=aluno/meusProfessor" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left me-2"></i>Voltar
          </a>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">
      <i class="bi bi-exclamation-triangle me-2"></i> Conteúdo não encontrado.
    </div>
  <?php endif; ?>
</div>
