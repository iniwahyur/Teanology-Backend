<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id_customer';
    protected $returnType       = 'object';
    protected $allowedFields    = ['photo_customer', 'first_name_customer', 'last_name_customer', 'email_customer', 'password_customer', 'phone_customer', 'birthdate_customer'];
    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}