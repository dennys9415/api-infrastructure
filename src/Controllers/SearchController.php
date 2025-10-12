<?php

namespace API\Platform\Controllers;

use API\Platform\Services\SearchService;
use API\Platform\Utils\ResponseHandler;

class SearchController
{
    public function handleSearch($tableType = 'table_name')
    {
        $searchTerm = $_GET['q'] ?? '';

        try {
            $results = (new SearchService())->search($searchTerm, $tableType);
            ResponseHandler::success(
                count($results) . " records found", 
                ['results' => $results]
            );
        } catch (\InvalidArgumentException $e) {
            ResponseHandler::error(400, $e->getMessage());
        } catch (\RuntimeException $e) {
            ResponseHandler::error($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            ResponseHandler::error(500, "Database error: " . $e->getMessage());
        }
    }
}