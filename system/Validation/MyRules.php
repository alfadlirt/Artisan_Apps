<?php

namespace CodeIgniter\Validation;

class MyRules
{
    public function valid_ddl(string $str, ?string &$error = null): bool
    {
        $error = 'Selection is required';
        return $str == '0' ? FALSE : TRUE;
    }
}