<?php
// Se o usuário já estiver logado → manda para o dashboard
if (isset($_SESSION['usuario_id'])) {
    $tipo = $_SESSION['usuario_tipo'] ?? 'aluno';
    header("Location: ?route=dashboard/$tipo");
    exit;
}

// Verificar mensagens da URL
$mensagem = $_GET['msg'] ?? null;
?>
<?php if ($mensagem === 'logout_success'): ?>
<div class="alert alert-success alert-dismissible fade show m-0" role="alert">
    <div class="container">
        <i class="bi bi-check-circle me-2"></i>
        <strong>Logout realizado com sucesso!</strong> Obrigado por usar o Saber Conecta.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php elseif ($mensagem === 'conta_excluida'): ?>
<div class="alert alert-info alert-dismissible fade show m-0" role="alert">
    <div class="container">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Conta excluída!</strong> Sua conta foi removida com sucesso.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>

<!-- HERO -->
<section class="hero-home d-flex align-items-center text-center text-white">
  <div class="container">
    <h1 class="display-3 fw-bold mb-3">Saber Conecta</h1>
    <p class="lead mb-4">
      Uma plataforma que une alunos e professores em uma rede de aprendizado colaborativo.
      Aqui o conhecimento não tem barreiras: é gratuito, acessível e construído em comunidade.
    </p>
    <a href="?route=auth/cadastro" class="btn btn-primary btn-lg">Quero Fazer Parte</a>
  </div>
</section>

<!-- CARDS -->
<section class="container my-5">
  <h2 class="text-center fw-bold mb-5">Faça Parte do Saber Conecta</h2>
  <div class="row g-4">

    <!-- Aluno -->
    <div class="col-md-6">
      <div class="card shadow card-hover border-0 text-center h-100">
        <div class="card-body p-4 d-flex flex-column">
          <i class="bi bi-mortarboard-fill fs-1 text-primary"></i>
          <h4 class="mt-3">Sou Aluno</h4>
          <p class="mb-3">
            Tenha acesso a resumos claros, exercícios resolvidos e materiais interativos para reforçar seus estudos.
          </p>
          <a href="?route=auth/cadastro" class="btn btn-primary btn-card mt-auto mx-auto">Quero Aprender</a>
        </div>
      </div>
    </div>

    <!-- Professor -->
    <div class="col-md-6">
      <div class="card shadow card-hover border-0 text-center h-100">
        <div class="card-body p-4 d-flex flex-column">
          <i class="bi bi-person-workspace fs-1 text-success"></i>
          <h4 class="mt-3">Sou Professor</h4>
          <p class="mb-3">
            Compartilhe suas apostilas, listas de exercícios e vídeos educativos em uma plataforma acessível a todos.
          </p>
          <a href="?route=auth/cadastro" class="btn btn-success btn-card mt-auto mx-auto">Quero Contribuir</a>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- BENEFÍCIOS -->
<section class="beneficios py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">Por que usar o Saber Conecta?</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <i class="bi bi-book fs-1 text-danger"></i>
        <h5 class="mt-2">Materiais Gratuitos</h5>
        <p>Acesso sem custo a conteúdos de qualidade.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-laptop fs-1 text-primary"></i>
        <h5 class="mt-2">Acesse de Qualquer Lugar</h5>
        <p>Plataforma 100% online e responsiva.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-people fs-1 text-success"></i>
        <h5 class="mt-2">Para Todos</h5>
        <p>Estudantes e professores conectados em rede colaborativa.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA FINAL -->
<section class="cta text-center text-white py-5">
  <div class="container">
    <h2 class="fw-bold mb-3">Junte-se a Nós</h2>
    <p class="lead mb-4">
      Se você acredita que educação transforma vidas, o Saber Conecta é o seu lugar.
      Entre agora mesmo e faça parte dessa comunidade que cresce a cada dia.
    </p>
    <a href="?route=auth/cadastro" class="btn btn-light btn-lg">Criar Conta Gratuita</a>
  </div>
</section>
