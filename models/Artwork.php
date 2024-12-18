<?php

namespace App\Models;

use App\Models\CRUD;

class Artwork extends CRUD
{
    protected $table = 'tp2_mvc.artworks';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'artists_id', 'category_id', 'image'];

    // Récupérer une œuvre par son ID PAS FONCTONNER **
    public static function findById($id) {
        $instance = new self();
        $sql = "SELECT * FROM " . $instance->table . " WHERE " . $instance->primaryKey . " = :id";

        $stmt = $instance->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Récupérer une œuvre avec sa catégorie
    public function selectWithCategory($id)
    {
        $sql = "
            SELECT artworks.*, categories.name AS category_name, artists.name AS artist_name
            FROM $this->table
            LEFT JOIN categories ON artworks.category_id = categories.id
            LEFT JOIN artists ON artworks.artists_id = artists.id
            WHERE artworks.id = :id
        ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
}