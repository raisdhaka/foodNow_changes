<?php

return [
    'name' => 'Tinypng',
    'enabled'=>env('ENABLE_TINYPNG',false),
    'api_key'=>env('TINYPNG_API_KEY',''),

    'aws_access_key_id'=>env('tinpng_aws_access_key_id',''),
    'aws_secret_access_key'=>env('tinpng_aws_secret_access_key',''),
    'region'=>env('tinpng_aws_region',''),
    'bucket'=>env('aws_bucket',''),

    'gcp_access_token'=>env('gcp_access_token',''),
    'path'=>env('gcp_path',''),


];
