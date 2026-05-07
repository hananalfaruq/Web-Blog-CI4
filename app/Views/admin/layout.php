<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Blog' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
        }
        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #3498db;
            color: #fff;
        }
        .sidebar-brand {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 700;
            padding: 20px;
            border-bottom: 1px solid #3d5166;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .topbar {
            background: #fff;
            padding: 15px 30px;
            margin-left: 250px;
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">🖊️ Admin Blog</div>
        <nav class="nav flex-column mt-3">
            <a href="/admin/dashboard" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="/admin/posts" class="nav-link <?= (strpos(uri_string(), 'admin/posts') !== false) ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-text me-2"></i> Posts
            </a>
            <a href="/admin/categories" class="nav-link <?= (strpos(uri_string(), 'admin/categories') !== false) ? 'active' : '' ?>">
                <i class="bi bi-tags me-2"></i> Kategori
            </a>
            <hr style="border-color:#3d5166; margin: 10px 20px;">
            <a href="/" target="_blank" class="nav-link">
                <i class="bi bi-globe me-2"></i> Lihat Blog
            </a>
            <a href="/auth/logout" class="nav-link text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><?= $title ?? '' ?></h6>
        <span class="text-muted"><i class="bi bi-person-circle me-1"></i><?= session()->get('user_name') ?></span>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>