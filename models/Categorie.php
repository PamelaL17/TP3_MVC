<?php

namespace App\Models;

use App\Models\CRUD;

class Categorie extends CRUD
{
    protected $table = 'tp2_mvc.categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

}