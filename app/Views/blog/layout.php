<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Blog' ?> | Personal Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background: #2c3e50 !important;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .badge-category {
            background: #3498db;
        }

        footer {
            background: #2c3e50;
            color: #bdc3c7;
        }

        .search-box {
            border-radius: 25px;
            padding-left: 20px;
        }

        .btn-search {
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">🖊️ Personal Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <?php foreach ($categories as $cat): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/category/<?= $cat['slug'] ?>">
                                <?= esc($cat['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Search Form -->
                <form action="/" method="GET" class="d-flex gap-2">
                    <input type="text" name="q" class="form-control search-box" placeholder="Cari artikel..."
                        value="<?= esc($keyword ?? '') ?>">
                    <button type="submit" class="btn btn-primary btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container flex-grow-1 mb-5">
            <?= $this->renderSection('content') ?>
    </div>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center">
        <p class="mb-0">© <?= date('Y') ?> Personal Blog. Dibuat dengan ❤️ menggunakan CodeIgniter 4</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>