<?php

namespace APP\Models;

use CodeIgniter\Model;

class PowerupModel extends Model
{
    protected $table = 'lst_powerup';
    protected $primaryKey = 'powerup_token';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'powerup_token',
        'type', 
        'pts', 
        'link', 
        'is_registered',
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
