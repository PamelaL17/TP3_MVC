<?php
namespace App\Models;
use App\Models\CRUD;

class Privilege extends CRUD{
    protected $table = "tp2_mvc.privilege";
    protected $primaryKey = "id";
}