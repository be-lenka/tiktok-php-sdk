<?php

require_once __DIR__ . '/../vendor/autoload.php';

function dd($data)
{
    print_r($data);
    die();
}

$tiktok = new \Belenka\TikTok\TikTok('<token>', '<pixelid>');

$_SERVER = [
    'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
    'REMOTE_ADDR' => '12.12.2.3',
];
$_REQUEST = [
    'ttclid' => '1234567890',
];
$_COOKIE = [
    'ttp' => '1234567890',
];

// Set user info
$user = new \Belenka\TikTok\Models\User();

$user->setUserAgent($_SERVER['HTTP_USER_AGENT'])
    ->setIpAddress($_SERVER['REMOTE_ADDR'])
    ->setEmails(['test@example.com']) // optional
    ->setPhones(['+421901123456']) // optional
    ->setClickId($_REQUEST['ttclid']) // if available
    ->setCookieId($_COOKIE['ttp'])
    ->setExternalIds(['123']) // optional
;

// Set page info
$page = new \Belenka\TikTok\Models\Page();
$page->setUrl('https://example.com')
    ->setReferrer('https://example.com') // optional
;

$contents = [];
$orderItems = [
    [
        'product_id' => '123',
        'item_title' => 'Product 1',
        'price' => 100.99,
        'quantity' => 1,
    ],
    [
        'product_id' => '124',
        'item_title' => 'Product 2',
        'price' => 200.99,
        'quantity' => 2,
    ],
]; // your order items list
foreach ($orderItems as $item) {
    $contents[] = (new \Belenka\TikTok\Models\Content)
        ->setPrice($item['price'])
        ->setQuantity($item['quantity'])
        ->setContentId($item['product_id'])
        ->setContentName($item['item_title']);
}

$properties = new \Belenka\TikTok\Models\Property();
$properties->setCurrency('USD')
    ->setQuery('COUPON_CODE')
    ->setValue(array_sum(array_map(function ($item) {
        return $item->price * $item->quantity;
    }, $contents)))
    ->setOrderId('order_id')
    ->setContents($contents)
;

$eventA = new \Belenka\TikTok\Models\Event();
$eventA->setEventName(\Belenka\TikTok\Enums\EventName::PLACE_AN_ORDER)
    ->setEventTime(time())
    ->setEventId(time())
    ->setUser($user)
    ->setPage($page)
    ->setProperties($properties)
;

$eventRequest = $tiktok->events()
    ->setEventSource(\Belenka\TikTok\Enums\EventSource::WEB);

try {
    $eventRequest->execute($eventA);

    if ($eventRequest->isSuccessful()) {
        echo "Result: Success\n";
        echo "Event sent successfully\n";
    }

    echo "\nResponse:\n";
    dd($eventRequest->getResponseBody());
} catch (\Exception $e) {
    echo "Result: Failed\n";
    echo "Error: " . $e->getMessage() . "\n";
}