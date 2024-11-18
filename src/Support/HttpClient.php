<?php

namespace Belenka\TikTok\Support;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class HttpClient
{
    const API_BASE_URL = 'https://business-api.tiktok.com/open_api/v1.3';

    public static function http($token): PendingRequest
    {
        return Http::baseUrl(static::API_BASE_URL)
            ->withHeader('Access-Token', $token)
            ->asJson();
    }
}
