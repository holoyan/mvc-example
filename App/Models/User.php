<?php

namespace App\Models;

use Core\QueryBuilder;

class User extends QueryBuilder
{
    protected $table = 'users';

    public function getTable()
    {
        return $this->table;
    }

}