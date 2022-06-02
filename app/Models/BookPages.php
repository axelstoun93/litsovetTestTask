<?php

namespace App\Models;

use CodeIgniter\Model;

class BookPages extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'book_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'chapter_title',
        'content',
        'book_id',
        'chapter_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPagesByBookId($bookId,$page){
        return $this->where('book_id =',$bookId)->offset($page)->limit(1)->first();
    }

    public function getTotalPage($bookId){
        return $this->selectCount('id')->where('book_id =',$bookId)->countAllResults();
    }

    public function getChapterPage($bookId){
        $this->select('`book_pages`.`id`,`book_pages`.`chapter_title`,`book_chapters`.`views`');
        $this->join('book_chapters','book_chapters.id=book_pages.chapter_id','right');
        $this->where(['book_pages.book_id' => $bookId,'book_pages.chapter_title IS NOT NULL ' => null]);
        return $this->get();
    }


}
