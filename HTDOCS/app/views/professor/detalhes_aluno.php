<?php include_once 'app/views/partials/header.php'; ?>

<!-- 
====================================================
TELA: DETALHES DO ALUNO (PROFESSOR)
====================================================
Funcionalidades:
- Visualizar informações completas do aluno
- Ver disciplinas e progresso em cada uma
- Acompanhar atividade recente
- Gráficos de desempenho
- Gerenciar disciplinas específicas
====================================================
-->

<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
          <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" 
               style="width: 60px; height: 60px; font-size: 24px;">
            <?= strtoupper(substr($aluno['nome'], 0, 2)) ?>
          </div>
          <div>
            <h2><?= htmlspecialchars($aluno['nome']) ?></h2>
            <p class="text-muted mb-0">
              <i class="bi bi-envelope"></i> <?= htmlspecialchars($aluno['email']) ?>
            </p>
            <small class="text-muted">
              <i class="bi bi-calendar"></i> 
              Cadastrado em <?= date('d/m/Y', strtotime($aluno['created_at'])) ?>
            </small>
          </div>
        </div>
        <div class="btn-group">
          <a href="?route=professor/gerenciarAlunos" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
          </a>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarDisciplinas">
            <i class="bi bi-gear"></i> Gerenciar Disciplinas
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Estatísticas do Aluno -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card bg-primary text-white">
        <div class="card-body text-center">
          <h4><?= count($disciplinas) ?></h4>
          <small>Disciplinas Ativas</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-success text-white">
        <div class="card-body text-center">
          <h4><?= array_sum(array_column($disciplinas, 'total_materiais')) ?></h4>
          <small>Materiais Disponíveis</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info text-white">
        <div class="card-body text-center">
          <h4><?= array_sum(array_column($disciplinas, 'total_acessos')) ?></h4>
          <small>Total de Acessos</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning text-white">
        <div class="card-body text-center">
          <h4><?= count($atividades) > 0 ? date('d/m', strtotime($atividades[0]['data_acesso'])) : '-' ?></h4>
          <small>Último Acesso</small>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Disciplinas do Aluno -->
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5><i class="bi bi-bookmark-check"></i> Disciplinas e Progresso</h5>
        </div>
        <div class="card-body">
          <?php if (!empty($disciplinas)): ?>
            <?php foreach ($disciplinas as $disciplina): ?>
              <?php 
                $progresso = $disciplina['total_materiais'] > 0 ? 
                           ($disciplina['total_acessos'] / $disciplina['total_materiais']) * 100 : 0;
                $corProgresso = $progresso >= 80 ? 'success' : ($progresso >= 50 ? 'warning' : 'danger');
              ?>
              <div class="mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h6 class="mb-0"><?= htmlspecialchars($disciplina['nome']) ?></h6>
                  <span class="badge bg-<?= $corProgresso ?>"><?= number_format($progresso, 1) ?>%</span>
                </div>
                <div class="progress mb-2" style="height: 8px;">
                  <div class="progress-bar bg-<?= $corProgresso ?>" 
                       style="width: <?= $progresso ?>%"></div>
                </div>
                <div class="row text-center">
                  <div class="col-4">
                    <small class="text-muted">Materiais</small><br>
                    <strong><?= $disciplina['total_materiais'] ?></strong>
                  </div>
                  <div class="col-4">
                    <small class="text-muted">Acessos</small><br>
                    <strong><?= $disciplina['total_acessos'] ?></strong>
                  </div>
                  <div class="col-4">
                    <small class="text-muted">Desde</small><br>
                    <strong><?= date('d/m/Y', strtotime($disciplina['data_escolha'])) ?></strong>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="text-center py-4">
              <i class="bi bi-bookmark-x fs-1 text-muted"></i>
              <h5 class="text-muted">Nenhuma disciplina selecionada</h5>
              <p class="text-muted">Este aluno ainda não possui disciplinas ativas.</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarDisciplinas">
                <i class="bi bi-plus"></i> Adicionar Disciplina
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Atividade Recente -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5><i class="bi bi-clock-history"></i> Atividade Recente</h5>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
          <?php if (!empty($atividades)): ?>
            <?php foreach ($atividades as $atividade): ?>
              <div class="d-flex align-items-start mb-3 pb-2 border-bottom">
                <div class="flex-shrink-0 me-2">
                  <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                       style="width: 32px; height: 32px; font-size: 12px;">
                    <i class="bi bi-play-circle"></i>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1 small"><?= htmlspecialchars($atividade['titulo']) ?></h6>
                  <div class="text-muted small">
                    <span class="badge bg-secondary"><?= htmlspecialchars($atividade['disciplina']) ?></span>
                  </div>
                  <div class="text-muted small">
                    <i class="bi bi-clock"></i> 
                    <?= date('d/m H:i', strtotime($atividade['data_acesso'])) ?>
                    <?php if ($atividade['tempo_sessao']): ?>
                      | <?= gmdate('H:i', $atividade['tempo_sessao']) ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="text-center py-3">
              <i class="bi bi-clock-history fs-3 text-muted"></i>
              <p class="text-muted mb-0">Nenhuma atividade registrada</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Gráfico de Progresso -->
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5><i class="bi bi-graph-up"></i> Evolução do Progresso</h5>
        </div>
        <div class="card-body">
          <canvas id="graficoProgresso" width="400" height="100"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Gerenciar Disciplinas -->
