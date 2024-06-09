<?php
declare(strict_types=1);

namespace App\Integrations\Recruitis;

/**
 * This could be split into separate child classes, if it would be handled differently.
 * For this time there is just one handle - show the erorr message to the user.
 */
class ClientException extends \Exception
{
    public static int $CODE_TIMEOUT = 408;
    public static int $CODE_NOT_FOUND = 404;
    public static int $CODE_UNAUTHORIZED = 401;

    public static function createFromHttpCode(int $httpCode, string $fallbackMessage): ClientException
    {
        return match($httpCode) {
            404 => self::createNotFound(),
            401 => self::createUnauthorized(),
            408 => self::createTimeout(),
            default => new self($fallbackMessage, $httpCode),
        };
    }

    public static function createTimeout(): ClientException
    {
        return new self('Request timeout', self::$CODE_TIMEOUT);
    }

    public static function createNotFound(): ClientException
    {
        return new self('Resource not found', self::$CODE_NOT_FOUND);
    }

    public static function createUnauthorized(): ClientException
    {
        return new self('Unauthorized', self::$CODE_UNAUTHORIZED);
    }
}
