<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

abstract class ApiController extends Controller
{
    protected function respond($data, int $status = 200)
    {
        return response()->json($data, $status);
    }
}
