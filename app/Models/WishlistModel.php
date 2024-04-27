<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table            = 'wishlist';
    protected $primaryKey       = 'id_wishlist';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_customer', 'id_product'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    function getAll() {
        $builder = $this->db->table('wishlist');
        $builder->join('customers', 'customers.id_customer = wishlist.id_customer');
        $builder->join('products', 'products.id_product = wishlist.id_product');
        $query = $builder->get();
        return $query->getResult();
    }
}