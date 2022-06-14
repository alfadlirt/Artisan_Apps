<?php

namespace APP\Models;

use CodeIgniter\Model;

class NFTCatalogModel extends Model
{
    protected $table = 'lst_catalog_nft';
    protected $primaryKey = 'nft_catalog_id';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'nft_catalog_id',
        'nft_name',
        'slug',
        'link',
        'status',
        'photo',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by'
    ];
    
}
