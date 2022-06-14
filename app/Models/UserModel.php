<?php

namespace APP\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'lst_user';
    protected $primaryKey = 'usr_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'usr_id',
        'f_name', 
        'l_name', 
        'telp', 
        'email', 
        'usrname',
        'pswrd', 
        'status', 
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
