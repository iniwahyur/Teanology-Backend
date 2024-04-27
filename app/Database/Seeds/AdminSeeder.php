<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class adminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name_admin' => 'Rafi',
                'email_admin' => 'rafi@gmail.com',
                'password_admin' => password_hash('rafi1234', PASSWORD_BCRYPT),
            ],
            [
                'name_admin' => 'Wahyu',
                'email_admin' => 'wahyu@gmail.com',
                'password_admin' => password_hash('wahyu1234', PASSWORD_BCRYPT),
            ],
            [
                'name_admin' => 'Winasis',
                'email_admin' => 'winasis@gmail.com',
                'password_admin' => password_hash('winasis1234', PASSWORD_BCRYPT),
            ]
        ];
        $this->db->table('staff')->insertBatch($data);
    }
}
