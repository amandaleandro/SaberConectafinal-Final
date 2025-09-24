<div class="container my-5">
  <h2 class="mb-4 text-center">👋 Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Aluno') ?>!</h2>

  <!-- Estatísticas rápidas -->
  <div class="row g-4 mb-5">
    <!-- Minhas Matérias -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <i class="bi bi-journal-bookmark fs-2 text-primary"></i>
          <h5 class="mt-2">Minhas Matérias</h5>
          <a href="?route=aluno/minhasMaterias" class="btn btn-sm btn-outline-primary mt-2">Acessar</a>
        </div>
      </div>
    </div>

    <!-- Meus Conteúdos -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <i class="bi bi-collection fs-2 text-success"></i>
          <h5 class="mt-2">Meus Conteúdos</h5>
          <a href="?route=aluno/meusConteudos" class="btn btn-sm btn-outline-success mt-2">Acessar</a>
        </div>
      </div>
    </div>

    <!-- Favoritas (Matérias) -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <i class="bi bi-heart fs-2 text-danger"></i>
          <h5 class="mt-2">Matérias Favoritas</h5>
          <a href="?route=aluno/favoritasMaterias" class="btn btn-sm btn-outline-danger mt-2">Ver</a>
        </div>
      </div>
    </div>

    <!-- Favoritos (Conteúdos) -->
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0">
        <div class="card-body">
          <i class="bi bi-heart-fill fs-2 text-danger"></i>
          <h5 class="mt-2">Conteúdos Favoritos</h5>
          <a href="?route=aluno/favoritosConteudos" class="btn btn-sm btn-outline-danger mt-2">Ver</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sugestões: CONTEÚDOS SUGERIDOS -->
  <div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h4 class="m-0">✨ Conteúdos sugeridos para você</h4>
      <a href="?route=aluno/sugeridosConteudos" class="btn btn-sm btn-warning">Ver todos</a>
    </div>

    <?php if (!empty($sugeridosConteudos)): ?>
      <div class="row g-4">
        <?php foreach (array_slice($sugeridosConteudos, 0, 6) as $c): ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1"><?= htmlspecialchars($c['titulo']) ?></h5>
                <small class="text-muted mb-2">
                  <?= htmlspecialchars(strtoupper($c['tipo'] ?? 'conteúdo')) ?>
                  • <?= htmlspecialchars($c['nivel_dificuldade'] ?? 'médio') ?>
                </small>
                <p class="card-text flex-grow-1">
                  <?= htmlspecialchars(mb_strimwidth($c['descricao'] ?? '', 0, 120, '...')) ?>
                </p>
                <div class="d-flex gap-2 mt-2">
                  <a href="?route=aluno/visualizarConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-outline-secondary">Ver</a>
                  <a href="?route=aluno/vincularConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-danger">Vincular</a>
                  <a href="?route=aluno/favoritarConteudo&id=<?= (int)$c['id'] ?>" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-heart"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="text-center p-4 border rounded-3 bg-light">
        <p class="mb-2">Sem sugestões por enquanto.</p>
        <a class="btn btn-warning" href="?route=aluno/todosConteudos">Explorar conteúdos</a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Acesso rápido -->
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-journal-text fs-2 text-info"></i>
          <h5>Todas as Matérias</h5>
          <p class="text-muted">Veja todas as disciplinas disponíveis na plataforma.</p>
          <a href="?route=aluno/todasMaterias" class="btn btn-info">Explorar</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <i class="bi bi-archive fs-2 text-secondary"></i>
          <h5>Todos os Conteúdos</h5>
          <p class="text-muted">Confira todos os materiais publicados por professores.</p>
          <a href="?route=aluno/todosConteudos" class="btn btn-secondary">Explorar</a>
        </div>
      </div>
    </div>
  </div>
</div>
