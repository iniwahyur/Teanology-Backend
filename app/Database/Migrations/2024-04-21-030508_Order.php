<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_cart' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'total_price_order' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'method_payment_order' => [
                'type'       => 'ENUM',
                'constraint' => ['mastercard', 'visa', 'paypal', 'credit_card', 'payoneer'],
            ],
            'status_payment_order' => [
                'type'       => 'ENUM',
                'constraint' => ['paid', 'awaiting_authorization', 'payment_failed', 'cash_on_delivery', 'fulfilled', 'unfulfilled'],
            ],
            'address_shipping_order' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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

        $this->forge->addKey('id_order', true);
        $this->forge->addForeignKey('id_cart', 'cart', 'id_cart', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropForeignKey('order', 'order_id_cart_foreign');
        $this->forge->dropTable('order');
    }
}
