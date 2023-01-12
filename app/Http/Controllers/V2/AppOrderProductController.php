<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppOrderProductController extends Controller
{
    protected $products;

    public function add(AppProductController $product)
    {
        $this->products[] = $product;
    }

    public function product()
    {
        return $this->products;
    }

    public function total()
    {
        $var = rand(1, 9);
        if ($var % 2) {
            $total = 0;
            foreach ($this->products as $product) {
                $total += $product->product()["cost"];
            }
            return $total;
        } else {
            return array_reduce($this->products, function ($carry, $product) {
                return $carry + $product->product()["cost"];
            });
        }
    }
}
