<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis;

use App\Integrations\Recruitis\Model\Jobs\JobCollection;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class Client
{
    public static string $BASE_URL = 'https://app.recruitis.io/api2/';
    private static int $CACHE_EXPIRE = 60;

    public function __construct(private readonly string $apiToken, private readonly ClientInterface $httpClient, private readonly SerializerInterface $serializer, private readonly CacheInterface $cache)
    {
    }

    public function getAllJobs($page = 1, $limit = 10): JobCollection
    {
        $response = $this->get('jobs', ['page' => $page, 'limit' => $limit]);

        return $this->serializer->deserialize($response, JobCollection::class, 'json');
    }




    private function get(string $path, array $query): string
    {
        return $this->getCachedResult('GET', $path, [RequestOptions::QUERY => $query]);
    }

    private function getCachedResult(string $method, string $path, array $config): string
    {
        $cacheKey = $this->getCacheKey($method, $path, $config);

        return $this->cache->get (
            $cacheKey, function (CacheItemInterface $cacheItem) use ($method, $path, $config) {
                $cacheItem->expiresAfter(self::$CACHE_EXPIRE);
                return $this->sendRequest($method, $path, $config);
            }
        );
    }

    private function sendRequest(string $method, string $path, array $config): string
    {
        $config['headers'] = $this->getRequestHeaders();

        try {
            $response = $this->httpClient->request($method, self::$BASE_URL . $path, $config);
        } catch (GuzzleException $e) {
            throw ClientException::createFromHttpCode($e->getCode(), $e->getMessage());
        }

        return $response->getBody()->getContents();
    }


    private function getCacheKey(string $method, string $path, array $config): string
    {
        return sha1(self::$BASE_URL . $path . $method . serialize($config));
    }

    private function getRequestHeaders(): array
    {
        return ['Authorization' => 'Bearer ' . $this->apiToken];
    }
}
