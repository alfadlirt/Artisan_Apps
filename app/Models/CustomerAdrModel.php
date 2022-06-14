<?php

namespace APP\Models;

use CodeIgniter\Model;

class CustomerAdrModel extends Model
{
    protected $table = 'customer_address';
    protected $primaryKey = 'adr_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'cst_id', 
        'receipent', 
        'telp', 
        'notes', 
        'is_main',
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
