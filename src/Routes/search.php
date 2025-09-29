<?php

use GivingGap\Platform\Controllers\SearchController;

$router->map('GET', '/search', function () {
    (new SearchController())->handleSearch('table_name');
});
