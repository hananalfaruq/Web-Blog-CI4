<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class PostController extends BaseController
{
    protected $postModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->postModel     = new PostModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Post',
            'posts' => $this->postModel->getPostsWithCategory(),
        ];
        return view('admin/posts/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Post',
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('admin/posts/create', $data);
    }

    public function store()
    {
        $thumbnail = $this->request->getFile('thumbnail');
        $thumbName = null;

        if ($thumbnail && $thumbnail->isValid()) {
            $thumbName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/thumbnails', $thumbName);
        }

        $title = $this->request->getPost('title');
        $slug  = url_title($title, '-', true);

        // Pastikan slug unik
        $existing = $this->postModel->where('slug', $slug)->first();
        if ($existing) {
            $slug = $slug . '-' . time();
        }

        $this->postModel->insert([
            'user_id'     => session()->get('user_id'),
            'category_id' => $this->request->getPost('category_id'),
            'title'       => $title,
            'slug'        => $slug,
            'thumbnail'   => $thumbName,
            'content'     => $this->request->getPost('content'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/posts')->with('success', 'Post berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Post',
            'post'       => $this->postModel->find($id),
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('admin/posts/edit', $data);
    }

    public function update($id)
    {
        $thumbnail = $this->request->getFile('thumbnail');
        $post      = $this->postModel->find($id);
        $thumbName = $post['thumbnail'];

        if ($thumbnail && $thumbnail->isValid()) {
            // Hapus thumbnail lama
            if ($thumbName && file_exists(FCPATH . 'uploads/thumbnails/' . $thumbName)) {
                unlink(FCPATH . 'uploads/thumbnails/' . $thumbName);
            }
            $thumbName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/thumbnails', $thumbName);
        }

        $this->postModel->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'title'       => $this->request->getPost('title'),
            'thumbnail'   => $thumbName,
            'content'     => $this->request->getPost('content'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/posts')->with('success', 'Post berhasil diupdate!');
    }

    public function delete($id)
    {
        $post = $this->postModel->find($id);
        if ($post['thumbnail'] && file_exists(FCPATH . 'uploads/thumbnails/' . $post['thumbnail'])) {
            unlink(FCPATH . 'uploads/thumbnails/' . $post['thumbnail']);
        }
        $this->postModel->delete($id);
        return redirect()->to('/admin/posts')->with('success', 'Post berhasil dihapus!');
    }
}