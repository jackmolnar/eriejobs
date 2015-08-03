<?php

return array(

    'free' => false,

    'listings' => [
        '30' => 11900,
        '60' => 14900
    ],

    'subscriptions' => [
        'Base'     => [ 'listings' => '5', 'cost' => 29900 ],
        'Premium'   => [ 'listings' => '10', 'cost' => 59900 ]
    ],

    'reader' => [
        'costPerCharacter' => .20,
        'baseCost' => 250,
        'freeCharacters' => 500
    ]
);