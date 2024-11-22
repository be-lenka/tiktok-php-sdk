<?php

namespace Belenka\TikTok\Models;

class User extends Model
{
    /**
     * TikTok Click ID
     */
    public $ttclid = '';

    /**
     * Cookie ID (_ttp).
     */
    public $ttp = '';
    public $ip = '';
    public $user_agent = '';

    public $email;
    public $phone;
    public $external_id;

    public function setClickId($ttclid = null)
    {
        $this->ttclid = $ttclid ?? '';

        return $this;
    }

    public function setCookieId($ttp = null)
    {
        $this->ttp = $ttp ?? '';

        return $this;
    }

    public function setIpAddress($ip = null)
    {
        $this->ip = strval($ip ?? '');

        return $this;
    }

    public function setUserAgent($userAgent = null)
    {
        $this->user_agent = strval($userAgent ?? '');

        return $this;
    }

    public function setEmails(array $emails)
    {
        $this->email = $this->hashArrayValue($emails);

        return $this;
    }

    public function setPhones(array $phones)
    {
        $this->phone = $this->hashArrayValue($phones);

        return $this;
    }

    public function setExternalIds(array $ids)
    {
        $this->external_id = $this->hashArrayValue($ids);

        return $this;
    }
}
