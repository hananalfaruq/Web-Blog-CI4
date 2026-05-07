<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Post</h5>
        <a href="/admin/posts/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Post
        </a>
    </div>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $i => $post): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td>
                    <?php if ($post['thumbnail']): ?>
                        <img src="/uploads/thumbnails/<?= $post['thumbnail'] ?>"
                             width="60" height="45" style="object-fit:cover; border-radius:6px;">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
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
                <td>
                    <a href="/admin/posts/edit/<?= $post['id'] ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="/admin/posts/delete/<?= $post['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Hapus post ini?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>