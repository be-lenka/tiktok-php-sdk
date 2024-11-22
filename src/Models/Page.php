<?php

namespace Belenka\TikTok\Models;

class Page extends Model
{
    /**
     * The browser URL where the event happened, for example, the value of `location.href` in the client side Javascript.
     * It is recommended to use the full URL, including all URL parameters.
     *
     * @var string|null
     */
    public $url = null;

    /**
     * The referrer URL.
     * For example, `document.referrer` in the client side Javascript, or the server side Referer http header.
     * It is recommended to use the full URL, including all URL parameters.
     *
     * @var string|null
     */
    public $referrer = null;

    public function setUrl($value)
    {
        $this->url = strval($value);

        return $this;
    }

    public function setReferrer($value)
    {
        $this->referrer = strval($value);

        return $this;
    }
}
