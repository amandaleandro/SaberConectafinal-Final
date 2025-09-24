<?php
// app/views/material/form.php

// Garantias mínimas p/ evitar notices na view
$material   = $material   ?? [];
$materias   = $materias   ?? [];
$erro       = $erro       ?? null;
$sucesso    = $sucesso    ?? null;
$isEdit     = isset($material['id']);
$csrfToken  = function_exists('generateCSRFToken') ? generateCSRFToken() : '';
?>
<div class="container mt-4">
  <div class="col-lg-10 mx-auto">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="mb-0">
        <?= $isEdit ? 'Editar Material' : 'Cadastrar Novo Material' ?>
      </h2>
      <div class="text-muted small">
        Campos com * são obrigatórios
      </div>
    </div>

    <?php if (!empty($erro)): ?>
      <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($erro) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
      <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($sucesso) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <form method="post"
          enctype="multipart/form-data"
          action="?route=material/salvar<?= $isEdit ? '&id=' . (int)$material['id'] : '' ?>"
          id="materialForm"
          novalidate>

      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">

      <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$material['id'] ?>">
      <?php endif; ?>

      <!-- Linha 1: Título + Matéria -->
      <div class="row g-3">
        <div class="col-md-8">
          <label for="titulo" class="form-label">Título *</label>
          <input type="text"
                 class="form-control"
                 id="titulo"
                 name="titulo"
                 maxlength="150"
                 value="<?= htmlspecialchars($material['titulo'] ?? '') ?>"
                 required>
          <div class="form-text">Máx. 150 caracteres</div>
        </div>

        <div class="col-md-4">
          <label for="materia_id" class="form-label">Matéria *</label>
          <select class="form-select" id="materia_id" name="materia_id" required>
            <option value="">Selecione</option>
            <?php foreach ($materias as $m): ?>
              <option value="<?= (int)$m['id'] ?>"
                <?= isset($material['materia_id']) && (int)$material['materia_id'] === (int)$m['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <!-- Descrição -->
      <div class="mt-3">
        <label for="descricao" class="form-label">Descrição *</label>
        <textarea class="form-control"
                  id="descricao"
                  name="descricao"
                  rows="4"
                  maxlength="1000"
                  required><?= htmlspecialchars($material['descricao'] ?? '') ?></textarea>
        <div class="form-text">Conte o que o aluno vai encontrar aqui (máx. 1000 caracteres).</div>
      </div>

      <!-- Linha 2: Tipo + Nível + Duração + Ordem -->
      <div class="row g-3 mt-1">
        <div class="col-md-3">
          <label for="tipo" class="form-label">Tipo *</label>
          <select class="form-select" id="tipo" name="tipo" required>
            <?php
              $tipoAtual = $material['tipo'] ?? 'pdf';
              $tipos = ['pdf' => 'PDF', 'video' => 'Vídeo', 'link' => 'Link', 'outro' => 'Outro'];
              foreach ($tipos as $v => $lbl):
            ?>
              <option value="<?= $v ?>" <?= $tipoAtual === $v ? 'selected' : '' ?>><?= $lbl ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-3">
          <label for="nivel" class="form-label">Nível de Dificuldade *</label>
          <select class="form-select" id="nivel" name="nivel" required>
            <?php
              $nivelAtual = $material['nivel_dificuldade'] ?? 'facil';
              $niveis = ['facil' => 'Fácil', 'medio' => 'Médio', 'dificil' => 'Difícil'];
              foreach ($niveis as $v => $lbl):
            ?>
              <option value="<?= $v ?>" <?= $nivelAtual === $v ? 'selected' : '' ?>><?= $lbl ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-3">
          <label for="duracao" class="form-label">Duração (min)</label>
          <input type="number"
                 class="form-control"
                 id="duracao"
                 name="duracao"
                 min="1" max="600"
                 value="<?= htmlspecialchars($material['duracao'] ?? '') ?>">
          <div class="form-text">Tempo estimado de consumo.</div>
        </div>

        <div class="col-md-3">
          <label for="ordem" class="form-label">Ordem</label>
          <input type="number"
                 class="form-control"
                 id="ordem"
                 name="ordem"
                 min="1" max="999"
                 value="<?= htmlspecialchars($material['ordem'] ?? '') ?>">
          <div class="form-text">Posição na listagem da matéria.</div>
        </div>
      </div>

      <!-- Linha 3: Visibilidade + Status -->
      <div class="row g-3 mt-1">
        <div class="col-md-6">
          <label class="form-label d-block">Visibilidade *</label>
          <?php $vis = $material['visibilidade'] ?? 'restrito'; ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="radio"
                   name="visibilidade"
                   id="vis_restrito"
                   value="restrito"
                   <?= $vis === 'restrito' ? 'checked' : '' ?>
                   required>
            <label class="form-check-label" for="vis_restrito">Somente alunos da matéria</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="radio"
                   name="visibilidade"
                   id="vis_publico"
                   value="publico"
                   <?= $vis === 'publico' ? 'checked' : '' ?>>
            <label class="form-check-label" for="vis_publico">Todos os alunos</label>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label d-block">Status *</label>
          <?php $status = $material['status'] ?? 'rascunho'; ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="radio"
                   name="status"
                   id="st_rascunho"
                   value="rascunho"
                   <?= $status === 'rascunho' ? 'checked' : '' ?>
                   required>
            <label class="form-check-label" for="st_rascunho">Rascunho</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="radio"
                   name="status"
                   id="st_publicado"
                   value="publicado"
                   <?= $status === 'publicado' ? 'checked' : '' ?>>
            <label class="form-check-label" for="st_publicado">Publicado</label>
          </div>
        </div>
      </div>

      <!-- Linha 4: Tags -->
      <div class="mt-3">
        <label for="tags" class="form-label">Palavras-chave</label>
        <input type="text"
               class="form-control"
               id="tags"
               name="tags"
               maxlength="200"
               value="<?= htmlspecialchars($material['tags'] ?? '') ?>"
               placeholder="Ex: frações, geometria, lógica">
        <div class="form-text">Separe por vírgulas. Ajuda nas buscas e recomendações.</div>
      </div>

      <!-- Linha 5: URL Externa (para vídeo/link) -->
      <div class="mt-3" id="grupoUrl" style="display:none;">
        <label for="link" class="form-label">Link Externo *</label>
        <input type="url"
               class="form-control"
               id="link"
               name="link"
               placeholder="https://..."
               value="<?= htmlspecialchars($material['url_externa'] ?? '') ?>">
        <div class="form-text">Para YouTube / sites / recursos externos.</div>
      </div>

      <!-- Linha 6: Upload de Arquivo (para PDF / Outro) -->
      <div class="mt-3" id="grupoArquivo" style="display:none;">
        <label for="arquivo" class="form-label">Arquivo *</label>
        <input type="file"
               class="form-control"
               id="arquivo"
               name="arquivo"
               accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">
        <?php if ($isEdit && !empty($material['caminho_arquivo'])): ?>
          <div class="form-text">
            Arquivo atual:
            <a href="<?= htmlspecialchars($material['caminho_arquivo']) ?>" target="_blank">baixar</a>.
            Envie um novo para substituir.
          </div>
        <?php else: ?>
          <div class="form-text">Formatos aceitos: pdf, doc, docx, ppt, pptx, jpg, jpeg, png (até 5MB).</div>
        <?php endif; ?>
      </div>

      <!-- Linha 7: Thumbnail (opcional) -->
      <div class="mt-3">
        <label for="thumb" class="form-label">Capa / Thumbnail (opcional)</label>
        <input type="file"
               class="form-control"
               id="thumb"
               name="thumb"
               accept=".jpg,.jpeg,.png">
        <?php if ($isEdit && !empty($material['thumb'])): ?>
          <div class="form-text">
            Capa atual:
            <a href="<?= htmlspecialchars($material['thumb']) ?>" target="_blank">ver atual</a>.
            Envie um novo arquivo para substituir.
          </div>
        <?php endif; ?>
      </div>

      <!-- Ações -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-save me-1"></i><?= $isEdit ? 'Atualizar' : 'Cadastrar' ?>
        </button>
        <a href="?route=material/meusProfessor" class="btn btn-secondary">
          <i class="bi bi-arrow-left me-1"></i>Cancelar
        </a>
      </div>
    </form>
  </div>
</div>

<script>
(function() {
  const tipoSel     = document.getElementById('tipo');
  const grupoUrl    = document.getElementById('grupoUrl');
  const grupoArq    = document.getElementById('grupoArquivo');
  const urlInput    = document.getElementById('link');
  const fileInput   = document.getElementById('arquivo');
  const form        = document.getElementById('materialForm');

  function toggleInputs() {
    const tipo = tipoSel.value;

    // Reset requireds
    if (urlInput)  urlInput.required  = false;
    if (fileInput) fileInput.required = false;

    if (tipo === 'video' || tipo === 'link') {
      // Mostrar URL, esconder arquivo
      if (grupoUrl) grupoUrl.style.display = '';
      if (grupoArq) grupoArq.style.display = 'none';
      if (urlInput) urlInput.required = true;
      if (fileInput) fileInput.value = '';
    } else {
      // Mostrar arquivo, esconder URL
      if (grupoUrl) grupoUrl.style.display = 'none';
      if (grupoArq) grupoArq.style.display = '';
      if (fileInput) fileInput.required = <?= $isEdit ? 'false' : 'true' ?>;
      if (urlInput) urlInput.value = '';
    }
  }

  // Validação extra no submit
  form.addEventListener('submit', function(e) {
    const tipo = tipoSel.value;
    if ((tipo === 'video' || tipo === 'link')) {
      if (!urlInput || !urlInput.value.trim()) {
        e.preventDefault();
        alert('Informe o link externo para o tipo selecionado.');
        urlInput && urlInput.focus();
      }
    } else {
      // pdf | outro
      <?php if (!$isEdit): ?>
      if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        e.preventDefault();
        alert('Envie um arquivo para o tipo selecionado.');
        fileInput && fileInput.focus();
      }
      <?php endif; ?>
    }
  });

  // Inicializa na carga
  toggleInputs();
  tipoSel.addEventListener('change', toggleInputs);
})();
</script>
