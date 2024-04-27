<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id_product';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['photo_product', 'name_product', 'description_product', 'rating_product', 'price_product', 'stock_product', 'order_count_product', 'status_product', 'id_category'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    function getAll() {
        $builder = $this->db->table('products');
        $builder->join('category', 'category.id_category = products.id_category');
        $builder->where('products.deleted_at', null); // Filter data yang belum dihapus secara logis
        $query = $builder->get();
        return $query->getResult();
    }
    
}