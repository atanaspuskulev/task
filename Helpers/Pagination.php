<?php

namespace App\Helpers;

class Pagination
{
    public static function updateQueryString($page)
    {
        $_GET['page'] = $page;

        return '?' . http_build_query($_GET);
    }
}