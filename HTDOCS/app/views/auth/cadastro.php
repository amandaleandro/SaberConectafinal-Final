<div class="login-page">
  <div class="login-card">
    <h2 class="text-center">Criar Conta</h2>

    <?php if (!empty($erro)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= htmlspecialchars($erro) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="?route=auth/cadastro">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required>
        <label for="nome">Nome</label>
      </div>

      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" required>
        <label for="email">E-mail</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha" required minlength="8">
        <label for="senha">Senha</label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" id="tipo" name="tipo" required>
          <option value="" disabled selected>Selecione...</option>
          <option value="aluno">Aluno</option>
          <option value="professor">Professor</option>
        </select>
        <label for="tipo">Tipo de Usuário</label>
      </div>

      <div class="form-floating mb-3 d-none" id="nivelEscolarGroup">
        <select class="form-select" id="nivel_escolar" name="nivel_escolar">
          <option value="">Selecione...</option>
          <option value="fundamental">Fundamental</option>
          <option value="medio">Médio</option>
          <option value="superior">Superior</option>
        </select>
        <label for="nivel_escolar">Nível Escolar</label>
      </div>

      <button type="submit" class="btn-form">Cadastrar</button>
      <p class="text-center mt-3">Já tem conta? <a href="?route=auth/login">Faça login</a></p>
    </form>
  </div>
</div>

<script>
  // Mostrar campo de nível escolar só se for aluno
  document.getElementById('tipo').addEventListener('change', function() {
    const nivelGroup = document.getElementById('nivelEscolarGroup');
    if (this.value === 'aluno') {
      nivelGroup.classList.remove('d-none');
    } else {
      nivelGroup.classList.add('d-none');
    }
  });
</script>
