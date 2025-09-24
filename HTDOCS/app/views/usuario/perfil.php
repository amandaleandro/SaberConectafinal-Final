<?php include_once 'app/views/partials/header.php'; ?>

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
                      <option value="Medio" <?= ($usuario['nivel_escolar'] ?? '') === 'Medio' ? 'selected' : '' ?>>Medio</option>
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
          <div class="alert alert-info mb-3">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Dica de Segurança:</strong> Use uma senha forte com pelo menos 8 caracteres, 
            incluindo letras maiúsculas, minúsculas, números e símbolos.
          </div>
          
          <form method="POST" action="?route=usuario/alterarSenha" id="formSenha">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="senha_atual" class="form-label fw-semibold">
                  <i class="bi bi-lock me-1"></i>Senha Atual *
                </label>
                <div class="input-group">
                  <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('senha_atual')">
                    <i class="bi bi-eye" id="icon_senha_atual"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="nova_senha" class="form-label fw-semibold">
                  <i class="bi bi-key me-1"></i>Nova Senha *
                </label>
                <div class="input-group">
                  <input type="password" class="form-control" id="nova_senha" name="nova_senha" 
                         minlength="8" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$">
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('nova_senha')">
                    <i class="bi bi-eye" id="icon_nova_senha"></i>
                  </button>
                </div>
                <div class="form-text">
                  Mín. 8 caracteres com maiúscula, minúscula e número
                </div>
                <div class="progress mt-2" style="height: 3px;">
                  <div class="progress-bar" id="senha_strength" style="width: 0%"></div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="confirmar_senha" class="form-label fw-semibold">
                  <i class="bi bi-check-circle me-1"></i>Confirmar Nova Senha *
                </label>
                <div class="input-group">
                  <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" 
                         minlength="8" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirmar_senha')">
                    <i class="bi bi-eye" id="icon_confirmar_senha"></i>
                  </button>
                </div>
                <div class="invalid-feedback" id="senha_match_feedback">
                  As senhas não coincidem
                </div>
              </div>
            </div>
            
            <div class="d-grid">
              <button type="submit" class="btn btn-warning btn-lg" id="btn_alterar_senha" disabled>
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
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalExcluir">
                <i class="bi bi-trash icon"></i> Excluir Conta
              </button>
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

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h4 class="text-primary mb-0"><?= (int)($estatisticas['acessos'] ?? 0) ?></h4>
      <small class="text-muted">Materiais Acessados</small>
    </div>
    <i class="bi bi-book-half fs-2 text-primary opacity-50"></i>
     </div>
     <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
         <h4 class="text-success mb-0">
        <?php
          echo isset($estatisticas['tempo_estudo']) ? $estatisticas['tempo_estudo'] : '—';
        ?>
        </h4>
         <small class="text-muted">Tempo de Estudo</small>
        </div>
    <i class="bi bi-clock-history fs-2 text-success opacity-50"></i>
    </div>
    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
      <h4 class="text-info mb-0"><?= (int)($estatisticas['disciplinas'] ?? 0) ?></h4>
      <small class="text-muted">Disciplinas Seguindo</small>
        </div>
        <i class="bi bi-journal-bookmark fs-2 text-info opacity-50"></i>
    </div>
    <hr>

    <div class="d-flex justify-content-between align-items-center">
        <div>
      <h4 class="text-warning mb-0"><?= (int)($estatisticas['favoritos'] ?? 0) ?></h4>
      <small class="text-muted">Materiais Favoritos</small>
        </div>
     <i class="bi bi-heart-fill fs-2 text-warning opacity-50"></i>
    </div>

    <?php else: // professor ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
      <h4 class="text-primary mb-0"><?= (int)($estatisticas['publicados'] ?? 0) ?></h4>
        <small class="text-muted">Materiais Publicados</small>
        </div>
        <i class="bi bi-file-earmark-text fs-2 text-primary opacity-50"></i>
    </div>
    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
    <   div>
        <h4 class="text-success mb-0"><?= (int)($estatisticas['alunos'] ?? 0) ?></h4>
        <small class="text-muted">Alunos Conectados</small>
        </div>
        <i class="bi bi-people fs-2 text-success opacity-50"></i>
    </div>
    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
      <h4 class="text-info mb-0"><?= (int)($estatisticas['visualizacoes'] ?? 0) ?></h4>
      <small class="text-muted">Total de Visualizações</small>
        </div>
    <i class="bi bi-eye fs-2 text-info opacity-50"></i>
    </div>
    <hr>

    <div class="d-flex justify-content-between align-items-center">
    <div>
      <h4 class="text-warning mb-0">
        <?= isset($estatisticas['avaliacao']) ? number_format($estatisticas['avaliacao'], 1, ',', '.') : '—' ?>
      </h4>
      <small class="text-muted">Avaliação Média</small>
    </div>
    <i class="bi bi-star-fill fs-2 text-warning opacity-50"></i>
    </div>

    <?php endif; ?>

      </div>
    </div>
      <!-- Ações Rápidas -->
      <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
          <h6 class="mb-0">
            <i class="bi bi-lightning me-2"></i>Ações Rápidas
          </h6>
        </div>
        <div class="card-body">
          <?php if ($_SESSION['usuario_tipo'] === 'aluno'): ?>
            <div class="d-grid gap-2">
              <a href="?route=aluno/dashboard" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-speedometer2 me-1"></i>Meu Dashboard
              </a>
              <a href="?route=aluno/minhasMaterias" class="btn btn-outline-success btn-sm">
                <i class="bi bi-journal-bookmark me-1"></i>Minhas Matérias
              </a>
              <a href="?route=aluno/Conteudos_favoritos" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-heart me-1"></i>Favoritos
              </a>
              <a href="?route=aluno/todasMaterias" class="btn btn-outline-info btn-sm">
                <i class="bi bi-search me-1"></i>Explorar Conteúdos
              </a>
            </div>
          <?php else: ?>
            <div class="d-grid gap-2">
              <a href="?route=professor/dashboard" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-speedometer2 me-1"></i>Meu Dashboard
              </a>
              <a href="?route=materia/minhas" class="btn btn-outline-success btn-sm">
                <i class="bi bi-journal-text me-1"></i>Minhas Matérias
              </a>
              <a href="?route=conteudo/meusProfessor" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-file-earmark-plus me-1"></i>Meus Conteúdos
              </a>
              <a href="?route=professor/gerenciarAlunos" class="btn btn-outline-info btn-sm">
                <i class="bi bi-people me-1"></i>Gerenciar Alunos
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Excluir -->
<div class="modal fade" id="modalExcluir" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmar Exclusão</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="mb-3">Ao excluir sua conta, você perderá permanentemente:</p>
        <ul class="mb-4">
          <?php if ($_SESSION['usuario_tipo'] === 'aluno'): ?>
            <li>✗ Todo o progresso de estudos</li>
            <li>✗ Lista de disciplinas selecionadas</li>
            <li>✗ Histórico de materiais acessados</li>
            <li>✗ Dados pessoais e preferências</li>
          <?php else: ?>
            <li>✗ Todos os materiais publicados</li>
            <li>✗ Estatísticas de visualizações</li>
            <li>✗ Lista de alunos associados</li>
            <li>✗ Dados pessoais e preferências</li>
          <?php endif; ?>
        </ul>
        <div class="bg-light p-3 rounded mb-3">
          <label class="form-label"><strong>Digite "EXCLUIR" para confirmar:</strong></label>
          <input type="text" class="form-control" id="confirmacaoTexto" placeholder="Digite EXCLUIR para confirmar">
        </div>
        <div class="form-floating mt-3">
          <input type="password" class="form-control" id="senhaConfirmacao" placeholder="Senha">
          <label for="senhaConfirmacao">Digite sua senha para confirmar</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-x-circle icon"></i> Cancelar
        </button>
        <form method="POST" action="?route=usuario/excluirConta" class="d-inline">
          <button type="submit" class="btn btn-secondary" id="btnConfirmarExclusao" disabled>
            <i class="bi bi-trash icon"></i> Excluir Conta
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// ===========================
// VALIDAÇÃO DE FORMULÁRIOS
// ===========================

