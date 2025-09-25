

<div class="container my-4">
  <!-- Cabeçalho do perfil -->
  <div class="row">
    <div class="col-12">
      <div class="card bg-gradient mb-4" 
           style="background: linear-gradient(135deg, <?= $_SESSION['usuario_tipo'] === 'aluno' ? '#007bff, #6f42c1' : '#28a745, #17a2b8' ?>);">
        <div class="card-body text-center py-5">
          <div class="avatar-circle mx-auto mb-3" 
               style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-<?= $_SESSION['usuario_tipo'] === 'aluno' ? 'mortarboard-fill' : 'person-workspace' ?> fs-1"></i>
          </div>
          <h2 class="text-black"><?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário') ?></h2>
          <p class="mb-2">
            <span class="badge bg-light text-dark fs-6 px-3 py-2">
              <i class="bi bi-<?= $_SESSION['usuario_tipo'] === 'aluno' ? 'mortarboard' : 'easel' ?> me-1"></i>
              <?= $_SESSION['usuario_tipo'] === 'aluno' ? 'Aluno' : 'Professor' ?>
            </span>
          </p>
          <?php if (!empty($usuario['nivel_escolar']) && $_SESSION['usuario_tipo'] === 'aluno'): ?>
            <p class="mb-1">
              <small class="badge bg-light text-dark opacity-75">
                <i class="bi bi-bookmark me-1"></i><?= htmlspecialchars($usuario['nivel_escolar']) ?>
              </small>
            </p>
          <?php endif; ?>
          <small class="text-black opacity-75">
            <i class="bi bi-calendar3 me-1"></i>Membro desde <?= isset($usuario['created_at']) ? date('d/m/Y', strtotime($usuario['created_at'])) : date('d/m/Y') ?>
          </small>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Formulário de edição -->
    <div class="col-md-8">
      <!-- Mensagens de Feedback -->
      <?php if (!empty($mensagem)): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
          <i class="bi bi-check-circle me-2"></i><?= $mensagem ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['mensagem']); ?>
      <?php endif; ?>
      
      <?php if (!empty($erro)): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4">
          <i class="bi bi-exclamation-triangle me-2"></i><?= $erro ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['erro']); ?>
      <?php endif; ?>

      <!-- Dados Pessoais -->
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">
            <i class="bi bi-person-gear me-2"></i>Informações Pessoais
          </h5>
        </div>
        <div class="card-body">
          <form method="POST" action="?route=usuario/atualizarPerfil" id="formDados">
            <div class="row">
              <!-- Nome -->
              <div class="col-md-6 mb-3">
                <label for="nome" class="form-label fw-semibold">
                  <i class="bi bi-person me-1"></i>Nome Completo *
                </label>
                <input type="text" class="form-control" id="nome" name="nome" 
                       value="<?= htmlspecialchars($usuario['nome'] ?? $_SESSION['usuario_nome']) ?>" 
                       required minlength="3" maxlength="100">
                <div class="form-text">Seu nome completo como deseja ser chamado</div>
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-semibold">
                  <i class="bi bi-envelope me-1"></i>Email *
                </label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" 
                       required maxlength="150">
                <div class="form-text">Usado para login e comunicações</div>
              </div>
            </div>

            <div class="row">
              <!-- Tipo de usuário (somente leitura) -->
              <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label fw-semibold">
                  <i class="bi bi-shield-check me-1"></i>Tipo de Conta
                </label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="bi bi-<?= $_SESSION['usuario_tipo'] === 'aluno' ? 'mortarboard' : 'easel' ?>"></i>
                  </span>
                  <input type="text" class="form-control bg-light" id="tipo" 
                         value="<?= $_SESSION['usuario_tipo'] === 'aluno' ? 'Aluno' : 'Professor' ?>" readonly>
                </div>
              </div>

              <!-- Campos específicos por tipo de usuário -->
              <?php if ($_SESSION['usuario_tipo'] === 'aluno'): ?>
                <!-- Nível escolar (apenas para alunos) -->
                <div class="col-md-6 mb-3">
                  <label for="nivel_escolar" class="form-label fw-semibold">
                    <i class="bi bi-bookmark me-1"></i>Nível de Ensino
                  </label>
                  <select class="form-select" id="nivel_escolar" name="nivel_escolar">
                    <option value="">Selecione seu nível...</option>
                      <option value="Fundamental" <?= ($usuario['nivel_escolar'] ?? '') === 'Fundamental' ? 'selected' : '' ?>>Fundamental</option>
                      <option value="Medio" <?= ($usuario['nivel_escolar'] ?? '') === 'Medio' ? 'selected' : '' ?>>Médio</option>
                      <option value="Superior" <?= ($usuario['nivel_escolar'] ?? '') === 'Superior' ? 'selected' : '' ?>>Superior</option>
                  </select>
                  <div class="form-text">Ajuda a personalizar conteúdos para você</div>
                </div>
              <?php else: ?>
                <!-- Especialização (para professores) -->
                <div class="col-md-6 mb-3">
                  <label for="especializacao" class="form-label fw-semibold">
                    <i class="bi bi-star me-1"></i>Área de Especialização
                  </label>
                  <input type="text" class="form-control" id="especializacao" name="especializacao" 
                         value="<?= htmlspecialchars($usuario['especializacao'] ?? '') ?>" 
                         placeholder="Ex: Matemática, História, Biologia..."
                         maxlength="100">
                  <div class="form-text">Sua principal área de ensino</div>
                </div>
              <?php endif; ?>
            </div>

            <?php if ($_SESSION['usuario_tipo'] === 'professor'): ?>
            <!-- Campos adicionais para professores -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="instituicao" class="form-label fw-semibold">
                  <i class="bi bi-building me-1"></i>Instituição
                </label>
                <input type="text" class="form-control" id="instituicao" name="instituicao" 
                       value="<?= htmlspecialchars($usuario['instituicao'] ?? '') ?>" 
                       placeholder="Escola, universidade ou instituição..."
                       maxlength="150">
                <div class="form-text">Onde você leciona (opcional)</div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="bio" class="form-label fw-semibold">
                  <i class="bi bi-chat-quote me-1"></i>Biografia Breve
                </label>
                <textarea class="form-control" id="bio" name="bio" rows="3" 
                          placeholder="Conte um pouco sobre sua experiência..."
                          maxlength="300"><?= htmlspecialchars($usuario['bio'] ?? '') ?></textarea>
                <div class="form-text">Visível para alunos (máx. 300 caracteres)</div>
              </div>
            </div>
            <?php endif; ?>

            <!-- Botão de atualizar -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Salvar Alterações
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Alterar Senha -->
      <div class="card shadow mb-4">
        <div class="card-header bg-warning text-dark">
          <h5 class="mb-0">
            <i class="bi bi-shield-lock me-2"></i>Segurança da Conta
          </h5>
        </div>
        <div class="card-body">
          <form method="POST" action="?route=usuario/alterarSenha" id="formSenha">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="senha_atual" class="form-label fw-semibold">
                  <i class="bi bi-lock me-1"></i>Senha Atual *
                </label>
                <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="nova_senha" class="form-label fw-semibold">
                  <i class="bi bi-key me-1"></i>Nova Senha *
                </label>
                <input type="password" class="form-control" id="nova_senha" name="nova_senha" minlength="8" required>
              </div>
              <div class="col-md-4 mb-3">
                <label for="confirmar_senha" class="form-label fw-semibold">
                  <i class="bi bi-check-circle me-1"></i>Confirmar Nova Senha *
                </label>
                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" minlength="8" required>
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-warning btn-lg">
                <i class="bi bi-shield-check me-2"></i>Alterar Senha
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Zona de Perigo -->
      <div class="card shadow border-danger">
        <div class="card-header bg-danger text-white">
          <h5><i class="bi bi-exclamation-triangle icon"></i> Zona de Perigo</h5>
        </div>
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h6 class="text-danger">Excluir Conta</h6>
              <p class="text-muted mb-0">Esta ação é irreversível. Todos os seus dados serão removidos.</p>
            </div>
            <div class="col-md-4 text-end">
              <form method="POST" action="?route=usuario/excluirConta">
                <button type="submit" class="btn btn-outline-danger">
                  <i class="bi bi-trash icon"></i> Excluir Conta
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar (estatísticas e ações) -->
    <div class="col-md-4">
      <!-- Estatísticas -->
      <div class="card shadow mb-4">
        <div class="card-header bg-<?= $_SESSION['usuario_tipo'] === 'aluno' ? 'info' : 'success' ?> text-white">
          <h6 class="mb-0">
            <i class="bi bi-graph-up me-2"></i>Suas Estatísticas
          </h6>
        </div>
        <div class="card-body">
          <?php if (($_SESSION['usuario_tipo'] ?? '') === 'aluno'): ?>
            <div class="mb-3">
              <h4 class="text-primary"><?= (int)($estatisticas['materiaisAcessados'] ?? 0) ?></h4>
              <small class="text-muted">Materiais Acessados</small>
            </div>
            <div class="mb-3">
              <h4 class="text-info"><?= (int)($estatisticas['disciplinas'] ?? 0) ?></h4>
              <small class="text-muted">Disciplinas Seguindo</small>
            </div>
            <div>
              <h4 class="text-warning"><?= (int)($estatisticas['favoritos'] ?? 0) ?></h4>
              <small class="text-muted">Materiais Favoritos</small>
            </div>
          <?php else: ?>
            <div class="mb-3">
              <h4 class="text-primary"><?= (int)($estatisticas['materiaisPublicados'] ?? 0) ?></h4>
              <small class="text-muted">Materiais Publicados</small>
            </div>
            <div class="mb-3">
              <h4 class="text-success"><?= (int)($estatisticas['alunosConectados'] ?? 0) ?></h4>
              <small class="text-muted">Alunos Conectados</small>
            </div>
            <div>
              <h4 class="text-info"><?= (int)($estatisticas['visualizacoes'] ?? 0) ?></h4>
              <small class="text-muted">Total de Visualizações</small>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
