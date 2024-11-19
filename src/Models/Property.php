<?php

namespace Belenka\TikTok\Models;

class Property extends Model
{
    /**
     * @var Content[]
     */
    public $contents;

    public $content_type = '';
    public $currency = '';
    public $value = null;

    public $query = '';
    public $description = '';
    public $order_id = '';
    public $shop_id = '';

    /**
     * @param  Content[]  $value
     * @return $this
     */
    public function setContents(array $values)
    {
        $contents = [];
        // filter the array from empty values before assigning it to the property
        foreach($values as $value) {
            $contents[] = array_filter((array)$value);
        }

        $this->contents = $contents;

        return $this;
    }

    public function setContentType($value)
    {
        $this->content_type = $value ?? '';

        return $this;
    }

    public function setCurrency($value)
    {
        $this->currency = $value ?? '';

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value ?? '';

        return $this;
    }

    public function setQuery($value)
    {
        $this->query = $value ?? '';

        return $this;
    }

    public function setDescription($value)
    {
        $this->description = $value ?? '';

        return $this;
    }

    public function setOrderId($value)
    {
        $this->order_id = $value ?? '';

        return $this;
    }

    public function setShopId($value)
    {
        $this->shop_id = $value ?? '';

        return $this;
    }
}