// Toggle de visibilidade da senha
function togglePassword(fieldId) {
  const field = document.getElementById(fieldId);
  const icon = document.getElementById('icon_' + fieldId);
  
  if (field.type === 'password') {
    field.type = 'text';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  } else {
    field.type = 'password';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  }
}

// Verificar força da senha
function checkPasswordStrength(password) {
  let strength = 0;
  if (password.length >= 8) strength += 25;
  if (/[A-Z]/.test(password)) strength += 25;
  if (/[a-z]/.test(password)) strength += 25;
  if (/[0-9]/.test(password)) strength += 25;
  
  return strength;
}

// Validação em tempo real da senha
document.getElementById('nova_senha').addEventListener('input', function() {
  const senha = this.value;
  const strengthBar = document.getElementById('senha_strength');
  const strength = checkPasswordStrength(senha);
  
  strengthBar.style.width = strength + '%';
  
  if (strength < 50) {
    strengthBar.className = 'progress-bar bg-danger';
  } else if (strength < 75) {
    strengthBar.className = 'progress-bar bg-warning';
  } else {
    strengthBar.className = 'progress-bar bg-success';
  }
  
  validatePasswordForm();
});

// Validação de confirmação de senha
document.getElementById('confirmar_senha').addEventListener('input', validatePasswordForm);

