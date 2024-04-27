<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id_category';
    protected $returnType       = 'object';
    protected $allowedFields    = ['photo_category', 'name_category', 'description_category'];
    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}