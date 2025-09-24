<div class="container my-5">
  <!-- Saudação -->
  <div class="text-center mb-5">
    <h1 class="fw-bold text-danger">
      👋 Bem-vindo, Professor <?= htmlspecialchars($_SESSION['usuario_nome'] ?? ''); ?>
    </h1>
    <p class="lead text-muted">Aqui está o resumo da sua atividade no Saber Conecta.</p>
  </div>

  <!-- Estatísticas -->
  <div class="row g-4 mb-5">
    <div class="col-md-3">
      <div class="card shadow-lg border-0 bg-light h-100">
        <div class="card-body text-center">
          <i class="bi bi-book fs-1 text-danger"></i>
          <h6 class="mt-3 text-muted">Matérias</h6>
          <h2 class="fw-bold"><?= $totalMaterias ?? 0; ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-lg border-0 bg-light h-100">
        <div class="card-body text-center">
          <i class="bi bi-journal-text fs-1 text-primary"></i>
          <h6 class="mt-3 text-muted">Conteúdos</h6>
          <h2 class="fw-bold"><?= $totalConteudos ?? 0; ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-lg border-0 bg-light h-100">
        <div class="card-body text-center">
          <i class="bi bi-people fs-1 text-success"></i>
          <h6 class="mt-3 text-muted">Alunos</h6>
          <h2 class="fw-bold"><?= $totalAlunos ?? 0; ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-lg border-0 bg-light h-100">
        <div class="card-body text-center">
          <i class="bi bi-graph-up fs-1 text-warning"></i>
          <h6 class="mt-3 text-muted">Acessos</h6>
          <h2 class="fw-bold"><?= $totalAcessos ?? 0; ?></h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráfico -->
  <div class="card shadow-lg border-0 mb-5">
    <div class="card-body">
      <h4 class="fw-bold mb-4 text-center">📊 Distribuição de Conteúdos por Tipo</h4>
      <canvas id="conteudosChart" height="120"></canvas>
    </div>
  </div>
  <!-- Ações rápidas -->
  <div class="text-center">
    <h3 class="fw-bold mb-4">⚡ Ações Rápidas</h3>
    <div class="row g-3">
      <div class="col-md-4">
        <a href="?route=materia/form" class="btn btn-danger w-100 py-3 shadow">
          ➕ Criar Nova Matéria
        </a>
      </div>
      <div class="col-md-4">
        <a href="?route=conteudo/form" class="btn btn-primary w-100 py-3 shadow">
          📄 Criar Novo Conteúdo
        </a>
      </div>
      <div class="col-md-4">
        <a href="?route=professor/gerenciarAlunos" class="btn btn-success w-100 py-3 shadow">
          👨‍🎓 Gerenciar Alunos
        </a>
      </div>
      <div class="col-md-6">
        <a href="?route=materia/minhas" class="btn btn-outline-dark w-100 py-3 shadow">
          📋 Listar Minhas Matérias
        </a>
      </div>
      <div class="col-md-6">
        <a href="/?route=conteudo/meusProfessor" class="btn btn-outline-dark w-100 py-3 shadow">
          📋 Listar Meus Conteúdos
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Script do Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('conteudosChart').getContext('2d');
  const conteudosChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['PDFs', 'Vídeos', 'Exercícios', 'Outros'],
      datasets: [{
        label: 'Conteúdos',
        data: [
          <?= $conteudosTipos['pdf'] ?? 0 ?>,
          <?= $conteudosTipos['video'] ?? 0 ?>,
          <?= $conteudosTipos['exercicio'] ?? 0 ?>,
          <?= $conteudosTipos['outros'] ?? 0 ?>
        ],
        backgroundColor: ['#dc3545', '#0d6efd', '#198754', '#ffc107']
      }]
    }
  });
</script>
<style>
  /* Reduzindo o tamanho do gráfico */
  #conteudosChart {
    max-width: 500px;   /* largura máxima */
    max-height: 300px;  /* altura máxima */
    margin: 0 auto;     /* centralizar */
    display: block;
  }
</style>