function validatePasswordForm() {
  const nova = document.getElementById('nova_senha').value;
  const conf = document.getElementById('confirmar_senha').value;
  const btn = document.getElementById('btn_alterar_senha');
  const feedback = document.getElementById('senha_match_feedback');
  const confField = document.getElementById('confirmar_senha');
  
  if (nova.length >= 8 && conf.length >= 8) {
    if (nova === conf) {
      btn.disabled = false;
      confField.classList.remove('is-invalid');
      confField.classList.add('is-valid');
      feedback.style.display = 'none';
    } else {
      btn.disabled = true;
      confField.classList.remove('is-valid');
      confField.classList.add('is-invalid');
      feedback.style.display = 'block';
    }
  } else {
    btn.disabled = true;
    confField.classList.remove('is-valid', 'is-invalid');
    feedback.style.display = 'none';
  }
}

// Validação final do formulário de senha
document.getElementById('formSenha').addEventListener('submit', function(e) {
  const nova = document.getElementById('nova_senha').value;
  const conf = document.getElementById('confirmar_senha').value;
  
  if (nova !== conf) {
    e.preventDefault();
    alert('As senhas não coincidem!');
    return false;
  }
  
  if (checkPasswordStrength(nova) < 75) {
    if (!confirm('Sua senha pode ser mais forte. Deseja continuar mesmo assim?')) {
      e.preventDefault();
      return false;
    }
  }
});

// Validação do formulário de dados pessoais
document.getElementById('formDados').addEventListener('submit', function(e) {
  const nome = document.getElementById('nome').value.trim();
  const email = document.getElementById('email').value.trim();
  
  if (nome.length < 3) {
    e.preventDefault();
    alert('O nome deve ter pelo menos 3 caracteres.');
    return false;
  }
  
  if (!email.includes('@')) {
    e.preventDefault();
    alert('Por favor, insira um email válido.');
    return false;
  }
});

// Validação do modal de exclusão
document.getElementById('confirmacaoTexto').addEventListener('input', function() {
  const btn = document.getElementById('btnConfirmarExclusao');
  if (this.value.toUpperCase() === 'EXCLUIR') {
    btn.disabled = false; 
    btn.classList.replace('btn-secondary','btn-danger');
  } else {
    btn.disabled = true; 
    btn.classList.replace('btn-danger','btn-secondary');
  }
});

// Auto-save indication (opcional)
let autoSaveTimer;
['nome', 'email', 'nivel_escolar', 'especializacao', 'instituicao', 'bio'].forEach(fieldId => {
  const field = document.getElementById(fieldId);
  if (field) {
    field.addEventListener('input', function() {
      clearTimeout(autoSaveTimer);
      // Opcional: mostrar indicador de alterações não salvas
    });
  }
});

// Mensagens de feedback automático
setTimeout(function() {
  const alerts = document.querySelectorAll('.alert[data-bs-dismiss="alert"]');
  alerts.forEach(alert => {
    if (!alert.querySelector('.btn-close')) {
      setTimeout(() => alert.remove(), 5000);
    }
  });
}, 100);
</script>

