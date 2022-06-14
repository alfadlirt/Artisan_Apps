<?php

namespace APP\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment_method';
    protected $primaryKey = 'pym_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'pym_name', 
        'pym_on_name', 
        'pym_number', 
        'status', 
        'created_date', 
        'created_by',
        'modified_date', 
        'modified_by'
    ];
    
}
