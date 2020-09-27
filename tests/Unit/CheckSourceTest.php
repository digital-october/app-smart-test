<?php

namespace Tests\Unit;

use App\Source\Openfoodfacts\OpenfoodfactsSource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class CheckSourceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @throws \App\Exceptions\OpenFoodsFacts\OopsException
     */
    public function testExample()
    {
//        $parameters = [
//            'action' => 'process',
//            'sort_by' => 'unique_scans_n',
//            'json' => 1,
//            'page' => random_int(10,50),
//        ];
//
//        $data = OpenfoodfactsSource::get($parameters);
//        dd($data);
        $this->assertTrue(true);
    }
}
