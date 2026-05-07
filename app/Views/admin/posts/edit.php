<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="card p-4">
    <h5 class="fw-bold mb-4">Edit Post</h5>
    <form action="/admin/posts/update/<?= $post['id'] ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Post</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($post['title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Konten</label>
                    <div id="quill-editor" style="height: 400px;"></div>
                    <textarea name="content" id="content" style="display:none;"><?= esc($post['content']) ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $post['category_id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" <?= $post['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?= $post['status'] == 'published' ? 'selected' : '' ?>>Published
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Thumbnail</label>
                    <?php if ($post['thumbnail']): ?>
                        <img src="/uploads/thumbnails/<?= $post['thumbnail'] ?>" class="img-fluid rounded mb-2">
                    <?php endif; ?>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Update Post
                    </button>
                    <a href="/admin/posts" class="btn btn-outline-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': [1, 2, 3, false] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Load konten existing ke editor
    quill.root.innerHTML = document.getElementById('content').value;

    // Saat form submit, salin isi editor ke textarea
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
</script>
<?= $this->endSection() ?>