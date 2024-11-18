<?php

namespace Belenka\TikTok\Models;

use Belenka\TikTok\Enums\EventName;

class Event extends Model
{
    public $event;
    public $event_time;
    public $event_id;

    public $user = null;
    public $properties;
    public $page = null;

    public function setEventName(EventName $value)
    {
        $this->event = $value;

        return $this;
    }

    public function setEventTime($value)
    {
        $this->event_time = $value;

        return $this;
    }

    public function setEventId($value)
    {
        $this->event_id = $value;

        return $this;
    }

    public function setUser(User $value)
    {
        $this->user = $value;

        return $this;
    }

    public function setProperties(Property $value)
    {
        $this->properties = $value;

        return $this;
    }

    public function setPage(Page $value)
    {
        $this->page = $value;

        return $this;
    }
}
