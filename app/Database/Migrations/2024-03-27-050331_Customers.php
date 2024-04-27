<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone_customer' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'birthdate_customer' => [
                'type'       => 'DATE', 
            ],
            'role_customer' => [
                'type'       => 'ENUM', 
                'constraint' => ['customer'], 
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
        $this->forge->addKey('id_customer', true);
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
