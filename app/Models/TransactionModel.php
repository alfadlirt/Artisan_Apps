<?php

namespace APP\Models;

use CodeIgniter\Model;

class TranscationModel extends Model
{
    protected $table = 'transaction_shop';
    protected $primaryKey = 'trs_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'cst_id', 
        'adr_id', 
        'total_paid_price',
        'status',
        'created_date', 
        'created_by'
    ];
    
}
