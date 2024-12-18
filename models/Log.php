<?php

namespace App\Models;

use App\Models\CRUD;

class Log extends CRUD
{
    protected $table = 'tp2_mvc.logs';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'username', 'ip_address', 'visited_page', 'visit_date'];
}