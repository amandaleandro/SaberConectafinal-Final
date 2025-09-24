<div class="container my-5">
  <div class="col-md-8 mx-auto">
    <div class="card shadow-lg border-0 p-4">
      <h2 class="text-center text-danger fw-bold mb-4">
        <?= isset($conteudo) && $conteudo ? "✏️ Editar Conteúdo" : "➕ Novo Conteúdo" ?>
      </h2>

      <form method="POST" action="?route=conteudo/salvar" enctype="multipart/form-data">
        <?php if (isset($conteudo['id'])): ?>
          <input type="hidden" name="id" value="<?= $conteudo['id'] ?>">
        <?php endif; ?>

        <!-- Título -->
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" 
                 value="<?= $conteudo['titulo'] ?? '' ?>" required>
          <label for="titulo">Título</label>
        </div>

        <!-- Descrição -->
        <div class="form-floating mb-3">
          <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" style="height: 100px;" required><?= $conteudo['descricao'] ?? '' ?></textarea>
          <label for="descricao">Descrição</label>
        </div>

        <!-- Tipo -->
        <div class="form-floating mb-3">
          <select class="form-select" id="tipo" name="tipo" required>
            <option value="pdf"   <?= (isset($conteudo['tipo']) && $conteudo['tipo'] === 'pdf') ? 'selected' : '' ?>>📄 PDF</option>
            <option value="video" <?= (isset($conteudo['tipo']) && $conteudo['tipo'] === 'video') ? 'selected' : '' ?>>🎥 Vídeo</option>
            <option value="link"  <?= (isset($conteudo['tipo']) && $conteudo['tipo'] === 'link') ? 'selected' : '' ?>>🔗 Link</option>
            <option value="outro" <?= (isset($conteudo['tipo']) && $conteudo['tipo'] === 'outro') ? 'selected' : '' ?>>📌 Outro</option>
          </select>
          <label for="tipo">Tipo de Conteúdo</label>
        </div>

        <!-- Nível -->
        <div class="form-floating mb-3">
          <select class="form-select" id="nivel_dificuldade" name="nivel_dificuldade" required>
            <option value="facil" <?= (isset($conteudo['nivel_dificuldade']) && $conteudo['nivel_dificuldade'] === 'facil') ? 'selected' : '' ?>>Fácil</option>
            <option value="medio" <?= (!isset($conteudo['nivel_dificuldade']) || $conteudo['nivel_dificuldade'] === 'medio') ? 'selected' : '' ?>>Médio</option>
            <option value="dificil" <?= (isset($conteudo['nivel_dificuldade']) && $conteudo['nivel_dificuldade'] === 'dificil') ? 'selected' : '' ?>>Difícil</option>
          </select>
          <label for="nivel_dificuldade">Nível de Dificuldade</label>
        </div>

        <!-- URL externa -->
        <div class="form-floating mb-3">
          <input type="url" class="form-control" id="url_externa" name="url_externa" placeholder="https://..." 
                 value="<?= $conteudo['url_externa'] ?? '' ?>">
          <label for="url_externa">URL Externa (opcional)</label>
        </div>

        <!-- Arquivo -->
        <div class="mb-3">
          <label class="form-label fw-bold">Arquivo (opcional)</label>
          <input type="file" class="form-control" name="caminho_arquivo">
          <?php if (!empty($conteudo['caminho_arquivo'])): ?>
            <p class="mt-2">
              Atual: <a href="<?= $conteudo['caminho_arquivo'] ?>" target="_blank" class="link-danger">📂 Ver arquivo</a>
            </p>
          <?php endif; ?>
        </div>

        <!-- Matéria -->
        <div class="form-floating mb-3">
          <select class="form-select" id="materia_id" name="materia_id" required>
            <option value="">Selecione a Matéria</option>
            <?php foreach ($materias as $m): ?>
              <option value="<?= $m['id'] ?>" 
                <?= (isset($conteudo['materia_id']) && $conteudo['materia_id'] == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <label for="materia_id">Matéria</label>
        </div>

        <!-- Botão -->
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-danger px-5 py-2 rounded-pill shadow">
            <?= isset($conteudo['id']) ? "💾 Salvar Alterações" : "🚀 Criar Conteúdo" ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
