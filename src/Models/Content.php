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
        $this->content_id = $value;

        return $this;
    }

    public function setContentName($value)
    {
        $this->content_name = $value;

        return $this;
    }

    public function setContentCategory($value)
    {
        $this->content_category = $value;

        return $this;
    }

    public function setBrand($value)
    {
        $this->brand = $value;

        return $this;
    }
}
