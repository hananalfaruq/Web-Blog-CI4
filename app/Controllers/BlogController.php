<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoryModel;

class BlogController extends BaseController
{
    protected $postModel;
    protected $categoryModel;
    protected $db;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        helper('text');
        $this->db = \Config\Database::connect();
    }

    // Homepage
    public function index()
    {
        $keyword = $this->request->getGet('q');

        if ($keyword) {
            $posts = $this->postModel->searchPosts($keyword);
        } else {
            $posts = $this->postModel->getPostsWithCategory('published');
        }

        // Pagination manual per 6 post
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 6;
        $total = count($posts);
        $offset = ($page - 1) * $perPage;
        $posts = array_slice($posts, $offset, $perPage);

        $data = [
            'title' => 'Blog',
            'posts' => $posts,
            'categories' => $this->categoryModel->findAll(),
            'keyword' => $keyword,
            'currentPage' => $page,
            'totalPages' => ceil($total / $perPage),
        ];

        return view('blog/index', $data);
    }

    // Detail Post
    public function detail($slug)
    {
        $post = $this->postModel->getPostBySlug($slug);

        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Post terkait (kategori sama)
        $related = $this->db->table('posts p')
            ->select('p.*, c.name as category_name')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.category_id', $post['category_id'])
            ->where('p.slug !=', $slug)
            ->where('p.status', 'published')
            ->limit(3)
            ->get()->getResultArray();

        $data = [
            'title' => $post['title'],
            'post' => $post,
            'related' => $related,
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('blog/detail', $data);
    }

    // Filter by Kategori
    public function category($slug)
    {
        $category = $this->categoryModel->where('slug', $slug)->first();

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $posts = $this->db->table('posts p')
            ->select('p.*, c.name as category_name')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.category_id', $category['id'])
            ->where('p.status', 'published')
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();

        $data = [
            'title' => 'Kategori: ' . $category['name'],
            'posts' => $posts,
            'categories' => $this->categoryModel->findAll(),
            'keyword' => null,
            'currentPage' => 1,
            'totalPages' => 1,
        ];

        return view('blog/index', $data);
    }
}