<?php

namespace Belenka\TikTok;

use Illuminate\Http\Client\PendingRequest;
use Belenka\TikTok\Requests\EventRequest;
use Belenka\TikTok\Support\HttpClient;

/**
 * Class TikTok
 * 
 * 
 * 
 * @package Belenka\TikTok
 * @property string $accessToken
 * @property string $pixelId
 * @property PendingRequest $http
 * @property EventRequest $events
 * @method EventRequest events()
 */
class TikTok
{
    private $http;

    public $accessToken;
    public $pixelId;

    public function __construct($accessToken, $pixelId)
    {
        $this->accessToken = $accessToken;
        $this->pixelId = $pixelId;
        $this->http = HttpClient::http($this->accessToken);
    }

    public function events(): EventRequest
    {
        return (new EventRequest($this->http))->setPixelCode($this->pixelId);
    }
}
