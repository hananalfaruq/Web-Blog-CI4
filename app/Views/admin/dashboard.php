<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <i class="bi bi-file-earmark-text fs-1 text-primary"></i>
            <h2 class="fw-bold mt-2"><?= $totalPost ?></h2>
            <p class="text-muted mb-0">Total Post</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <i class="bi bi-check-circle fs-1 text-success"></i>
            <h2 class="fw-bold mt-2"><?= $published ?></h2>
            <p class="text-muted mb-0">Published</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <i class="bi bi-pencil-square fs-1 text-warning"></i>
            <h2 class="fw-bold mt-2"><?= $draft ?></h2>
            <p class="text-muted mb-0">Draft</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <i class="bi bi-tags fs-1 text-info"></i>
            <h2 class="fw-bold mt-2"><?= $totalCat ?></h2>
            <p class="text-muted mb-0">Kategori</p>
        </div>
    </div>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Post Terbaru</h5>
        <a href="/admin/posts/create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Post
        </a>
    </div>
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentPosts as $post): ?>
            <tr>
                <td><?= esc($post['title']) ?></td>
                <td><span class="badge bg-secondary"><?= esc($post['category_name']) ?></span></td>
                <td>
                    <?php if ($post['status'] == 'published'): ?>
                        <span class="badge bg-success">Published</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Draft</span>
                    <?php endif; ?>
                </td>
                <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>