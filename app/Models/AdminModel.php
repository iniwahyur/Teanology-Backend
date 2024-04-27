<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $returnType       = 'object';
    protected $allowedFields    = ['photo_admin', 'name_admin', 'email_admin', 'password_admin', 'role_admin'];
    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
}