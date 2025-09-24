<div class="login-page">
  <div class="login-card">
    <h2 class="text-center">Acesse sua Conta</h2>

    <?php if (!empty($erro)): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-3">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= $erro ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php 
    $mensagem = $_GET['msg'] ?? null;
    if ($mensagem === 'cadastro_sucesso'): ?>
      <div class="alert alert-success alert-dismissible fade show mt-3">
        <i class="bi bi-check-circle me-2"></i>
        Cadastro realizado com sucesso! Agora você pode fazer login.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="?route=auth/login" class="mt-4">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
        <label>Email</label>
      </div>

      <div class="form-floating mb-4">
        <input type="password" class="form-control" name="senha" placeholder="Senha" required minlength="8">
        <label>Senha</label>
      </div>

      <button type="submit" class="btn-form">Entrar</button>

      <p class="text-center mt-3">
        Não tem conta? 
        <a href="?route=auth/cadastro" class="text-decoration-none fw-bold text-danger">Cadastre-se</a>
      </p>
    </form>
  </div>
</div>

