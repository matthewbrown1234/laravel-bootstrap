<?php

namespace App\Http\Requests;

class SortBy
{
    public function __construct(public string | null $col, public string | null $dir)
    {
    }
}
