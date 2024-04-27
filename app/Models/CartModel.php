<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'cart';
    protected $primaryKey       = 'id_cart';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_customer', 'id_product', 'quantity_cart'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    function getAll()
    {
        $builder = $this->db->table('cart');
        $builder->join('customers', 'customers.id_customer = cart.id_customer');
        $builder->join('products', 'products.id_product = cart.id_product');
        $builder->where('cart.deleted_at', null);
        $query = $builder->get();
        return $query->getResult();
    }
}
