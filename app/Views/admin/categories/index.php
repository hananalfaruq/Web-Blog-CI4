<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4">
        <div class="card p-4 mb-4">
            <h5 class="fw-bold mb-3">Tambah Kategori</h5>
            <form action="/admin/categories/store" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" 
                           placeholder="Contoh: Teknologi" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-plus-lg me-1"></i> Tambah
                </button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card p-4">
            <h5 class="fw-bold mb-3">Daftar Kategori</h5>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $i => $cat): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($cat['name']) ?></td>
                        <td><code><?= esc($cat['slug']) ?></code></td>
                        <td>
                            <a href="/admin/categories/delete/<?= $cat['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus kategori ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>