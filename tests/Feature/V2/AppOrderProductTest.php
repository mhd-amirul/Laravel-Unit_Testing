<?php

namespace Tests\Feature\V2;

use App\Http\Controllers\V2\AppOrderProductController;
use App\Http\Controllers\V2\AppProductController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppOrderProductTest extends TestCase
{

    public function createOrder()
    {
        $order = new AppOrderProductController;

        $product1 = new AppProductController("Hunger Games", 70);
        $product2 = new AppProductController("Hunger Games 2", 90);

        $order->add($product1);
        $order->add($product2);

        return $order;
    }

    /** @test */
    public function is_there_product_in_order_list()
    {
        $order = $this->createOrder();

        $this->assertCount(2, $order->product());
    }

    /** @test */
    public function count_total_cost_product_from_order_list()
    {
        $order = $this->createOrder();

        $this->assertEquals(160, $order->total());
    }
}
