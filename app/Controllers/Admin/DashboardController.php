<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $postModel     = new PostModel();
        $categoryModel = new CategoryModel();

        $data = [
            'title'       => 'Dashboard',
            'totalPost'   => $postModel->countAll(),
            'published'   => $postModel->where('status', 'published')->countAllResults(),
            'draft'       => $postModel->where('status', 'draft')->countAllResults(),
            'totalCat'    => $categoryModel->countAll(),
            'recentPosts' => $postModel->getPostsWithCategory(),
        ];

        return view('admin/dashboard', $data);
    }
}