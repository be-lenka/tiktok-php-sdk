<?php

namespace Belenka\TikTok\Support;

use function GuzzleHttp\choose_handler;
use \GuzzleHttp\Client as HttpClientGuzzle;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class HttpClient
{
    const API_BASE_URL = 'https://business-api.tiktok.com';
    const HTTP_CLIENT_OPT = 'http_client';

    public static function http($token, $options = [])
    {
        return new HttpClientGuzzle(
            [
                'base_uri' => static::API_BASE_URL,
                'handler' => static::createHandler(
                    isset($options[self::HTTP_CLIENT_OPT]) ? $options[self::HTTP_CLIENT_OPT]['handler'] ?? null : null
                ),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Access-Token' => $token,
                ],
            ] + ($options[self::HTTP_CLIENT_OPT] ?? [])
        );
    }

    /**
     * Create Guzzle requests handler with Exponea-specific middlewares
     * @param callable|null $handler
     * @return HandlerStack
     */
    protected static function createHandler(callable $handler = null): HandlerStack
    {
        $handler = new HandlerStack($handler ?: choose_handler());

        // Basic response verifications
        $handler->push(Middleware::httpErrors(), 'http_errors');
        $handler->push(Middleware::redirect(), 'allow_redirects');
        $handler->push(Middleware::prepareBody(), 'prepare_body');

        return $handler;
    }
}
