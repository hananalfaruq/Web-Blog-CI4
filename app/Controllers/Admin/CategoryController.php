<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title'      => 'Kelola Kategori',
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('admin/categories/index', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $slug = url_title($name, '-', true);

        $this->categoryModel->insert([
            'name' => $name,
            'slug' => $slug,
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil dihapus!');
    }
}