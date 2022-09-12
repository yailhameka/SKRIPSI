<?php namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model{
    protected $table = 'Data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'id_master_data', 'KodeWilayah', 'nilai'
    ];
    protected $returnType = 'App\Entities\Data';
    protected $useTimestamps = false;
}