<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_OCI_TNS', ''),
        'host'           => env('DB_OCI_HOST', ''),
        'port'           => env('DB_OCI_PORT', '1521'),
        'database'       => env('DB_OCI_DATABASE', ''),
        'service_name'   => env('DB_OCI_SERVICE_NAME', ''),
        'username'       => env('DB_OCI_USERNAME', ''),
        'password'       => env('DB_OCI_PASSWORD', ''),
        'charset'        => env('DB_OCI_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_OCI_PREFIX', ''),
        'prefix_schema'  => env('DB_OCI_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_OCI_EDITION', 'ora$base'),
        'server_version' => env('DB_OCI_SERVER_VERSION', '11g'),
        'load_balance'   => env('DB_OCI_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],
    'sessionVars' => [
        'NLS_TIME_FORMAT'         => 'HH24:MI:SS',
        'NLS_DATE_FORMAT'         => 'YYYY-MM-DD HH24:MI:SS',
        'NLS_TIMESTAMP_FORMAT'    => 'YYYY-MM-DD HH24:MI:SS',
        'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
        'NLS_NUMERIC_CHARACTERS'  => '.,',
    ],
];
