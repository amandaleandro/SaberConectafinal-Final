<?php
// Garante que a sessão está ativa (se não já foi iniciada no index.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define o tipo de usuário (para exibir menu correto)
$usuarioTipo = $_SESSION['usuario_tipo'] ?? null;
$usuarioNome = $_SESSION['usuario_nome'] ?? "Convidado";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Saber Conecta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="public/assets/css/estilo.css">
</head>
<body>
<header class="main-header shadow-sm">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#8B0000;">
    <div class="container">
      <!-- LOGO + BRAND -->
      <a class="navbar-brand fw-bold d-flex align-items-center" href="?route=site/home">
        <img src="public/assets/images/logo.jpeg" alt="Logo" width="40" class="me-2 rounded-circle border border-light">
        Saber Conecta
      </a>

      <!-- TOGGLER MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- LINKS -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          
          <?php if (!isset($_SESSION['usuario_id'])): ?>
            <!-- Visitante -->
            <li class="nav-item"><a class="nav-link" href="?route=site/home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=site/sobre">Sobre</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=auth/login">Login</a></li>
            <li class="nav-item">
              <a class="nav-link" href="?route=auth/cadastro">Cadastro</a>
            </li>

          <?php elseif ($_SESSION['usuario_tipo'] === "aluno"): ?>
            <!-- Menu Aluno -->
            <li class="nav-item"><a class="nav-link" href="?route=dashboard/aluno">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=aluno/minhasMaterias">Minhas Disciplinas</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=aluno/todasMaterias">Todas Matérias</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=aluno/sugeridasMaterias">Sugeridas</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=aluno/meusConteudos">Meus Conteúdos</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=aluno/favoritasMaterias">Favoritos</a></li>

            
            <!-- Perfil Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i>
                <?php 
                  $nome = $_SESSION['usuario_nome'] ?? 'Aluno';
                  $partes = explode(' ', trim($nome));
                  echo $partes[0] . (count($partes) > 1 ? ' ' . end($partes) : '');
                ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="?route=usuario/perfil"><i class="bi bi-person me-2"></i>Meu Perfil</a></li>
              </ul>
            </li>
            
            <!-- Botão Sair -->
            <li class="nav-item">
              <a class="nav-link text-warning fw-bold" href="?route=auth/logout" onclick="return confirm('Deseja sair?')">
                <i class="bi bi-box-arrow-right me-1"></i>Sair
              </a>
            </li>

          <?php elseif ($_SESSION['usuario_tipo'] === "professor"): ?>
            <!-- Menu Professor -->
            <li class="nav-item"><a class="nav-link" href="?route=dashboard/professor">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=materia/minhas">Minhas Matérias</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=conteudo/meusProfessor">Meus Conteúdos</a></li>
            <li class="nav-item"><a class="nav-link" href="?route=professor/gerenciarAlunos">Alunos</a></li>

            <!-- Perfil Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i>
                <?php 
                  $nome = $_SESSION['usuario_nome'] ?? 'Professor';
                  $partes = explode(' ', trim($nome));
                  echo $partes[0] . (count($partes) > 1 ? ' ' . end($partes) : '');
                ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="?route=usuario/perfil"><i class="bi bi-person me-2"></i>Meu Perfil</a></li>
              </ul>
            </li>
            
            <!-- Botão Sair -->
            <li class="nav-item">
              <a class="nav-link text-warning fw-bold" href="?route=auth/logout" onclick="return confirm('Deseja sair?')">
                <i class="bi bi-box-arrow-right me-1"></i>Sair
              </a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>
</header>
<main class="flex-grow-1">
