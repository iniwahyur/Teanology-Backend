<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order';
    protected $primaryKey       = 'id_order';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_cart', 'total_price_order', 'method_payment_order', 'status_payment_order', 'address_shipping_order'];
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;

    function getAll()
    {
        $builder = $this->db->table('order');
        $builder->join('cart', 'cart.id_cart = order.id_cart');
        // Menambahkan kondisi where untuk mengecualikan data yang dihapus secara lembut
        $builder->where('order.deleted_at', null);
        $query = $builder->get();
        return $query->getResult();
    }
}
