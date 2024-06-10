<?php
declare(strict_types=1);

namespace App\Tests\Support\Helper\Recruitis;

use Codeception\Stub;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class TestHttpClient implements ClientInterface
{
    public static string $VALID_APIKEY = 'test-api';
    public static int $VALID_JOBS_COUNT = 10;
    public static int $INVALID_PAGE = 8;


    public function request(string $method, $uri, array $options = []): ResponseInterface
    {
        $bearer = $options['headers']['Authorization'] ?? '';

        if ($bearer !== 'Bearer ' . self::$VALID_APIKEY) {
            return $this->getUnauthorizedResponse();
        }

        if ($options[RequestOptions::QUERY]['page'] === self::$INVALID_PAGE) {
            return $this->getEmptyPageResponse();
        }

        return $this->getValidResponse();


    }


    private function getUnauthorizedResponse(): ResponseInterface
    {
        $response = new Response(SymfonyResponse::HTTP_UNAUTHORIZED, [], 'Unauthorized');
        throw new ClientException('Unauthorized', Stub::make(Request::class), $response);
    }

    private function getEmptyPageResponse(): ResponseInterface
    {
        $body = $this->getResponseBody('jobsNotFound');
        return new Response(SymfonyResponse::HTTP_NOT_FOUND, [], $body);
    }

    private function getValidResponse(): ResponseInterface
    {
        $body = $this->getResponseBody('first10Jobs');
        return new Response(SymfonyResponse::HTTP_OK, [], $body);
    }

    private function getResponseBody(string $filename): string
    {
        return file_get_contents(realpath(__DIR__ . '/../../Data/recruitis/client/' . $filename . '.json'));
    }


    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        throw new Exception('Not implemented');
    }

    public function sendAsync(RequestInterface $request, array $options = []): PromiseInterface
    {
        throw new Exception('Not implemented');
    }

    public function requestAsync(string $method, $uri, array $options = []): PromiseInterface
    {
        throw new Exception('Not implemented');
    }

    public function getConfig(string $option = null)
    {
        throw new Exception('Not implemented');
    }
}
