<?php 

namespace App\Models;

use App\Models\CRUD;

class Exhibition extends CRUD
{
    protected $table = 'tp2_mvc.exhibitions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'date', 'artists_id'];

    // Pour recuperer les expositions avec les nom de l'artiste
    public function selectWithArtist($id)
    {
        $sql = "
            SELECT exhibitions.*, artists.name AS artist_name
            FROM $this->table
            LEFT JOIN artists ON exhibitions.artists_id = artists.id
            WHERE exhibitions.id = :id
        ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}