<div class="modal fade" id="modalGerenciarDisciplinas" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="bi bi-gear"></i> Gerenciar Disciplinas - <?= htmlspecialchars($aluno['nome']) ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Abas -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#adicionar" type="button">
              <i class="bi bi-plus"></i> Adicionar
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#remover" type="button">
              <i class="bi bi-dash"></i> Remover
            </button>
          </li>
        </ul>

        <div class="tab-content mt-3">
          <!-- Aba Adicionar -->
          <div class="tab-pane fade show active" id="adicionar">
            <form method="POST" action="?route=professor/adicionarDisciplinaAluno">
              <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
              
              <div class="mb-3">
                <label for="nova_disciplina" class="form-label">Adicionar Disciplina</label>
                <select name="disciplina" id="nova_disciplina" class="form-select" required>
                  <option value="">Escolha uma disciplina...</option>
                  <option value="Matemática">Matemática</option>
                  <option value="História">História</option>
                  <option value="Biologia">Biologia</option>
                  <option value="Física">Física</option>
                  <option value="Português">Português</option>
                  <option value="Química">Química</option>
                  <option value="Geografia">Geografia</option>
                  <option value="Inglês">Inglês</option>
                  <option value="Educação Física">Educação Física</option>
                  <option value="Artes">Artes</option>
                </select>
              </div>
              
              <div class="d-grid">
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-check"></i> Adicionar Disciplina
                </button>
              </div>
            </form>
          </div>

          <!-- Aba Remover -->
          <div class="tab-pane fade" id="remover">
            <?php if (!empty($disciplinas)): ?>
              <div class="mb-3">
                <label class="form-label">Disciplinas Ativas</label>
              </div>
              <?php foreach ($disciplinas as $disciplina): ?>
                <div class="d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                  <div>
                    <strong><?= htmlspecialchars($disciplina['nome']) ?></strong><br>
                    <small class="text-muted">
                      Desde <?= date('d/m/Y', strtotime($disciplina['data_escolha'])) ?> | 
                      <?= $disciplina['total_acessos'] ?> acessos
                    </small>
                  </div>
                  <form method="POST" action="?route=professor/removerDisciplinaAluno" 
                        onsubmit="return confirm('Remover disciplina <?= htmlspecialchars($disciplina['nome']) ?>?')">
                    <input type="hidden" name="aluno_id" value="<?= $aluno['id'] ?>">
                    <input type="hidden" name="disciplina" value="<?= htmlspecialchars($disciplina['nome']) ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      <i class="bi bi-trash"></i> Remover
                    </button>
                  </form>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="text-center py-3">
                <i class="bi bi-bookmark-x fs-3 text-muted"></i>
                <p class="text-muted">Nenhuma disciplina para remover</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Gráfico de Progresso
const ctx = document.getElementById('graficoProgresso').getContext('2d');

const disciplinasNomes = <?= json_encode(array_column($disciplinas, 'nome')) ?>;
const progressoDisciplinas = <?= json_encode(array_map(function($d) {
  return $d['total_materiais'] > 0 ? ($d['total_acessos'] / $d['total_materiais']) * 100 : 0;
}, $disciplinas)) ?>;

const grafico = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: disciplinasNomes,
    datasets: [{
      label: 'Progresso (%)',
      data: progressoDisciplinas,
      backgroundColor: [
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(255, 205, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)'
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        max: 100,
        ticks: {
          callback: function(value) {
            return value + '%';
          }
        }
      }
    },
    plugins: {
      legend: {
        display: false
      },
      tooltip: {
        callbacks: {
          label: function(context) {
            return context.parsed.y.toFixed(1) + '%';
          }
        }
      }
    }
  }
});

// Mostrar mensagens
<?php if (isset($_SESSION['sucesso'])): ?>
  toastr.success('<?= $_SESSION['sucesso'] ?>');
  <?php unset($_SESSION['sucesso']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['erro'])): ?>
  toastr.error('<?= $_SESSION['erro'] ?>');
  <?php unset($_SESSION['erro']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['aviso'])): ?>
  toastr.warning('<?= $_SESSION['aviso'] ?>');
  <?php unset($_SESSION['aviso']); ?>
<?php endif; ?>
</script>

<?php include_once 'app/views/partials/footer.php'; ?>
