<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis;

use App\Integrations\Recruitis\DataObject\Jobs\JobCollection;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Symfony\Component\Serializer\SerializerInterface;

class Client
{
    public static string $BASE_URL = 'https://app.recruitis.io/api2/';

    public function __construct(private readonly string $apiToken, private readonly ClientInterface $httpClient, private readonly SerializerInterface $serializer)
    {
    }

    public function getAllJobs($page = 0, $limit = 10): JobCollection
    {
        $response = $this->get('jobs', ['page' => $page, 'limit' => $limit]);

        return $this->serializer->deserialize($response, JobCollection::class, 'json');
    }

    private function get(string $path, array $query): string
    {
        return $this->sendRequest('GET', $path, [RequestOptions::QUERY => $query]);
    }

    private function sendRequest(string $method, string $path, array $config): string
    {
        $config['headers'] = $this->getRequestHeaders();

        $response = $this->httpClient->request($method, self::$BASE_URL . $path, $config);
        return $response->getBody()->getContents();
    }

    private function getRequestHeaders(): array
    {
        return ['Authorization' => 'Bearer ' . $this->apiToken];
    }
}
