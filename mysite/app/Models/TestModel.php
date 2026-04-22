<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table            = 'test_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $hidden        = ['deleted_at'];
    protected $allowedFields = [
        'id',
        'user_name',
        'age',
        'sex',
        'creater_at',
        'update_at',
    ];

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




    // 查询列表
    public function getList($size, $page)
    {
        return $this
        ->select($this->allowedFields)
        ->orderBy('id', 'desc')
        ->limit($size, ($page - 1) * $size)
        ->findAll();
}
    public function getListCount($reset = true)
    {
        return $this->countAllResults($reset);
    }
    public function getAgeList($age)
    {
        return $this->where('age', $age)
                    ->orderBy('id', 'desc')
                    ->findAll();
    }
    public function getSexList($sex)
    {
        return $this->where('sex', $sex)
                    ->orderBy('id', 'desc')
                    ->findAll();
    }

    // 查询单条
    public function getOne($id)
    {
        return $this->find($id);
    }
}
