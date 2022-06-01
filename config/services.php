<?php

return [

    "mailgun" => [
        "domain" => env("MAILGUN_DOMAIN"),
        "secret" => env("MAILGUN_SECRET"),
        "endpoint" => env("MAILGUN_ENDPOINT", "api.mailgun.net"),
    ],

    "postmark" => [
        "token" => env("POSTMARK_TOKEN"),
    ],

    "ses" => [
        "key" => env("AWS_ACCESS_KEY_ID"),
        "secret" => env("AWS_SECRET_ACCESS_KEY"),
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
    ],

    "passport" => [
        "endpoint" => env("PASSPORT_ENDPOINT", env("APP_URL") . "/oauth/token"),
        "client_id" => env("PASSPORT_CLIENT_ID"),
        "client_secret" => env("PASSPORT_CLIENT_SECRET")
    ]

];