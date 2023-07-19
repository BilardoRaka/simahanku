<?php

    return [
        'apiKey' => env('IPAYMU_APIKEY',null),
        'va' => env('IPAYMU_VA',null),
        'staging' => env('IPAYMU_STAGING', true),
        'notifyURL' => env('IPAYMU_NOTIFY_URL', 'https://your-website/notify_page'),
    ];