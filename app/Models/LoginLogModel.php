<?php

namespace APP\Models;

use CodeIgniter\Model;

class LoginLogModel extends Model
{
    protected $table = 'login_log';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'login_date', 
        'client', 
        'cst_id'
    ];
    
}
