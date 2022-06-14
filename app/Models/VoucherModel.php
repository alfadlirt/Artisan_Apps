<?php

namespace APP\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'voucher';
    protected $primaryKey = 'vcr_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'vcr_code', 
        'vcr_name', 
        'expired_date_start', 
        'expired_date_end', 
        'discount', 
        'status', 
        'created_date', 
        'created_by',
        'modified_date', 
        'modified_by'
    ];
    
}
