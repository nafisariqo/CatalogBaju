<?php

namespace App\Models;

use CodeIgniter\Model;

class CatalogModel extends Model
{
    protected $table      = 'catalog';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'deskripsi', 'gambar'];

    public function search($keyword){
        
        return $this->table('catalog')->like('judul', $keyword)->orLike('deskripsi', $keyword);

    }

    public function getCatalog($slug = false)
    {
        if ($slug == false){
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

}