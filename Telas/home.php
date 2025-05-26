<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Sistema de Gestão</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap + Icons + Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    * {
      font-family: 'Roboto', sans-serif;
    }

    body {
      background-color: #f4f6f9;
    }

    .navbar {
      background-color: #092f6b;
      color: white;
    }

    .navbar-brand {
      font-weight: bold;
      color: white !important;
    }

    .sidebar {
      width: 340px;
      height: 100vh;
      background-color: #092f6b;
      position: fixed;
      top: 56px;
      left: 0;
      padding-top: 20px;
      color: white;
      overflow-y: auto;
    }

    .sidebar a {
      color: #fff;
      font-size: 1.2rem;
      padding: 16px 30px;
      display: flex;
      align-items: center;
      text-decoration: none;
      white-space: nowrap;
      transition: background-color 0.2s ease;
      gap: 15px;
    }

    .sidebar a:hover,
    .sidebar a:focus {
      background-color: #0d3d92;
      color: #fff;
      text-decoration: none;
    }

    .sidebar a i {
      font-size: 1.5rem;
      min-width: 28px;
      text-align: center;
      flex-shrink: 0;
    }

    .main-content {
      margin-left: 340px;
      padding: 80px 60px 40px;
    }

    .card-option {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease-in-out;
      height: 100%;
      background: white;
      cursor: pointer;
    }

    .card-option:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .card-option i {
      font-size: 3rem;
      color: #092f6b;
    }

    .card-title {
      font-size: 1.3rem;
      margin-top: 15px;
      color: #092f6b;
      font-weight: 600;
    }

    @media (max-width: 992px) {
      .main-content {
        margin-left: 0;
        padding: 100px 20px;
      }

      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container-fluid px-4">
      <a class="navbar-brand" href="#"><i class="bi bi-hospital me-2"></i> Sistema de Gestão</a>
      <div class="d-flex ms-auto align-items-center">
        <span class="me-3">Olá, Usuário</span>
        <i class="bi bi-person-circle fs-4"></i>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar" role="navigation" aria-label="Menu principal">
    <a href="#" tabindex="0"><i class="bi bi-gear-fill"></i> ADM</a>
    <a href="#" tabindex="0"><i class="bi bi-person-fill"></i> Paciente</a>
    <a href="#" tabindex="0"><i class="bi bi-journal-text"></i> Laudo</a>
    <a href="#" tabindex="0"><i class="bi bi-file-medical-fill"></i> Exames Laboratoriais</a>
    <a href="#" tabindex="0"><i class="bi bi-file-earmark-medical-fill"></i> Exames Solicitados</a>
    <a href="#" tabindex="0"><i class="bi bi-question-circle"></i> Ajuda</a>
    <a href="#" tabindex="0"><i class="bi bi-box-arrow-right"></i> Sair</a>
  </div>

  <!-- Conteúdo Principal -->
  <main class="main-content" role="main">
    <h2 class="mb-5 text-center" style="color: #092f6b;">Home</h2>

    <div class="row g-4 justify-content-center">
      <div class="col-lg-5 col-md-6">
        <div class="card-option text-center p-5" tabindex="0">
          <i class="bi bi-gear-fill"></i>
          <div class="card-title">ADM</div>
        </div>
      </div>

      <div class="col-lg-5 col-md-6">
        <div class="card-option text-center p-5" tabindex="0">
          <i class="bi bi-person-fill"></i>
          <div class="card-title">Paciente</div>
        </div>
      </div>

      <div class="col-lg-5 col-md-6">
        <div class="card-option text-center p-5" tabindex="0">
          <i class="bi bi-journal-text"></i>
          <div class="card-title">Laudo</div>
        </div>
      </div>

      <div class="col-lg-5 col-md-6">
        <div class="card-option text-center p-5" tabindex="0">
          <i class="bi bi-file-medical-fill"></i>
          <div class="card-title">Exames Laboratoriais</div>
        </div>
      </div>

      <div class="col-lg-5 col-md-6">
        <div class="card-option text-center p-5" tabindex="0">
          <i class="bi bi-file-earmark-medical-fill"></i>
          <div class="card-title">Exames Solicitados</div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>