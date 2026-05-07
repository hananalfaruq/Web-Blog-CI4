<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table         = 'posts';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['user_id', 'category_id', 'title', 'slug', 'thumbnail', 'content', 'status'];
    protected $useTimestamps = true;

    public function getPostsWithCategory($status = null)
    {
        $builder = $this->db->table('posts p')
            ->select('p.*, c.name as category_name')
            ->join('categories c', 'c.id = p.category_id');
        if ($status) {
            $builder->where('p.status', $status);
        }
        return $builder->orderBy('p.created_at', 'DESC')->get()->getResultArray();
    }

    public function getPostBySlug($slug)
    {
        return $this->db->table('posts p')
            ->select('p.*, c.name as category_name, c.slug as category_slug')
            ->join('categories c', 'c.id = p.category_id')
            ->where('p.slug', $slug)
            ->where('p.status', 'published')
            ->get()->getRowArray();
    }

    public function searchPosts($keyword)
    {
        return $this->db->table('posts p')
            ->select('p.*, c.name as category_name')
            ->join('categories c', 'c.id = p.category_id')
            ->like('p.title', $keyword)
            ->orLike('p.content', $keyword)
            ->where('p.status', 'published')
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();
    }
}