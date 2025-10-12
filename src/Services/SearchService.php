<?php

namespace API\Platform\Services;

use API\Platform\Models\Search;

class SearchService
{
    public function search(string $searchTerm, string $tableType = 'table_name'): array
    {
        if (empty(trim($searchTerm))) {
            throw new \InvalidArgumentException("Search parameter 'q' is required");
        }


        $results = Search::search(trim($searchTerm), $tableType);
        
        if (empty($results)) {
            throw new \RuntimeException("0 records found", 404);
        }

        return $results;
    }
}