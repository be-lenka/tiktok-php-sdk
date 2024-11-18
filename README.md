# TikTok Events API PHP Wrapper

## Requirements

- PHP 7.4 and later.

## Installation

```composer
composer require be-lenka/tiktok-php-sdk
```

## Usage

```php
$tiktok = new \Belenka\TikTok\TikTok($token, $pixelId);

$user = new \Belenka\TikTok\Models\User();
$user->setUserAgent($_SERVER['HTTP_USER_AGENT'])
     ->setIpAddress($_SERVER['REMOTE_ADDR'])
     ->setEmails(['name@example.com']) // optional`
     ->setPhones(['+421901123456']) // optional
     ->setClickId($_REQUEST['ttclid']) // if available
     ->setCookieId($_COOKIE['ttp'])
     ->setExternalIds(['user-id-in-our-system']); // optional
     
$page = new \Belenka\TikTok\Models\Page();
$page->setUrl('https://example.com')
     ->setReferrer('https://example.com'); // optional
           
// Set products
$contents = [];
$order->items->map(function ($item) use (&$contents) {
    $contents[] = (new \Belenka\TikTok\Models\Content)
        ->setPrice($item->price)
        ->setQuantity($item->quantity)
        ->setContentId($item->product_id)
        ->setContentName($item->item_title);
});

$properties = new \Belenka\TikTok\Models\Property();
$properties->setCurrency('USD')
           ->setQuery('COUPON_CODE')
           ->setValue(100.99)
           ->setOrderId('order_id')
           ->setContents($contents)

$eventA = new \Belenka\TikTok\Models\Event();
$eventA->setEventName(\Belenka\TikTok\Enums\EventName::COMPLETE_PAYMENT)
       ->setEventTime(time())
       ->setEventId($order->uuid)
       ->setUser($value)
       ->setPage($page)
       ->setProperties($properties)
       ->setUser($value);

$eventB = new \Belenka\TikTok\Models\Event();
$eventB->setEventName(\Belenka\TikTok\Enums\EventName::PLACE_AN_ORDER)
       ->setEventTime(time())
       ->setEventId($order->uuid)
       ->setUser($value)
       ->setPage($page)
       ->setProperties($properties)
       ->setUser($value);
```

### Start event request

```php
$eventRequest = $tiktok->events()
            ->setEventSource(\Belenka\TikTok\Enums\EventSource::WEB)
            ->setTestEventCode($testCode); // optional 
```

### Sending a single event

```php
$eventRequest->execute($eventA);
```

### Batching multiple events in a single payload

You can report up to 1000 objects in one request.
If a request contains more than 1,000 events, the entire request will be rejected.

```php
$eventRequest->execute([$eventA, $eventB]);
```

> To optimize campaign performance, it's highly recommended to send the event in real-time (without batching) as soon as
> it is seen on the advertiser's server.