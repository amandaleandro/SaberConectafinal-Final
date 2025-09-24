<div class="container my-4">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-files"></i> Meus Materiais</h2>
        <a href="?route=material/cadastro" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Novo Material
        </a>
      </div>
    </div>
  </div>

  <!-- Filtros e busca -->
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Buscar materiais..." id="searchMaterials">
      </div>
    </div>
    <div class="col-md-3">
      <select class="form-select" id="filterDisciplina">
        <option value="">Todas as disciplinas</option>
        <option value="matematica">Matemática</option>
        <option value="historia">História</option>
        <option value="biologia">Biologia</option>
        <option value="fisica">Física</option>
        <option value="quimica">Química</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-select" id="filterTipo">
        <option value="">Todos os tipos</option>
        <option value="pdf">PDF</option>
        <option value="video">Vídeo</option>
        <option value="link">Link</option>
        <option value="apresentacao">Apresentação</option>
      </select>
    </div>
  </div>

  <!-- Lista de materiais -->
  <div class="row">
    <!-- Material 1 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-primary">Matemática</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Introdução à Álgebra</h5>
          <p class="card-text text-muted">Lista completa de exercícios sobre equações lineares e quadráticas para o 9º ano.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-file-pdf"></i> PDF</span>
            <span><i class="bi bi-eye"></i> 89 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 15/09/2025</small>
        </div>
      </div>
    </div>

    <!-- Material 2 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-warning">História</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Revolução Francesa</h5>
          <p class="card-text text-muted">Documentário sobre os principais eventos e personagens da Revolução Francesa.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-play-circle"></i> Vídeo</span>
            <span><i class="bi bi-eye"></i> 67 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 12/09/2025</small>
        </div>
      </div>
    </div>

    <!-- Material 3 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-info">Biologia</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Células e DNA</h5>
          <p class="card-text text-muted">Apresentação interativa sobre estrutura celular e material genético.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-file-earmark-slides"></i> Apresentação</span>
            <span><i class="bi bi-eye"></i> 54 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 10/09/2025</small>
        </div>
      </div>
    </div>

    <!-- Material 4 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-success">Física</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Leis de Newton</h5>
          <p class="card-text text-muted">Experimentos práticos para demonstrar as três leis fundamentais da mecânica.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-link-45deg"></i> Link</span>
            <span><i class="bi bi-eye"></i> 43 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 08/09/2025</small>
        </div>
      </div>
    </div>

    <!-- Material 5 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-danger">Química</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Tabela Periódica</h5>
          <p class="card-text text-muted">Guia interativo dos elementos químicos com propriedades e curiosidades.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-file-pdf"></i> PDF</span>
            <span><i class="bi bi-eye"></i> 76 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 05/09/2025</small>
        </div>
      </div>
    </div>

    <!-- Material 6 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="badge bg-primary">Matemática</span>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Editar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Visualizar</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Baixar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Excluir</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">Geometria Plana</h5>
          <p class="card-text text-muted">Exercícios sobre áreas, perímetros e teoremas fundamentais da geometria plana.</p>
          <div class="d-flex justify-content-between text-muted small">
            <span><i class="bi bi-file-pdf"></i> PDF</span>
            <span><i class="bi bi-eye"></i> 38 acessos</span>
          </div>
        </div>
        <div class="card-footer bg-transparent">
          <small class="text-muted">Criado em 02/09/2025</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Paginação -->
  <div class="row">
    <div class="col-12">
      <nav aria-label="Navegação da página">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Anterior</a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Próximo</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script>
// Implementação de busca AJAX para professor
let timeoutId;

document.getElementById('searchMaterials').addEventListener('input', function() {
  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => {
    buscarMeusMateriais();
  }, 300);
});

document.getElementById('filterDisciplina').addEventListener('change', buscarMeusMateriais);
document.getElementById('filterTipo').addEventListener('change', buscarMeusMateriais);

function buscarMeusMateriais() {
  const termo = document.getElementById('searchMaterials').value;
  const disciplina = document.getElementById('filterDisciplina').value;
  const tipo = document.getElementById('filterTipo').value;
  
  const params = new URLSearchParams({
    q: termo,
    disciplina: disciplina,
    tipo: tipo
  });
  
  // Mostrar loading
  const tbody = document.querySelector('table tbody');
  tbody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border text-primary" role="status"></div></td></tr>';
  
  fetch(`?route=material/buscarMeus&${params}`)
    .then(response => response.json())
    .then(data => {
      atualizarResultadosProfessor(data);
    })
    .catch(error => {
      console.error('Erro na busca:', error);
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Erro ao carregar materiais</td></tr>';
    });
}

function atualizarResultadosProfessor(materiais) {
  const tbody = document.querySelector('table tbody');
  
  if (materiais.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="6" class="text-center py-5">
          <i class="bi bi-search fs-1 text-muted"></i>
          <h4 class="text-muted">Nenhum material encontrado</h4>
          <p class="text-muted">Tente ajustar os filtros ou termos de busca.</p>
        </td>
      </tr>
    `;
    return;
  }
  
  tbody.innerHTML = '';
  
  materiais.forEach(material => {
    const row = document.createElement('tr');
    row.innerHTML = createMaterialRow(material);
    tbody.appendChild(row);
  });
}

function createMaterialRow(material) {
  const badgeColors = {
    'Matemática': 'primary',
    'História': 'success', 
    'Biologia': 'info',
    'Física': 'warning',
    'Português': 'danger',
    'Química': 'secondary'
  };
  
  const iconTypes = {
    'pdf': 'file-pdf text-danger',
    'video': 'play-circle text-primary',
    'link': 'globe text-info',
    'apresentacao': 'file-earmark-slides text-warning',
    'exercicio': 'list-check text-success'
  };
  
  const badgeColor = badgeColors[material.disciplina] || 'secondary';
  const icon = iconTypes[material.tipo] || 'file-text text-muted';
  
  return `
    <td>
      <strong>${material.titulo}</strong><br>
      <small class="text-muted">${material.descricao.substring(0, 50)}...</small>
    </td>
    <td><span class="badge bg-${badgeColor}">${material.disciplina}</span></td>
    <td><i class="bi bi-${icon}"></i> ${material.tipo.charAt(0).toUpperCase() + material.tipo.slice(1)}</td>
    <td><span class="badge bg-info">${material.nivel}</span></td>
    <td class="text-center">
      <span class="badge bg-success">${Math.floor(Math.random() * 50)}</span>
    </td>
    <td>
      <div class="btn-group" role="group">
        <a href="?route=material/editar&id=${material.id}" class="btn btn-sm btn-outline-primary">
          <i class="bi bi-pencil"></i>
        </a>
        <button class="btn btn-sm btn-outline-info" onclick="visualizarMaterial(${material.id})">
          <i class="bi bi-eye"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger" onclick="excluirMaterial(${material.id})">
          <i class="bi bi-trash"></i>
        </button>
      </div>
    </td>
  `;
}

function excluirMaterial(id) {
  if (confirm('Tem certeza que deseja excluir este material?')) {
    fetch(`?route=material/excluir&id=${id}`, {method: 'POST'})
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          buscarMeusMateriais(); // Recarregar lista
        } else {
          alert('Erro ao excluir material');
        }
      });
  }
}

function visualizarMaterial(id) {
  window.open(`?route=material/visualizar&id=${id}`, '_blank');
}
</script>
