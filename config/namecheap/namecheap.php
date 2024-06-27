<?php

return [
    "api_key" => env('NAMECHEAP_API_TOKEN'),
    "api_user" => env('NAMECHEAP_API_USER'),
    "user_name" => env('NAMECHEAP_USER_NAME'),
    "command" => "namecheap.domains.create",
    "client_id" => env('NAMECHEAP_CLIENT_IP'),
];
