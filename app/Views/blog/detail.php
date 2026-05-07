<?= $this->extend('blog/layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <!-- Artikel Utama -->
    <div class="col-md-8">
        <div class="card p-4 mb-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="/category/<?= $post['category_slug'] ?>">
                            <?= esc($post['category_name']) ?>
                        </a>
                    </li>
                    <li class="breadcrumb-item active"><?= esc($post['title']) ?></li>
                </ol>
            </nav>

            <!-- Thumbnail -->
            <?php if ($post['thumbnail']): ?>
                <img src="/uploads/thumbnails/<?= $post['thumbnail'] ?>"
                     class="img-fluid rounded mb-4" alt="<?= esc($post['title']) ?>">
            <?php endif; ?>

            <!-- Meta -->
            <div class="d-flex gap-3 mb-3">
                <span class="badge bg-primary"><?= esc($post['category_name']) ?></span>
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?= date('d F Y', strtotime($post['created_at'])) ?>
                </small>
            </div>

            <!-- Judul -->
            <h1 class="fw-bold mb-4"><?= esc($post['title']) ?></h1>

            <!-- Konten -->
            <div class="post-content">
                <?= $post['content'] ?>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Kategori -->
        <div class="card p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-tags me-2"></i>Kategori</h5>
            <?php foreach ($categories as $cat): ?>
                <a href="/category/<?= $cat['slug'] ?>"
                   class="btn btn-outline-secondary btn-sm me-1 mb-2">
                    <?= esc($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Post Terkait -->
        <?php if (!empty($related)): ?>
        <div class="card p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-journal-text me-2"></i>Artikel Terkait</h5>
            <?php foreach ($related as $rel): ?>
            <div class="d-flex gap-3 mb-3">
                <?php if ($rel['thumbnail']): ?>
                    <img src="/uploads/thumbnails/<?= $rel['thumbnail'] ?>"
                         width="70" height="55" style="object-fit:cover; border-radius:8px;">
                <?php endif; ?>
                <div>
                    <a href="/post/<?= $rel['slug'] ?>" class="text-decoration-none fw-semibold">
                        <?= esc($rel['title']) ?>
                    </a>
                    <p class="text-muted small mb-0">
                        <?= date('d M Y', strtotime($rel['created_at'])) ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>