<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppProductController extends Controller
{
    protected $name;
    protected $cost;

    public function __construct($name = null, $cost = null)
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

    public function costumerService()
    {
        request()->validate([
            "name" => "required",
            "email" => "required|email",
            "question" => "required",
            "verification" => "required|in:5,five",
        ]);

        return response()->json(["status" => "success", "item" => request()], 200);
    }
}
