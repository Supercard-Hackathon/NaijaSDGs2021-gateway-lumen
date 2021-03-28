<?php

return [
    'clinic'   =>  [
        'base_uri'  =>  env('CLINIC_SERVICE_BASE_URL'),
        'uri_prefix'  =>  env('CLINIC_SERVICE_URI_PREFIX'),
        'secret'  =>  env('CLINIC_SERVICE_SECRET'),
    ],
    'billing'   =>  [
        'base_uri'  =>  env('BILLING_SERVICE_BASE_URL'),
        'uri_prefix'  =>  env('BILLING_SERVICE_URI_PREFIX'),
        'secret'  =>  env('BILLING_SERVICE_SECRET'),
    ]
];