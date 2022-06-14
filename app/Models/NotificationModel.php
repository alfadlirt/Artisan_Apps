<?php

namespace APP\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'cst_id', 
        'role', 
        'msg',
        'status',
        'created_date', 
        'created_by'
    ];
    
}
