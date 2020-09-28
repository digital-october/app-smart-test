<?php


namespace App\Source\Openfoodfacts;

use GuzzleHttp\Client;
use Psr\SimpleCache\CacheInterface;

use App\Exceptions\OpenFoodsFacts\OopsException;

final class OpenfoodfactsSource
{
    /**
     * Data retention time in Redis.
     * (10 minutes)
     */
    private const REDIS_TIMEOUT = 10 * 60;

    /**
     * Data source.
     */
    private const URL = 'https://world.openfoodfacts.org/cgi/search.pl';

    private CacheInterface $cache;

    private Client $client;

    /**
     * OpenfoodfactsSource constructor.
     *
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->client = new Client();
    }

    /**
     * Query the source data.
     *
     * @param array $parameters
     * @return mixed
     * @throws OopsException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get(array $parameters)
    {
        try {
            $redisKey = implode('_', $parameters);
            $redisResult = $this->cache->get($redisKey);

            if (!empty($redisResult)) {
                return $redisResult;
            }

            $response = $this->client->request('GET', self::URL, [
                'query' => $parameters,
                'http_errors' => false,
                'verify' => false,
                'allow_redirects' => false
            ])->getBody()->getContents();

            $handler = new Handler($response);
            $result = $handler->getContents();

            if (!empty($result)) {
                $this->cache->set($redisKey, $result, self::REDIS_TIMEOUT);
            }

            return $result;
        } catch (\Throwable $exception) {
            throw new OopsException($exception);
        }
    }
}
