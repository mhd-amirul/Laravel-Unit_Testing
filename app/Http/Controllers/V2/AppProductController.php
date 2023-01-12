<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppProductController extends Controller
{
    protected $name;
    protected $cost;

    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function product()
    {
        return [
            "name" => $this->name,
            "cost" => $this->cost,
        ];
    }
}
