<?php

namespace Belenka\TikTok\Requests;

use Belenka\TikTok\Models\Event;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp;

class EventRequest
{
    public $event_source;

    public $event_source_id;

    public $http;

    public $test_event_code = null;

    private $response_http_code = null;
    private $response_code = null;
    private $response_body = null;
    private $response_message = null;

    public function __construct($http)
    {
        $this->http = $http;
    }

    public function setPixelCode($code)
    {
        $this->event_source_id = $code;

        return $this;
    }

    public function setEventSource($eventSource)
    {
        $this->event_source = $eventSource;

        return $this;
    }

    public function setTestEventCode($testCode)
    {
        $this->test_event_code = $testCode;

        return $this;
    }

    /**
     * Execute the request with the given events.
     * 
     * @param  Event|Event[]  $events
     * @return stdClass
     * @throws \ClientException
     */
    public function execute($events)
    {
        $events = is_array($events) ? $events : [$events];
        foreach ($events as $key => $event) {
            $events[$key] = $event->toArray();
        }

        try {
            $body = [
                'event_source' => $this->event_source,
                'event_source_id' => $this->event_source_id,
                'data' => $events,
            ];

            if (!empty($this->test_event_code)) {
                $body['test_event_code'] = $this->test_event_code;
            }

            $response = $this->http->post('/open_api/v1.3/event/track/', [
                GuzzleHttp\RequestOptions::JSON => $body
            ]);
        } catch (ClientException $e) {
            throw $e;
        }

        $this->response_http_code = $response->getStatusCode();

        if ($this->response_http_code != 200) {
            throw new \Exception('Error: ' . $response->getBody());
        }

        $this->response_body = json_decode($response->getBody());
        $this->response_code = $this->response_body->code;
        $this->response_message = $this->response_body->message;

        return $this->response_body;
    }

    public function isSuccessful()
    {
        return $this->response_code == 0 && $this->response_http_code == 200 && $this->response_message == 'OK';
    }

    public function getResponseCode()
    {
        return $this->response_code;
    }

    public function getResponseMessage()
    {
        return $this->response_message;
    }

    public function getResponseHttpCode()
    {
        return $this->response_http_code;
    }

    public function getResponseBody()
    {
        return $this->response_body;
    }
}
