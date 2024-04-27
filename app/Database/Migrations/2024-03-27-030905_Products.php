<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_product' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'photo_product' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, 
            ],
            'name_product' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_category' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'description_product' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'rating_product' => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
            ],
            'added_date_product' => [
                'type'       => 'DATE',
            ],
            'price_product' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'stock_product' => [
                'type'       => 'INT',
                'constraint' => 20,
            ],
            'order_count_product' => [
                'type'       => 'INT',
                'constraint' => 20,
                'default'    => 0,
            ],
            'status_product' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'out_of_stock'],
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_product', true);
        $this->forge->addForeignKey('id_category', 'category', 'id_category');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropForeignKey('products', 'products_id_category_foreign');
        $this->forge->dropTable('products');
    }
}
