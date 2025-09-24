<div class="container text-center my-5">
    <h1 class="display-3 text-danger"><?= htmlspecialchars($error['code'] ?? 500) ?></h1>
    <h2 class="mb-3"><?= htmlspecialchars($error['title'] ?? 'Erro de Banco de Dados') ?></h2>
    <p class="lead"><?= htmlspecialchars($error['message'] ?? 'Não foi possível conectar ao banco de dados.') ?></p>
    <p><?= htmlspecialchars($error['suggestion'] ?? 'Verifique a conexão e tente novamente.') ?></p>

    <a href="?route=site/home" class="btn btn-danger mt-3">Voltar para a Home</a>
</div>
