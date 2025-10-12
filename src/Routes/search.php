<?php

use API\Platform\Controllers\SearchController;

$router->map('GET', '/search', function () {
    (new SearchController())->handleSearch('table_name');
});
