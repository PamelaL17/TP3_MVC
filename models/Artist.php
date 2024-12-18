<?php 

namespace App\Models;

use App\Models\CRUD;

class Artist extends CRUD
{
    protected $table = 'tp2_mvc.artists';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'biography'];

}