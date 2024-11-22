<?php

namespace Belenka\TikTok\Models;

class Content extends Model
{
    public $price;
    public $quantity;
    public $content_id;
    public $content_name;
    public $content_category;
    public $brand;

    public function setPrice($value)
    {
        $this->price = $value;

        return $this;
    }

    public function setQuantity($value)
    {
        $this->quantity = $value;

        return $this;
    }

    public function setContentId($value)
    {
        $this->content_id = strval($value);

        return $this;
    }

    public function setContentName($value)
    {
        $this->content_name = strval($value);

        return $this;
    }

    public function setContentCategory($value)
    {
        $this->content_category = strval($value);

        return $this;
    }

    public function setBrand($value)
    {
        $this->brand = strval($value);

        return $this;
    }
}
