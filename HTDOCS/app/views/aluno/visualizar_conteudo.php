
<div class="container my-5">
  <h2 class="mb-4">📄 Detalhes do Conteúdo</h2>

  <?php if (empty($conteudo)): ?>
    <div class="alert alert-warning">Conteúdo não encontrado.</div>
  <?php else: ?>
    <div class="card shadow-sm">
      <div class="card-body text-dark">
        <h3 class="card-title"><?= htmlspecialchars($conteudo['titulo']) ?></h3>
        <p class="card-text"><?= htmlspecialchars($conteudo['descricao'] ?? 'Sem descrição') ?></p>

        <p><strong>Tipo:</strong> <?= htmlspecialchars($conteudo['tipo'] ?? '-') ?></p>
        <p><strong>Nível de Dificuldade:</strong> <?= htmlspecialchars($conteudo['nivel_dificuldade'] ?? '-') ?></p>

        <?php if (!empty($conteudo['url_externa'])): ?>
          <p><a href="<?= htmlspecialchars($conteudo['url_externa']) ?>" target="_blank" class="btn btn-primary">
            <i class="bi bi-box-arrow-up-right"></i> Acessar Link Externo
          </a></p>
        <?php endif; ?>

        <?php if (!empty($conteudo['caminho_arquivo'])): ?>
          <p><a href="<?= htmlspecialchars($conteudo['caminho_arquivo']) ?>" target="_blank" class="btn btn-success">
            <i class="bi bi-file-earmark-arrow-down"></i> Baixar Arquivo
          </a></p>
        <?php endif; ?>

        <a href="?route=aluno/meusConteudos" class="btn btn-secondary mt-3">
          <i class="bi bi-arrow-left"></i> Voltar aos Meus Conteúdos
        </a>
      </div>
    </div>
  <?php endif; ?>
</div>