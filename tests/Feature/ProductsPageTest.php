<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsPageTest extends TestCase
{
    /**
     * A basic products page test.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get(route('products.index', [], false));

        $response->assertStatus(200);
    }

    /**
     * A failed products page.
     *
     * @return void
     */
    public function testFailedTest()
    {
        $response = $this->post(route('products.index', [], false));

        $response->assertStatus(302);
    }

    /**
     * Search of products test.
     *
     * @return void
     */
    public function testSearchProductsTest()
    {
        $response = $this->get(route('products.index', [
            'search_terms' => 'Cheese'
        ], false));

        $response->assertStatus(200);
    }

    /**
     * Pagination result of product's search test.
     *
     * @return void
     */
    public function testPaginationProductsTest()
    {
        $response = $this->get(route('products.index', [
            'search_terms' => 'Cheese',
            'page' => 5,
        ], false));

        $response->assertStatus(200);
    }

    /**
     * Save product in DB test.
     *
     * @return void
     */
    public function testSaveProductTest()
    {
        $response = $this->post(route('products.store', [], false), [
            '_id' => 777,
            'product_name' => 'Test',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /**
     * Validation failed save product in DB test.
     *
     * @return void
     */
    public function testValidationFailedSaveProductTest()
    {
        $response = $this->post(route('products.store', [], false), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }


}
