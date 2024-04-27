<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Wishlist extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_wishlist' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_customer' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'id_product' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_wishlist', true);
        $this->forge->addForeignKey('id_customer', 'customers', 'id_customer', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'CASCADE', 'CASCADE');
        $this->forge->createTable('wishlist');
    }

    public function down()
    {
        $this->forge->dropForeignKey('wishlist', 'wishlist_id_customer_foreign');
        $this->forge->dropForeignKey('wishlist', 'wishlist_id_product_foreign');
        $this->forge->dropTable('wishlist');
    }
}
