<?php

namespace Belenka\TikTok\Requests;

use Illuminate\Http\Client\PendingRequest;
use Belenka\TikTok\Enums\EventSource;
use Belenka\TikTok\Models\Event;

class EventRequest
{
    public $event_source;

    /**
     * Pixel Code
     */
    public $event_source_id;

    public $http;

    public $test_event_code = null;

    public function __construct(PendingRequest $http)
    {
        $this->http = $http;
    }

    public function setPixelCode($code)
    {
        $this->event_source_id = $code;

        return $this;
    }

    public function setEventSource(EventSource $eventSource)
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
     * @param  Event|Event[]  $events
     * @return array
     * @throws \Exception
     */
    public function execute($events)
    {
        $events = is_array($events) ? $events : [$events];
        foreach ($events as $key => $event) {
            $events[$key] = $event->toArray();
        }

        $request = $this->http->post('/event/track/', [
            'event_source' => $this->event_source->value,
            'event_source_id' => $this->event_source_id,
            'test_event_code' => $this->test_event_code,
            'data' => $events,
        ]);

        $request->onError(function ($request) {
            throw new \Exception($request->json('message'));
        });

        return $request->json();
    }
}
