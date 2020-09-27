<?php


namespace App\Source\Openfoodfacts;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

use App\Models\Product;
use App\Exceptions\OpenFoodsFacts\OopsException;

final class OpenfoodfactsSource
{
    /**
     * Prefix to data from Redis.
     */
    private const REDIS_PREFIX = 'food_facts_';

    /**
     * Data retention time in Redis.
     * (10 minutes)
     */
    private const REDIS_TIMEOUT = 10 * 60;

    /**
     * Data source.
     */
    private const URL = 'https://world.openfoodfacts.org/cgi/search.pl';


    /**
     * Query the source data.
     *
     * @param array $parameters
     * @return array|mixed
     * @throws OopsException
     */
    public static function get(array $parameters)
    {
        try {
            $redisKey = self::REDIS_PREFIX . implode('_', $parameters);
            $redisResult = Redis::get($redisKey);

            if (!empty($redisResult)) {
                return json_decode($redisResult, true);
            }

            $client = new GuzzleClient();
            $response = $client->request('GET', self::URL, [
                'query' => $parameters,
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => false
            ])->getBody()->getContents();

            $handler = new Handler($response);
            $result = $handler->getContents();

            if (!empty($result)) {
                Redis::set($redisKey, json_encode($result));
                Redis::expire($redisKey, self::REDIS_TIMEOUT);
            }

            return $result;
        } catch (\Throwable $exception) {
            Log::error($exception);

            throw new OopsException($exception->getMessage());
        }
    }

    /**
     * Checks if these products are in the database.
     *
     * @param array $products
     * @return array
     */
    public static function checkExists(array $products): array
    {
        $saved = Product::whereIntegerInRaw('_id', collect($products)->pluck('_id'))->get();

        foreach ($saved as $item) {
            foreach ($products as $key => $product) {
                if ($item->_id === (int)$product['_id']) {
                    $products[$key]['saved'] = true;
                }
            }
        }

        return $products;
    }
}
