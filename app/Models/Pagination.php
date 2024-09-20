<?php

namespace App\Models;

class Pagination
{

    public static function button($full, $limit, $offset)
    {
        $data = range(1, $full);
        $count_page = ceil($full / $limit);
        $page = $offset === 0 ? 1 : $offset-9;
        $page = (int)$page;

        $start = ($page - 1) * $limit;

        return var_dump(array_slice($data, $start, $limit));
    }
    
}