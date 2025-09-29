<?php

namespace GivingGap\Platform\Models;

use PDO;

class Search
{
    private static function getConnection(): PDO
    {
        return require dirname(__DIR__, 2) . '/src/Config/database.php';
    }

    public static function Search(string $searchTerm, string $tableType = 'table_name'): array
    {
        $searchTerm = strtolower($searchTerm);

        $conn = self::getConnection();
        
        // Determine which table to search
        $table = $tableType;
        
        
        // Base query for both tables
        $baseQuery = "
            SELECT *
        ";
        
        $query = $baseQuery . "
            FROM 
                $table
            WHERE 
                LOWER(so.name) LIKE :searchTerm
        ";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}