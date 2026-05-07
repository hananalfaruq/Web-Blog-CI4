<?= $this->extend('blog/layout') ?>
<?= $this->section('content') ?>

<!-- Header -->
<?php if ($keyword): ?>
    <div class="alert alert-info mb-4">
        <i class="bi bi-search me-2"></i>
        Hasil pencarian untuk: <strong>"<?= esc($keyword) ?>"</strong>
        <a href="/" class="float-end">Hapus pencarian</a>
    </div>
<?php else: ?>
    <div class="text-center mb-5">
        <h1 class="fw-bold">Selamat Datang di Blog</h1>
        <p class="text-muted">Kumpulan artikel seputar teknologi, tutorial, dan lifestyle</p>
    </div>
<?php endif; ?>

<!-- Post Grid -->
<?php if (empty($posts)): ?>
    <div class="text-center py-5">
        <i class="bi bi-journal-x fs-1 text-muted"></i>
        <p class="text-muted mt-3">Belum ada artikel tersedia.</p>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <div class="card h-100">
                <?php if ($post['thumbnail']): ?>
                    <img src="/uploads/thumbnails/<?= $post['thumbnail'] ?>"
                         class="card-img-top" alt="<?= esc($post['title']) ?>">
                <?php else: ?>
                    <div class="card-img-top bg-secondary d-flex align-items-center 
                                justify-content-center" style="height:200px;">
                        <i class="bi bi-image text-white fs-1"></i>
                    </div>
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <span class="badge badge-category text-white mb-2" style="width:fit-content">
                        <?= esc($post['category_name']) ?>
                    </span>
                    <h5 class="card-title fw-bold"><?= esc($post['title']) ?></h5>
                    <p class="card-text text-muted small flex-grow-1">
                        <?= character_limiter(strip_tags($post['content']), 100) ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            <?= date('d M Y', strtotime($post['created_at'])) ?>
                        </small>
                        <a href="/post/<?= $post['slug'] ?>" class="btn btn-primary btn-sm">
                            Baca <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <nav class="mt-5 d-flex justify-content-center">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?><?= $keyword ? '&q=' . urlencode($keyword) : '' ?>">
                    <?= $i ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
<?php endif; ?>

<?= $this->endSection() ?>