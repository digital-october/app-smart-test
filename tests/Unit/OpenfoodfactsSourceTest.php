<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Source\MockCache;
use App\Source\Openfoodfacts\OpenfoodfactsSource;

class OpenfoodfactsSourceTest extends TestCase
{

    protected $data;

    /**
     * @throws \App\Exceptions\OpenFoodsFacts\OopsException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function setUp(): void
    {
        $parameters = [
            'action' => 'process',
            'sort_by' => 'unique_scans_n',
            'json' => 1,
            'page' => random_int(10,50),
        ];

        $source = new OpenfoodfactsSource(new MockCache());
        $this->data = $source->get($parameters);
    }

    /**
     * Get correct data from source.
     *
     * @throws \App\Exceptions\OpenFoodsFacts\OopsException
     */
    public function testGet()
    {
        $this->assertIsArray($this->data);
        $this->assertIsArray($this->data['products']);
        $this->assertArrayHasKey('products', $this->data);
        $this->assertArrayHasKey('product_name', $this->data['products'][0]);
        $this->assertArrayHasKey('_id', $this->data['products'][0]);
        $this->assertArrayHasKey('saved', $this->data['products'][0]);
    }
}
